<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 07/09/2019
 * Time: 21:13
 */

$sSectionName = GetMessage('LANG_PAGE_TITLE');
$arDirProperties = array(
    "description" => GetMessage('lANG_PAGE_DESCRIPTION'),
    "keywords" => GetMessage('lANG_PAGE_KEYWORDS'),
    //"robots" => "index, follow"
    "robots" => "noindex, nofollow"//index, follow
);
?>