<?
class UserAuth {


    /**
     * @param $email
     * @param $password
     * @return array|bool
     */
    public static function Authorize($email, $password) {
        global $USER;
        $arUser = $USER->SelectRowJoin(
            '*',
            'users as u',
            'LEFT JOIN roles_n_users as rnu ON u.USER_ID = rnu.USER_ID
                    LEFT JOIN roles_of_users as rou ON rnu.ROLE_ID = rou.ROLE_ID
                    LEFT JOIN access as ac ON ac.USER_ID = u.USER_ID',
            "USER_EMAIL='".$email."'",
            "ACCESS_PASS='".md5($password)."' AND IS_STAFF=1"
        );
        if($arUser) {
            return $arUser;
        } else {
            return false;
        }
    }

    /**
     * @param $ID
     * @param $CONFIRM_CODE
     * @return bool
     *
     * checks and set user authorization
     */
    public static function AuthConfirmation($ID, $CONFIRM_CODE=false) {
        global $USER;
        $subscr = $USER->GetByID($ID);
        $confirmation = $USER->SelectRow('*', 'codes', "USER_ID='".$subscr['USER_ID']."'");
        if ($subscr) {
            //authorisation without confirmation code
            if($CONFIRM_CODE===false) {
                $_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES";
                if ($_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES") {
                    return $confirmation;
                }
                return true;
            }
            //authorisation with confirmation code
            if ($confirmation['CODE_CONF'] == $CONFIRM_CODE) {
                $_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES";
                if ($_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES") {
                    return $confirmation;
                }
                return true;
            }
            //user account subscription
            if (intval($subscr["USER_ID"]) > 0) {
                if($USER->IsAuthorized()) {
                    //user is already authorized
                    if ($USER->GetID() == $subscr["USER_ID"]) {
                        $_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES";
                        if ($_SESSION["SESS_SUBSCR_AUTH"][$ID] = "YES") {
                            return $confirmation;
                        }
                        return true;
                    }
                }
            }
        }
        $_SESSION["SESS_SUBSCR_AUTH"][$ID] = "NO";
        return false;
    }

    /**
     * @param $string
     * @return array|bool
     *
     * You can use any string to generate confirmation password
     */
    public static function ConfCodeGenerate($string) {
        if ($string) {
            //create password for session using date
            $datenow = date('YmdHis');
            //decode date
            $new_password = md5($string . $datenow);
            //get 6 digets since second
            $new_password = substr($new_password, 2, 6);
            $new_password_sh = strrev(md5($new_password)) . "b3p6f";
            return array('USER_CODE' => $new_password, 'SAVE_CODE' => $new_password_sh);
        } else {
            return false;
        }
    }

    /**
     * @param $string
     * @return bool|false|string
     */
    public static function ConfCodeExpiration($string) {
        global $time_rules;
        if (array_key_exists("".$string."", $time_rules)) {
            return date('Y-m-d H:i:s', time() + $time_rules[$string]);
        } else {
            return false;
        }
    }

    /**
     * @param $string
     * @return bool
     */
    public static function ChosenExpiration($string) {
        global $time_rules;
        if (array_key_exists("".$string."", $time_rules)) {
            return $time_rules[$string];
        } else {
            return false;
        }
    }

