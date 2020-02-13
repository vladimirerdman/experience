
            <?if ($USER->isAuthorized()) {?>
                </article>
            </div>
            <?}?>

        </div>

<footer style="width:100%; background-color: rgba(0,0,0,0.8); padding: 17px 1em 19px 1em; font-size: 12px; font-family: inherit;">
    <div style="/*padding-top: 17px;*/ padding-bottom: 19px;">
        <div style="color: #d1d1d1; height: 100%; margin: 0;  margin-right: 30px; float: left;">
            <?if (LANGUAGE_ID !== $langDefault) {?>
                <?=GetMessage('FOOTER_COPYRIGHT');?>© <?=date("Y");?>&nbsp;Xorax.<?=GetMessage('FOOTER_ALL_RIGHTS');?>
            <?} else {?>
                © Xorax, <?=date("Y");?>&nbsp;г. <?=GetMessage('FOOTER_ALL_RIGHTS');?>
            <?}?>
        </div>
        <div style="color: #d1d1d1; height: 100%; margin: 0;  margin-right: 30px; float: left;">
            <a href="" style="letter-spacing: 0px; color: #fff; border-right: 1px solid #d6d6d6; margin-right: 7px; padding-right: 10px;/*color: #555; text-decoration: none;*/"><?=GetMessage('FOOTER_SITE_MAP_URL');?></a>
        </div>
        <div style="color: #d1d1d1; height: 100%; margin: 0;  float: right;">
            <span style="color: #555; text-transform: uppercase; background-color: #fff; padding: 0px 3px; font-weight: 600;"><?=LANGUAGE_ID?></span>&nbsp;&nbsp;<a href="<?if ($LAST_DIR !== 'choose-your-language') {?><?=$GENERAL_PAGE . 'choose-your-language/'?><?}?>" title="<?=GetMessage('LANG_PAGE_TITLE');?>" aria-label="<?=$chosenLang['LANG_NAME'];?>. <?=GetMessage('LANG_PAGE_TITLE');?>" style="letter-spacing: 0px; color: #fff;/*color: #555; text-decoration: none;*/"><?=GetMessage('FOOTER_LANG_CHANGE_BTN');?></a>
        </div>
    </div>
</footer>

        <script src="<?=$SUBDIR . 'local/layout/js/jquery-3.3.1.min.js'?>"></script>
        <script src="<?=$SUBDIR . 'local/layout/js/functions.js'?>"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <?//icons watch here: https://ionicons.com/usage/?>
        <script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>
    </body>
</html>
<?/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */?>