<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */

/**
 * Global variables
 */
global $url;//Explode URL
global $arLanguages;//All available active languages
global $langDefault;//Language chosen as default for the website
global $langBrowser;
global $LANG;//Class with LangDetails function
global $chosenLang;//Details of chosen language
global $URL;//Class with SwitchLang function to generate URL with new chosen language + Redirect function
global $SUBDIR;//Directory of the website
global $GENERAL_PAGE;//URL of general page with/without chosen language
global $USER;//Class with GetByID function to get details of authorised user + functions: Select, SelectRow, Insert, Delete, Ipdate
global $LANGDIR;//Directory with lang files
global $LANGFILE;//Filename with lang
global $APPLICATION;//Class with IncludeTemplate function
global $currentDate;
global $FROM;
global $BRAND_NAME;
global $twoFactorAuth; //enable Two-factor authorisation (true/false)
global $codeLastUpdateCheck; //check last update of confirmation code (true/false)
global $codeAlwaysNew; //always update confirmation code (true/false)
global $expiration; //chosen period
global $time_rules; //periods
/**
 * Static variables
 */
//static $MESS;//Use GetMessage('KEY') to get text from lang file by $MESS['KEY'] = 'text'

/**
 * General settings
 */
$SUBDIR = '/smartnote/';//If no subdir then just type '/'
$LANGDIR = 'lang/';
$LANGFILE = '/lang.php';
$BRAND_NAME = 'Smartnote';
$DEFAULT_TEMPLATE_PATH = 'xorax/components/';
$TEMPLATE_PATH = 'local/templates/';
$AUTH_TEMPLATE = 'general/components/auth.form/template.php';
$FROM = 'info@xorax.ru';

/**
 * Others
 */
// To get template name:
// basename(__DIR__);

// To get path to the template
// dirname(__FILE__);

// To get full path to the page
// getcwd();

// To get path to the page from the root
// dirname($_SERVER['PHP_SELF']);

// Came from
// $_SERVER['HTTP_REFERER']

$currentDate = date('Y-m-d H:i:s');

$path = dirname($_SERVER['PHP_SELF']);
$position = strrpos($path, '/') + 1;
$LAST_DIR = substr($path, $position);//Getting current dir

require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/php_interface/db.php");// DB details
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/dbconn.php");// Connection to DB
session_start();
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/ip.php");// Get user IP
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/browser.php");// Get info about user browser
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/modules/main/classes/mysql/user.php");// Get user details
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/language.php");
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/mainpage.php");
//require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/meta.php");

$htmlLang = $arLanguages[LANGUAGE_ID]['LANG_HTML_CODE'];

//session control:
$currTime = time();

require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/meta.php");
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/authorisation.php");
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/modules/main/classes/general/app.php");
//require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/main/meta.php");
require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "xorax/modules/main/classes/general/engine.php");

// При создании сессии ограничить её время жизни
/*
    //session timeout
	$arPolicy["SESSION_TIMEOUT"]>0
	&& $_SESSION['SESS_TIME']>0
	&& $currTime-$arPolicy["SESSION_TIMEOUT"]*60 > $_SESSION['SESS_TIME']
 */
?>
