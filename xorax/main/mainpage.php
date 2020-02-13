<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 08/09/2019
 * Time: 13:10
 */
?>

<?
if (LANGUAGE_ID !== $langDefault) {
    $GENERAL_PAGE = $SUBDIR . LANGUAGE_ID . '/';
} else {
    $GENERAL_PAGE = $SUBDIR;
}

$bIsMainPage = false;
if ($uri_parts[0] == $GENERAL_PAGE) {
    $bIsMainPage = true;
} else {
    $bIsMainPage = false;
}
?>