    /**
     * @param null $status
     * @param $value
     * @return bool
     *
     * Update or do not update confirmation code
     */
    public static function ConfCodeCheck($status=null, $value) {
        global $link;
        global $USER;
        global $currentDate;
        global $twoFactorAuth;
        if ($status != null) {
            if ($status == 'ok') {
                if (mysqli_error($link) == false) {
                    //Create $_SESSION
                    $_SESSION['id'] = $value['USER_ID'];
                    $_SESSION['email'] = $value['USER_EMAIL'];
                    $_SESSION['first_step'] = 'Yes';
                    if (!$twoFactorAuth) {
                        if ($USER->Update('users', "USER_LAST_LOGIN = '$currentDate'", "USER_ID = " . $value['USER_ID'] . "")){
                            UserAuth::AuthConfirmation($value['USER_ID']);
                            $USER->PageRefresh();
                        }
                        return false;
                    }
                    $USER->PageRefresh();
                }
            } else if ($status == 'update') {
                $arPass = UserAuth::ConfCodeGenerate("".$value['USER_EMAIL']."");
                if ($USER->Update('codes', "CODE_CONF='".$arPass['SAVE_CODE']."', CODE_UPDATES='$currentDate'", "USER_ID=".$value['USER_ID']." AND CODE_CONF='".$value['CODE_CONF']."'")) {
                    return $arPass;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return null
	 *
	 * ID of an authorised user
     */
    public function GetID(){
        if (isset($_SESSION['SESS_SUBSCR_AUTH'])) {
            return $_SESSION['SESS_SUBSCR_AUTH'];
        } else {
            return null;
        }
    }

    /**
     * @return bool
     *
     * Check if user authorised or not
     */
    public static function IsAuthorized(){
        global $USER;
        if ($userId = $USER->GetID()) {
            /*
            $user = $USER->SelectRow('USER_EMAIL', 'users', "USER_ID=$userId");
            if ($user['USER_EMAIL'] == $_SESSION['email']){
                //echo 'its true';
                if (isset($_SESSION['SESS_SUBSCR_AUTH']) && $_SESSION['SESS_SUBSCR_AUTH'][$userId] == 'YES') {
                    return true;
                }
            }
            */
            if (isset($_SESSION['SESS_SUBSCR_AUTH']) && $_SESSION['SESS_SUBSCR_AUTH'][$userId] == 'YES') {
                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    /*
    public static function IsAuthorized($ID) {
        return ($_SESSION['SESS_SUBSCR_AUTH'][$ID] == 'YES');
    }

    protected $user;
    public function getUser()
    {
        return $this->user;
    }
    protected static function getUser()
    {
        global $USER;
        return $USER;
    }
    protected static function isAuthorized() {
        return static::getUser()->isAuthorized();
    }
    */

    /*
    //user logout event
	public static function OnUserLogout($user_id)
	{
		//let's reset subscriptions authorization on user logout
		global $DB;
		$user_id = intval($user_id);
		if($user_id>0)
		{
			$strSql = "SELECT ID FROM b_subscription WHERE USER_ID=".$user_id;
			$res = $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
			while($res_arr = $res->Fetch())
				$_SESSION["SESS_SUBSCR_AUTH"][$res_arr["ID"]] = "NO";
		}
		return true;
	}
    */

    public function PageRefresh(){
        $actualUrlAddress = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        ?>
        <script>
            var url = 'https://<?=$actualUrlAddress;?>';
            window.location = url;
        </script>
        <?
    }

    /**
     * @param $type
     * @param $to
     * @param $subject
     * @param $message
     * @param null $headers
     * @param null $value
     * @return bool
     */
    public function SendMessage($type, $to, $subject, $message, $headers=null, $value=null){
        global $FROM;
        global $BRAND_NAME;

        if ($type == 'confirmation code') {
            if ($headers == null) {
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= 'From: '.$BRAND_NAME.'<'.$FROM.'>';
            }
            if ($value != null) {
                if (array_key_exists("CONF_CODE", $value)) {
                    $new_password = $value['CONF_CODE'];
                    $message = str_replace("#CREATED_CONF_CODE#", $new_password, $message);
                }
                if (array_key_exists("CODE_EXPIRATION", $value)) {
                    $codeExpiration = $value['CODE_EXPIRATION'];
                    $message = str_replace("#CODE_EXPIRATION#", $codeExpiration, $message);
                }
                if (array_key_exists("FIRST_NAME", $value)) {
                    $codeExpiration = $value['FIRST_NAME'];
                    $message = str_replace("#FIRST_NAME#", $codeExpiration, $message);
                }
                if (array_key_exists("LAST_NAME", $value)) {
                    $codeExpiration = $value['LAST_NAME'];
                    $message = str_replace("#LAST_NAME#", $codeExpiration, $message);
                }

            }
            if (mail($to, $subject, $message, $headers)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function TwoFactorActivity($ID) {
        global $USER;
        if ($withoutConfCode = $USER->SelectRow('*', 'user_settings', "USER_ID=$ID AND SETTING_SEC_AUTH=1")) {
            return $withoutConfCode;
        } else {
            return false;
        }
    }

}
?>
