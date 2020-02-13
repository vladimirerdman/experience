<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 07/09/2019
 * Time: 13:14
 */
?>

<?
class ActiveLangInfo {

    public function LangDetails($language){
        global $arLanguages;
        foreach ($arLanguages as $key => $value) {
            if ($language == $key) {
                return $value;
            }
        }
    }

}
$LANG = new ActiveLangInfo();
?>