<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 11/09/2019
 * Time: 15:05
 */
?>

    <div style="width: 300px; height: 385px; padding: 3em; margin: 0 auto; margin-top: 13em; margin-bottom: 0em;">

    <?if (!isset($_SESSION['first_step'])) {?>

        <form action="" method="post">
            <span id="un"></span>
            <input type="text" name="username" value="" placeholder="<?=GetMessage('AUTH_USERNAME_INPUT');?>" autocomplete="username" aria-labelledby="un" style="width: 100%; margin-bottom: 1em;" required>
            <br>
            <span id="pd"></span>
            <input type="password" name="password" value="" placeholder="<?=GetMessage('AUTH_PASSWORD_INPUT');?>" autocomplete="current-password" aria-labelledby="pd" style="width: 100%; margin-bottom: 1em;" required>
            <br>
            <input type="submit" name="signup" value="<?=GetMessage('AUTH_GET_CODE_BTN');?>" style="width: 100%; margin-bottom: 1em;">
        </form>

    <?} else if ($twoFactorAuth && !isset($_SESSION['second_step'])) {?>

        <form action="" method="post">
            <input type="password" name="control_code" value="" placeholder="<?=GetMessage('CONF_CODE_INPUT');?>" aria-describedby="pw-help" style="width: 100%; margin-bottom: 1em;" required>
            <br>
            <input type="submit" name="confirm" value="<?=GetMessage('CONF_LOGIN_BTN');?>" style="width: 100%; margin-bottom: 1em;">
            <div id="pw-help" style="font-size: 0.8em; text-align:center;">
                It has been sent to you
            </div>
        </form>

    <?}?>

        <p style="text-align: center;">
        <?
        /**
         * FIRST STEP
         */
        if (isset($_POST['signup'])) {

            $errors = Array();
            $username = '';
            $password = '';

            if (trim($_POST['username']) == '' && empty($_POST['password'])) {
                $errors[] = 'Please, fill all the fields';
                echo array_shift($errors);

            } elseif (trim($_POST['username']) == '') {
                $errors[] = 'Username isn\'t filled';
                echo array_shift($errors);

            } elseif (empty($_POST['password']) or $_POST['password'] == '') {
                $errors[] = 'Password isn\'t filled';
                echo array_shift($errors);

            } elseif (!empty(trim($_POST['username'])) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                //If magic_quotes_gpc enabled -> before mysqli_real_escape_string -> removing backslashes
                $username = stripslashes($username);
                $password = stripslashes($password);
                //To protect MySQL injection for Security purpose
                //Without 2 lines below we can login without password just fill "password" field as: ' OR ''='
                $username = mysqli_real_escape_string($link, $username);
                $password = mysqli_real_escape_string($link, $password);

                if ($arAccess = UserAuth::Authorize("$username", "$password")) {
                    //If user found

                    //User details
                    $userID = $arAccess['USER_ID'];
                    $userEmail = $arAccess['USER_EMAIL'];

                    /**
                    * add here a choice of user
                    */
                    // Write info about user
                    @file_put_contents($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "logs/users.txt", print_r("{$currentDate} User has got access from IP \"{$ip}\", browser \"{$ua['name']}\", version \"{$ua['version']}\", on \"{$ua['platform']}\", lang ".LANGUAGE_ID."", 1) . "\n", FILE_APPEND);

                    if ($twoFactorAuth) {
                        //If user wants to use Two-factor authentication

                        if (!$arConfCode = $USER->SelectRow('*', 'codes', "USER_ID='$userID'")) {
                            //If confirmation code not found
                            $arPass = UserAuth::ConfCodeGenerate($userEmail);

                            //create confirmation code
                            if ($createConfCode = $USER->Insert('codes', 'USER_ID, CODE_CONF, CODE_CREATED, CODE_UPDATES', "$userID, ".$arPass['SAVE_CODE'].", $currentDate, $currentDate")) {
                                /**
                                 * send password to user email
                                 */
                                //array with user confirmation code to use
                                $codeNew = array('CONF_CODE' => $arPass['USER_CODE']);
                                $userFirstName = array('FIRST_NAME' => $arAccess['USER_FT_NAME']);
                                $userLastName = array('LAST_NAME' => $arAccess['USER_LT_NAME']);
                                //array with expiration date
                                if ($expiration != null) {
                                    if ($expirationDate = UserAuth::ConfCodeExpiration("$expiration")) {
                                        $codeTime = array('CODE_EXPIRATION' => $expirationDate);
                                    } else {
                                        $codeTime = array();
                                    }
                                } else {
                                    $codeTime = array();
                                }
                                //merge arrays
                                $arParams = array_merge($codeNew, $codeTime, $userFirstName, $userLastName);

                                //send it to user
                                if ($USER->SendMessage(
                                    'confirmation code',
                                    "$userEmail",
                                    "".GetMessage('AUTH_MESSAGE_CONF_SUBJECT')."",
                                    "".GetMessage('AUTH_MESSAGE_TEXT_BODY')."",
                                    null,
                                    $arParams
                                )) {
                                    //if email sent
                                    $errors[] = GetMessage('AUTH_MESSAGE_ERROR_SENT');
                                    /**
                                     * Create $_SESSION
                                     */
                                    $_SESSION['first_step'] = 'Yes';
                                    $_SESSION['email'] = $userEmail;
                                    $_SESSION['id'] = $userID;
                                    $USER->PageRefresh();
                                } else {
                                    //if mail not sent
                                    $errors[] = GetMessage('AUTH_ERROR_SENDING');
                                    echo array_shift($errors);
                                }

                            } else {
                                //couldn't create confirmation code
                                $errors[] = GetMessage('AUTH_ERROR_CREATION') . mysqli_error($link);
                                echo array_shift($errors);
                            }

                        } else {
                            //If confirmation code already exist
                            if ($codeLastUpdateCheck) {
                                /**
                                 * If user wants to check last update of conf code
                                 */
                                if ((time() - strtotime($arConfCode['CODE_UPDATES'])) <= UserAuth::ChosenExpiration("$expiration")) {
                                    //Conf code valid
                                    UserAuth::ConfCodeCheck('ok', array('USER_ID' => $userID, 'USER_EMAIL' => $userEmail));
                                } else {
                                    //Conf code not valid -> update
                                    if ($arPassUpdate = UserAuth::ConfCodeCheck('update', array('USER_ID' => $userID, 'USER_EMAIL' => $userEmail, 'CODE_CONF' => $arConfCode['CODE_CONF']))) {
                                        /**
                                         * SEND IT TO USER
                                         */
                                        //array with user confirmation code to use
                                        $codeNew = array('CONF_CODE' => $arPassUpdate['USER_CODE']);
                                        $userFirstName = array('FIRST_NAME' => $arAccess['USER_FT_NAME']);
                                        $userLastName = array('LAST_NAME' => $arAccess['USER_LT_NAME']);
                                        //array with expiration date
                                        if ($expiration != null) {
                                            if ($expirationDate = UserAuth::ConfCodeExpiration("$expiration")) {
                                                $codeTime = array('CODE_EXPIRATION' => $expirationDate);
                                            } else {
                                                $codeTime = array();
                                            }
                                        } else {
                                            $codeTime = array();
                                        }
                                        //merge arrays
                                        $arParams = array_merge($codeNew, $codeTime, $userFirstName, $userLastName);

                                        //send it to user
                                        if ($sendCode = $USER->SendMessage(
                                            'confirmation code',
                                            "$userEmail",
                                            "".GetMessage('AUTH_MESSAGE_CONF_SUBJECT')."",
                                            "".GetMessage('AUTH_MESSAGE_TEXT_BODY')."",
                                            null,
                                            $arParams
                                        )) {
                                            //if email sent
                                            $errors[] = GetMessage('AUTH_MESSAGE_ERROR_SENT');
                                            //create session
                                            $_SESSION['first_step'] = 'Yes';
                                            $_SESSION['email'] = $userEmail;
                                            $_SESSION['id'] = $userID;
                                            $USER->PageRefresh();
                                        } else {
                                            //if mail not sent
                                            $errors[] = GetMessage('AUTH_ERROR_SENDING');
                                            echo array_shift($errors);
                                        }
                                    }
                                }
                            } else {
                                /**
                                 * If user doesn't want to check last update of conf code
                                 */
                                if ($codeAlwaysNew) {
                                    //Always update confirmation code
                                    if ($arPassAlwaysNew = UserAuth::ConfCodeCheck('update', array('USER_ID' => $userID, 'USER_EMAIL' => $userEmail, 'CODE_CONF' => $arConfCode['CODE_CONF']))) {
                                        /**
                                         * SEND IT TO USER
                                         */
                                        //array with user confirmation code to use
                                        $codeNew = array('CONF_CODE' => $arPassAlwaysNew['USER_CODE']);
                                        $userFirstName = array('FIRST_NAME' => $arAccess['USER_FT_NAME']);
                                        $userLastName = array('LAST_NAME' => $arAccess['USER_LT_NAME']);
                                        //merge arrays
                                        $arParams = array_merge($codeNew, $userFirstName, $userLastName);

                                        //send it to user
                                        if ($USER->SendMessage(
                                            'confirmation code',
                                            "$userEmail",
                                            "".GetMessage('AUTH_MESSAGE_CONF_SUBJECT')."",
                                            "".GetMessage('AUTH_MESSAGE_TEXT_BODY_ALWAYS')."",
                                            null,
                                            $codeNew
                                        )) {
                                            //if email sent
                                            $errors[] = GetMessage('AUTH_MESSAGE_ERROR_SENT');
                                            //create session
                                            $_SESSION['first_step'] = 'Yes';
                                            $_SESSION['email'] = $userEmail;
                                            $_SESSION['id'] = $userID;
                                            $USER->PageRefresh();
                                        } else {
                                            //if mail not sent
                                            $errors[] = GetMessage('AUTH_ERROR_SENDING');
                                            echo array_shift($errors);
                                        }
                                    }
                                } else {
                                    //Don't update confirmation code
                                    UserAuth::ConfCodeCheck('ok', array('USER_ID' => $userID, 'USER_EMAIL' => $userEmail));
                                }
                            }
                        }
                    } else {
                        //If user doesn't want to use Two-factor authentication
                        UserAuth::ConfCodeCheck('ok', array('USER_ID' => $userID, 'USER_EMAIL' => $userEmail));
                    }
                } else {
                    //If user not found
                    $errors[] = GetMessage('AUTH_ERROR_WRONG_USER_OR_PASS');
                    echo array_shift($errors);
                }
            }

        /**
         * SECOND STEP
         */
        } else if (isset($_POST['confirm'])) {
            $errors = Array();
            $confCode = '';

            if (empty($_POST['control_code'])) {
                $errors[] = GetMessage('CONF_ERROR_NEED_CODE');
                echo array_shift($errors);
            } elseif (!empty($_POST['control_code'])) {
                $confCode = $_POST['control_code'];
                $confCode = stripslashes($confCode);
                $confCode = mysqli_real_escape_string($link, $confCode);

                if ($confirmation = UserAuth::AuthConfirmation("".$_SESSION['id']."", "".strrev(md5($confCode))."b3p6f")) {
                    @file_put_contents($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "logs/users.txt", print_r("{$currentDate} User authorised from IP \"{$ip}\", browser \"{$ua['name']}\", version \"{$ua['version']}\", on \"{$ua['platform']}\", lang " . LANGUAGE_ID . "", 1) . "\n", FILE_APPEND);
                    $USER->Update('users', "USER_LAST_LOGIN = '$currentDate'", "USER_ID = " . $_SESSION['id'] . "");
                    $_SESSION['second_step'] = 'Yes';
                    $USER->PageRefresh();
                    /**
                     * Note:
                     *
                     * 677e7e
                     * 4f76807f8675ac990f5c0ef182a5c766b3p6f
                     */
                } else {
                    //Code is incorrect
                    $errors[] = GetMessage('CONF_ERROR_WRONG_CODE');
                    echo array_shift($errors);
                    unset($_SESSION['second_step']);
                }
            }
        }?>
        </p>
    </div>
