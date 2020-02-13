<?
$MESS[''] = '';

//auth page
$MESS['AUTH_USERNAME_INPUT'] = 'Логин';
$MESS['AUTH_PASSWORD_INPUT'] = 'Пароль';
$MESS['AUTH_GET_CODE_BTN'] = 'Получить код';
$MESS['AUTH_ERROR_WRONG_USER_OR_PASS'] = 'Введен неверный логин или пароль';
$MESS['AUTH_MESSAGE_CONF_SUBJECT'] = 'Подтверждение авторизации';
$MESS['AUTH_MESSAGE_TEXT_BODY'] = "
<html>
    <head>
        <title>Код для подтверждения</title>
    </head>
    <body>
        <p>Уважаемый #FIRST_NAME# #LAST_NAME#,<br><br>
            Ваш код подтверждения: #CREATED_CONF_CODE#<br><br>
        Внимание! Пароль действителен до: #CODE_EXPIRATION#.</p>
    </body>
</html>
";
$MESS['AUTH_MESSAGE_TEXT_BODY_ALWAYS'] = "
<html>
    <head>
        <title>Код для подтверждения</title>
    </head>
    <body>
        <p>Уважаемый #FIRST_NAME# #LAST_NAME#,<br><br>
            Ваш код подтверждения: #CREATED_CONF_CODE#</p>
    </body>
</html>
";
$MESS['AUTH_MESSAGE_ERROR_SENT'] = 'Пароль для подтверждения был отправлен. Пожалуйста, проверьте почту.<br>';
$MESS['AUTH_ERROR_SENDING'] = 'Не удается отправить пароль для подтверждения';
$MESS['AUTH_ERROR_CREATION'] = 'Ошибка: пароль для подтверждения не создан';

//conf page
$MESS['CONF_CODE_INPUT'] = 'Введите полученный код';
$MESS['CONF_LOGIN_BTN'] = 'Войти';
$MESS['CONF_ERROR_NEED_CODE'] = 'Пожалуйста, введите полученный код';
$MESS['CONF_ERROR_WRONG_CODE'] = 'Не правильно введен код';

//header
$MESS['A_TITLE_TO_GENERAL'] = 'Перейти на главную страницу';

//footer
$MESS['FOOTER_ALL_RIGHTS'] = ' Все права защищены.';
$MESS['FOOTER_SITE_MAP_URL'] = 'Карта сайта';

//language confirmation
$MESS['LANGUAGE_DEFINITION'] = 'Ваш язык: ';
$MESS['LANGUAGE_CONFIRMATION_YES'] = 'Да';
$MESS['LANGUAGE_CONFIRMATION_NO'] = 'Изменить';

//Choosing language
$MESS['LANG_PAGE_TITLE'] = 'Выберите язык';
$MESS['lANG_PAGE_DESCRIPTION'] = 'Мы предоставили основные языки, чтобы вам было с нами комфортно.';
$MESS['lANG_PAGE_KEYWORDS'] = 'языки изменить выбрать';
$MESS['FOOTER_LANG_CHANGE_BTN'] = 'Изменить';

//left menu
$MESS['Overview'] = 'Обзор';
$MESS['Roadmap'] = 'Roadmap';
$MESS['ProductBacklog'] = 'Backlog продукта';
$MESS['SprintBacklog'] = 'Backlog спринта';
$MESS['Members'] = 'Участники';
$MESS['Budget'] = 'Бюджет';
$MESS['StoryPoints'] = 'История загруженности';
$MESS['SprintReviews'] = 'Итоги спринтов';
$MESS['MENU_TARGETS'] = 'Цели';

//authorization
$MESS['btn_Logout'] = 'Выйти';

//titles
$MESS['General'] = 'SmartNote';
$MESS['Overview'] = 'Обзор';
$MESS['Roadmap'] = 'Дорожная карта';

//description
$MESS['DESCRIPTION_GENERAL_PAGE'] = 'Добро пожаловать на главную страницу smartnote';
$MESS['DESCRIPTION_OVERVIEW_PAGE'] = 'Обзор';
$MESS['DESCRIPTION_ROADMAP_PAGE'] = 'Дорожная карта';
$MESS['DESCRIPTION_TARGETS_PAGE'] = 'Добро пожаловать на страницу целей';

//keywords
$MESS['KEYWORDS_GENERAL_PAGE'] = 'Xorax, smartnote, освновная';
$MESS['KEYWORDS_OVERVIEW_PAGE'] = 'Xorax, smartnote, обзор';
$MESS['KEYWORDS_ROADMAP_PAGE'] = 'Xorax, smartnote, дорожная карта';
$MESS['KEYWORDS_TARGETS_PAGE'] = 'Xorax, smartnote, цели';
?>
