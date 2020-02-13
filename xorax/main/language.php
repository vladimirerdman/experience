<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 08/09/2019
 * Time: 13:14
 */
?>

<?
$langBrowser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

//Explode URL
$url = explode('/', $_SERVER['REQUEST_URI']);

//Get URL without GET parameters
$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

//Get Languages from DB
$arLanguages = Array();
$getLangs = $USER->Select('LANG_CODE, LANG_NAME, LANG_COUNTRY, LANG_DEFAULT, LANG_ACTIVE', 'languages', "LANG_ACTIVE=1");
if($getLangs) {
    foreach ($getLangs as $key => $value) {
        $lang = substr($value['LANG_CODE'], 0, 2);
        $arLanguages[$lang] = Array(
            'LANG_CODE' => $lang,
            'LANG_HTML_CODE' => $value['LANG_CODE'],
            'LANG_NAME' => $value['LANG_NAME'],
            'LANG_COUNTRY' => $value['LANG_COUNTRY'],
            'LANG_DEFAULT' => $value['LANG_DEFAULT'],
            'LANG_ACTIVE' => $value['LANG_ACTIVE']
        );
    }
}

//Get default language
$keys = array_keys($arLanguages);
$arIndex = array_keys(array_column($arLanguages, 'LANG_DEFAULT'), 1);
$strIndex = implode($arIndex);
$langDefault = $keys[$strIndex];

require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/modules/main/classes/general/language.php");
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/modules/main/classes/general/url.php");

//Checking if user chosen the language
if(!isset($_GET['logout'])) {
    //if LANG already chosen and saved then ->
    if (@$_SESSION['UserLang']) {
        //check if chosen LANG is possible to use
        if (!isset($arLanguages[$_SESSION['UserLang']]) || !array_key_exists($_SESSION['UserLang'], $arLanguages)) {
            //if we can't use chosen LANG then use default lang
            $_SESSION['UserLang'] = $langDefault;
        }
    } else {
        if (isset($arLanguages[$langBrowser]) || array_key_exists($langBrowser, $arLanguages)) {
            $_SESSION['UserLang'] = $langBrowser;
        } else {
            $_SESSION['UserLang'] = $langDefault;
        }
    }
} else {
    $_SESSION = array();
    //unset($_SESSION['first_step']);
    //unset($_SESSION['second_step']);
    //unset($_SESSION['UserLang']);
    session_destroy();
}

//Checking if there GET with LANG available
$language = false;
if(isset($_GET['lang'])){
    $language = addslashes($_GET['lang']);
} else {
    $language = false;
}

//Getting language from GET
if($language) {
    if (!isset($arLanguages[$language]) || !array_key_exists($language, $arLanguages)) {
        //if chosen language not found in Array then take language from browser
        $_SESSION['UserLang'] = $langDefault;
    } else {
        //if chosen language found in Array then add it
        $_SESSION['UserLang'] = $language;
    }
}

$currentLang = addslashes($_SESSION['UserLang']);

//Chosen language
$userLang = false;
if($currentLang != '') {
    $userLang = $currentLang;
} else {
    $userLang = false;
}

//Switch language
if($userLang){
    define("LANGUAGE_ID", isset($arLanguages[$userLang]) || array_key_exists($userLang, $arLanguages) ? $userLang : $langDefault);
}

$chosenLang = $LANG->LangDetails($userLang);

//Checking availability of folder with chosen language
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $LANGDIR . LANGUAGE_ID . $LANGFILE)){
    function GetMessage($phrase){
        global $SUBDIR;
        global $LANGDIR;
        global $LANGFILE;
        static $MESS = array();
        require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $LANGDIR . LANGUAGE_ID . $LANGFILE);
        return $MESS[$phrase];
    }
}else{
    function GetMessage($phrase){
        global $SUBDIR;
        global $LANGDIR;
        global $LANGFILE;
        global $langDefault;
        static $MESS = array();
        require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . $LANGDIR . $langDefault . $LANGFILE);
        return $MESS[$phrase];
    }
}

//echo 'Browser language: ' . $langBrowser . '<br>';
//echo 'Page language: ' . $userLang . '<br>';
?>