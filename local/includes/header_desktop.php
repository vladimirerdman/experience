<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
?>

<?//if ($langBrowser && $langBrowser !== LANGUAGE_ID) {?>
    <div id="langConf" class="row" style="height: 44px; background-color: #444; margin: 0; text-align: center; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-align-items: center; -ms-flex-align: center; align-items: center;">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 langConfOnTop">

            <div id="generalLangConf">
            <?if ($langBrowser) {?>
                <span><?=GetMessage('LANGUAGE_DEFINITION')?></span><span>&nbsp;</span>
                <b>
                <?foreach ($arLanguages as $key => $value) {
                    if ($langBrowser == $key) {?>
                        <span style="font-weight: 600;"><?=$value['LANG_NAME'];?></span>
                    <?}
                }?>
                </b>
                    <span>&nbsp;</span><span>?</span>
                    <span id="langConfY" class="langConf" style="background-color: #007bffd9; padding: 0px 25px; border: #007bffd9; border-radius: 4px; color: #fff; margin-left: 15px; margin-right: 15px; padding-top: 2px; padding-bottom: 3px;">
                        <?=GetMessage('LANGUAGE_CONFIRMATION_YES')?>
                    </span>
                    <span id="langConfN" class="langConf" style="color:#fff; margin-left: 3px;">
                        <?=GetMessage('LANGUAGE_CONFIRMATION_NO')?>
                    </span>
            <?}?>
            </div>

            <div id="optionsLangConf" style="display: none;">
                <?foreach ($arLanguages as $key => $value) {?>
                    <?if (LANGUAGE_ID == $key) { ?>
                        <span style="font-weight:600; font-size:12px; letter-spacing: 2px; color: #d0cece;"><?=$value['LANG_NAME'];?></span><span>&nbsp;</span>
                    <?} else {?>
                        <a href="<?=$URL->SwitchLang($key);?>" style="font-size:12px; color: #59a1ff;"><?=$value['LANG_NAME'];?></a><span>&nbsp;</span>
                    <?}
                }?>
            </div>

        </div>
    </div>
<?//}?>

<div class="row headerRow">

    <?// Menu button?>
    <div id="btnMenuMobile" class="col-md-4 col-sm-2 col-3 headerCol">
        <div aria-label="menu" class="toggleTopNavOverlay">
            <div class="toggleMenuIcon">
                <span class="line top"></span>
                <span class="line bottom"></span>
            </div>
        </div>
    </div>

    <?// Logotype?>
    <!--<div class="col-md-4 col-sm-8 col-6">-->
    <div id="menuLogo" class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-6 headerMobileLogo_div" style="padding: 8px 0px 10px 0px;">

        <?if($bIsMainPage){?>
            <span id="headerLogo_span">
        <?}else{?>
            <a id="headerLogo_a" href="<?=$GENERAL_PAGE;?>" title="<?=GetMessage('A_TITLE_TO_GENERAL');?>">
        <?}?>

            <?=$BRAND_NAME?>

        <?if($bIsMainPage){?>
            </span>
        <?}else{?>
            </a>
        <?}?>

    </div>

    <?// Logout button?>
    <!--<div class="col-md-4 col-sm-2 col-3">-->
    <div id="btnLogout" class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-6 headerCol" style="padding: 0;">
        <?if ($USER->isAuthorized()) {?>
                <a href="<?=$GENERAL_PAGE . '?logout';?>" class="headerLogout_a pull-right">
                    <ion-icon name="log-out" class="headerLogoutIcon"></ion-icon>
                </a>
                <?if ($_SERVER['QUERY_STRING'] == 'logout') {
                    // Write info about user
                    @file_put_contents($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "logs/users.txt", print_r("{$currentDate} User Logout from IP \"{$ip}\", browser \"{$ua['name']}\", version \"{$ua['version']}\", on \"{$ua['platform']}\", lang ".LANGUAGE_ID."", 1) . "\n", FILE_APPEND);
                }?>
        <?}?>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]. $SUBDIR . "local/templates/general/components/menu/top_overlay/template.php");?>