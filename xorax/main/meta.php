<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 08/09/2019
 * Time: 13:04
 */
?>

<?
//!!!!!!!! It should determine path automatically but not like this !!!!!!!!!!
$pathToGeneralPage = '';
if($bIsMainPage){
    $pathToGeneralPage = '../';
} else {
    $pathToGeneralPage = '../..';
}

//Getting full URL with .php
$filePath = explode('/', $_SERVER["PHP_SELF"]);
$arFilePath = Array();
foreach ($filePath as $key => $value) {
    $arFilePath[] = $value;
    $fileDetail = $value;
}

//Getting DIR
$getDir = dirname($_SERVER["PHP_SELF"]);
$pageDir = $getDir . '/';

$sectionFile = false;
$detailPHP = false;
$dirAvailability = false;
if (array_search('detail.php', $filePath, true)) {

    //Check for availability of EDIT parameter
    $paramSection = false;
    if(isset($_GET['page'])){
        $paramSection = addslashes($_GET['page']);
    } else {
        $paramSection = false;
    }

    if ($paramSection) {
        //if table name added
        if ($META["IBLOCK_TYPE"] !== '') {

            //Get ELEMENT_CODE
            $arElementCode = $USER->SelectRow("SECTION_CODE", $META["IBLOCK_TYPE"], "SECTION_CODE='$paramSection'");

            if ($arElementCode) {

                if ($arElementCode['SECTION_CODE'] !== '') {
                    $ELEMENT_CODE = $arElementCode['SECTION_CODE'];

                    if ($_GET['page'] == $ELEMENT_CODE) {
                        //Create an Array with meta keys
                        $arMeta = Array();
                        if ($META['META_DESCRIPTION'] !== '' && $META['SET_META_DESCRIPTION'] == 'Y') {
                            $arMeta[] = $META['META_DESCRIPTION'];
                        }
                        if ($META['META_KEYWORDS'] !== '' && $META['SET_META_KEYWORDS'] == 'Y') {
                            $arMeta[] = $META['META_KEYWORDS'];
                        }
                        if ($META['META_ROBOTS'] !== '' && $META['SET_META_ROBOTS'] == 'Y') {
                            $arMeta[] = $META['META_ROBOTS'];
                        }
                        $meta = implode(", ", $arMeta);

                        //Find meta in the table
                        $arMetaResult = $USER->SelectRow("$meta", $META["IBLOCK_TYPE"], "SECTION_CODE='$ELEMENT_CODE'");

                        //Insert Description
                        if (array_key_exists("SECTION_DESCRIPTION", $arMetaResult)) {
                            $arDirProperties['description'] = $arMetaResult['SECTION_DESCRIPTION'];
                        } else {
                            $arDirProperties['description'] = '';
                        }

                        //Insert Keywords
                        if (array_key_exists("SECTION_KEYWORDS", $arMetaResult)) {
                            $arDirProperties['keywords'] = $arMetaResult['SECTION_KEYWORDS'];
                        } else {
                            $arDirProperties['keywords'] = '';
                        }

                        //Insert Robots
                        if (array_key_exists("SECTION_ROBOTS", $arMetaResult)) {
                            $arDirProperties['robots'] = $arMetaResult['SECTION_ROBOTS'];
                        } else {
                            $arDirProperties['robots'] = '';
                        }

                    }
                }
            } else {
                $arMetaResult = false;
                header("HTTP/1.0 404 Not Found");
                require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "404.php");
                die();
            }
        }
    }

    $detailPHP = true;

} else {
    $arMetaResult = false;//it's not detail.php

    $checkDir = $pathToGeneralPage . $pageDir;
    if ($bIsMainPage || is_dir($checkDir)) {
        $dir = $_SERVER["DOCUMENT_ROOT"] . $pageDir;
        $files = scandir($dir);
        unset($files[array_search('.', $files, true)]);
        unset($files[array_search('..', $files, true)]);

        if (count($files) < 1)
            $sectionFile = false;

        foreach ($files as $d) {

            // if it's not a DIR
            if (!is_dir($dir . '/' . $d)) {

                // if file .section.php exist
                if (file_exists('.section.php')) {
                    $sectionFile = true;
                    require($_SERVER["DOCUMENT_ROOT"] . $pageDir . ".section.php");
                } else {
                    $sectionFile = false;
                }

            }

        }
        $dirAvailability = true;
    } else {
        $dirAvailability = false;
    }

    $detailPHP = false;
}
?>