<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 11/09/2019
 * Time: 23:53
 */
?>

<?
$withoutConfCode = UserAuth::TwoFactorActivity(1);
/**
 * Authorisation settings
 */
//use Two-factor authentication
//$withoutConfCode = true;
if (!$withoutConfCode) {
    //Two-factor authentication
    $twoFactorAuth = false;
    //Check updates of confirmation code
    $codeLastUpdateCheck = false;
    //Update confirmation code every authorisation
    $codeAlwaysNew = false;
    //Confirmation code expiration
}

if ($withoutConfCode) {

    //Always update confirmation code
    $always = false;
    if ($always) {
        //Two-factor authentication
        $twoFactorAuth = true;
        //Check updates of confirmation code
        $codeLastUpdateCheck = false;
        //Update confirmation code every authorisation
        $codeAlwaysNew = true;
        //Confirmation code expiration
    }

    if (!$always) {
        //Never update confirmation code
        $never = false;
        if ($never) {
            //Two-factor authentication
            $twoFactorAuth = true;
            //Check updates of confirmation code
            $codeLastUpdateCheck = false;
            //Update confirmation code every authorisation
            $codeAlwaysNew = false;
            //Confirmation code expiration
        }
    }

    if (!$always && !$never) {
        //Update only per period
        $time = true;
        if ($time) {
            //Two-factor authentication
            $twoFactorAuth = true;
            //Check updates of confirmation code
            $codeLastUpdateCheck = true;
            //Update confirmation code every authorisation
            $codeAlwaysNew = false;
            //Confirmation code expiration
        }
    }

}

/**
 * Expiration date
 */
$time_rules = array (
    'year' => 12*30*24*60*60,
    'month' => 30*24*60*60,
    'day' => 24*60*60,
    'hour' => 60*60,
    'minute' => 60,
    'second' => 1
);
//chosen period
$expiration = 'hour';
?>

<?// if defined 'NEED_AUTH' and user isn't authorised then load only header and footer with authorisation page
if (defined('NEED_AUTH') && !UserAuth::IsAuthorized()) {
    if (!isset($_SESSION['first_step']) || $twoFactorAuth && !isset($_SESSION['second_step'])) {
        require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $TEMPLATE_PATH . "header.php");
        // If user template of authorisation available
        if ($AUTH_TEMPLATE !== '' && $TEMPLATE_PATH !== '') {
            require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $TEMPLATE_PATH . $AUTH_TEMPLATE);
        // But if note available then we will use template by default
        } else {
            require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $DEFAULT_TEMPLATE_PATH . "auth.form/template.php");
        }
        require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $TEMPLATE_PATH . "footer.php");
        die();//stop here
    }
}?>