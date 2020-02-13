<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 16/08/2019
 * Time: 09:21
 */?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/smartnote/local/templates/header.php");?>

<div style="padding-bottom: 20em;">
    <?foreach ($arLanguages as $key => $value) {
        if (LANGUAGE_ID == $key) {?>
            <span style="font-weight:600; letter-spacing: 2px; color: #555;"><?=$value['LANG_NAME'];?></span><br>
        <?} else {?>
            <a href="<?=$URL->SwitchLang($key);?>" style="color: #59a1ff;"><?=$value['LANG_NAME'];?></a><br>
        <?}
    }?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/templates/footer.php");?>
