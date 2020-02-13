<?
$MESS[''] = '';

//auth page
$MESS['AUTH_USERNAME_INPUT'] = 'Username';
$MESS['AUTH_PASSWORD_INPUT'] = 'Password';
$MESS['AUTH_GET_CODE_BTN'] = 'Receive code';
$MESS['AUTH_ERROR_WRONG_USER_OR_PASS'] = 'Username or password is incorrect';
$MESS['AUTH_MESSAGE_CONF_SUBJECT'] = 'Confirmation of authorisation';
$MESS['AUTH_MESSAGE_TEXT_BODY'] = "
<html>
    <head>
        <title>Confirmation Code</title>
    </head>
    <body>
        <p>Dear #FIRST_NAME# #LAST_NAME#,<br><br>
            Your confirmation code: #CREATED_CONF_CODE#<br><br>
        Attention! Password will be valid till: #CODE_EXPIRATION#.</p>
    </body>
</html>
";
$MESS['AUTH_MESSAGE_TEXT_BODY_ALWAYS'] = "
<html>
    <head>
        <title>Confirmation Code</title>
    </head>
    <body>
        <p>Dear #FIRST_NAME# #LAST_NAME#,<br><br>
            Your confirmation code: #CREATED_CONF_CODE#</p>
    </body>
</html>
";
$MESS['AUTH_MESSAGE_ERROR_SENT'] = 'Confirmation code has been sent. Please, check email.<br>';
$MESS['AUTH_ERROR_SENDING'] = 'Can\'t send confirmation code';
$MESS['AUTH_ERROR_CREATION'] = 'Error: code not created';

//conf page
$MESS['CONF_CODE_INPUT'] = 'Enter your code';
$MESS['CONF_LOGIN_BTN'] = 'Log in';
$MESS['CONF_ERROR_NEED_CODE'] = 'Please, enter confirmation code';
$MESS['CONF_ERROR_WRONG_CODE'] = 'Confirmation code is incorrect';

//header
$MESS['A_TITLE_TO_GENERAL'] = 'Go to the general page';

//footer
$MESS['FOOTER_COPYRIGHT'] = 'Copyright ';
$MESS['FOOTER_ALL_RIGHTS'] = ' All rights reserved.';
$MESS['FOOTER_SITE_MAP_URL'] = 'Site Map';

//language confirmation
$MESS['LANGUAGE_DEFINITION'] = 'Your language: ';
$MESS['LANGUAGE_CONFIRMATION_YES'] = 'Yes';
$MESS['LANGUAGE_CONFIRMATION_NO'] = 'Edit';

//Choosing language
$MESS['LANG_PAGE_TITLE'] = 'Choose your language';
$MESS['lANG_PAGE_DESCRIPTION'] = 'We gave some general languages to help you feel more comfortable with it.';
$MESS['lANG_PAGE_KEYWORDS'] = 'languages change choose';
$MESS['FOOTER_LANG_CHANGE_BTN'] = 'Change';

//left menu
$MESS['Overview'] = 'Overview';
$MESS['Roadmap'] = 'Roadmap';
$MESS['ProductBacklog'] = 'Product Backlog';
$MESS['SprintBacklog'] = 'Sprint Backlog';
$MESS['Members'] = 'Members';
$MESS['Budget'] = 'Budget';
$MESS['StoryPoints'] = 'Story Points';
$MESS['SprintReviews'] = 'Sprint Reviews';
$MESS['MENU_TARGETS'] = 'Targets';

//authorization
$MESS['btn_Logout'] = 'Log out';

//titles
$MESS['General'] = 'SmartNote';
$MESS['Overview'] = 'Overview';
$MESS['Roadmap'] = 'Roadmap';

//description
$MESS['DESCRIPTION_GENERAL_PAGE'] = 'Welcome to smartnote general page';
$MESS['DESCRIPTION_OVERVIEW_PAGE'] = 'Welcome to smartnote overview page';
$MESS['DESCRIPTION_ROADMAP_PAGE'] = 'Welcome to smartnote roadmap page';
$MESS['DESCRIPTION_TARGETS_PAGE'] = 'Welcome to smartnote targets page';

//keywords
$MESS['KEYWORDS_GENERAL_PAGE'] = 'Xorax, smartnote, general';
$MESS['KEYWORDS_OVERVIEW_PAGE'] = 'Xorax, smartnote, overview';
$MESS['KEYWORDS_ROADMAP_PAGE'] = 'Xorax, smartnote, roadmap';
$MESS['KEYWORDS_TARGETS_PAGE'] = 'Xorax, smartnote, targets';
?>
