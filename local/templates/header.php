<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "/smartnote/xorax/start.php");?>

<!DOCTYPE html>
<html lang="<?=$htmlLang?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <?// $APPLICATION->ShowTitle();?>
    <title><?if ($sectionFile) { echo $sSectionName; } else { echo $LAST_DIR; }?></title>
    <?if ($sectionFile || $arMetaResult) {
        if($arDirProperties['description'] != '') {?>
    <meta name="description" content="<?=$arDirProperties['description'];?>">
        <?}
        if($arDirProperties['keywords'] != '') {?>
    <meta name="keywords" content="<?=$arDirProperties['keywords'];?>">
        <?}
        if($arDirProperties['robots'] != '') {?>
    <meta name="robots" content="<?=$arDirProperties['robots'];?>">
        <?}
    }?>
    <?// favicons?>
    <link rel="apple-touch-icon" href="<?=$SUBDIR . 'local/layout/favicon/apple-touch-icon.png'?>" sizes="180x180">
    <link rel="icon" type="image/png" href="<?=$SUBDIR . 'local/layout/favicon/favicon-16x16.png'?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?=$SUBDIR . 'local/layout/favicon/favicon-32x32.png'?>" sizes="32x32">
    <link rel="manifest" href="<?=$SUBDIR . 'local/layout/favicon/site.webmanifest'?>">
    <link rel="mask-icon" href="<?=$SUBDIR . 'local/layout/favicon/safari-pinned-tab.svg'?>" color="#888">
    <link rel="shortcut icon" href="<?=$SUBDIR . 'favicon.ico'?>">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="<?=$SUBDIR . 'local/layout/favicon/browserconfig.xml'?>">
    <meta name="theme-color" content="#ffffff">
    <?// fonts?>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?// css?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=$SUBDIR . 'local/layout/css/styles.css'?>">
    <?//icons?>
    <?//https://github.com/lipis/flag-icon-css watch here: http://flag-icon-css.lip.is/?continent=North+America  https://cdnjs.com/libraries/flag-icon-css?>
</head>
<body>

    <header>
            <?include($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/includes/header_desktop.php");?>
    </header>

    <div class="content">

        <span id="hiddenfromeye" style="">XORAX</span>

        <script>
            /**
             * localStorage
             */
            //null by default
            var langConfirmation = localStorage.getItem('langConfirmation');
            var hiddentext = document.getElementById("hiddenfromeye");
            if(langConfirmation == 'Yes' || langConfirmation == 'No') {
                document.getElementById("langConf").style.display = "none";
                hiddentext.style.fontSize = '1.72em';
                hiddentext.innerHTML = "String";
            } else {
                hiddentext.style.fontSize = '3.44em';
                hiddentext.innerHTML = "String";
            }
        </script>

        <?// Left menu?>
        <?if ($USER->isAuthorized()) {?>
        <div>
            <aside>
                <?require($_SERVER["DOCUMENT_ROOT"]. $SUBDIR . "local/templates/general/components/menu/left/template.php");?>
            </aside>
	        <article>
        <?}?>
