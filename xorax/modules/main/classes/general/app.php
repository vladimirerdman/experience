<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 13/09/2019
 * Time: 09:15
 */
?>

<?
class Application {

    public function IncludeComponent($componentName, $componentTemplate, $arParams, $parentComponent) {
        //global $USER;

        //here is the code for $componentName
        if (!empty($componentName)) {
            $arComponentName = explode(':', $componentName, 2);
            //dir
            if ($arComponentName[0] == 'xorax') {
                echo 'default<br>';
            } elseif ($arComponentName[0] == 'local') {
                echo 'own<br>';
            } else {
                return null;
            }
            //component name
            if (!empty($arComponentName[1])) {
                echo $arComponentName[1] . '<br>';
            } else {
                return null;
            }
        } else {
            return null;
        }

        //here is the code for $componentTemplate
        if (!empty($componentTemplate)) {
            echo $componentTemplate . '<br>';
        } else {
            return null;
        }

        //start $arParams
        if (!empty($arParams)) {
            echo '<pre>';
            //var_dump($arParams);
            echo '</pre>';

            if (!empty($arParams["IBLOCK_TYPE"])) {

                //meta
                /*
                $arMeta = Array();
                if (!empty($arParams['META_DESCRIPTION']) && $arParams['SET_META_DESCRIPTION'] == 'Y') {
                    $arMeta[] = $arParams['META_DESCRIPTION'];
                    echo 'desc' . $arParams['META_DESCRIPTION'] . '<br>';
                }
                if (!empty($arParams['META_KEYWORDS']) && $arParams['SET_META_KEYWORDS'] == 'Y') {
                    $arMeta[] = $arParams['META_KEYWORDS'];
                }
                if (!empty($arParams['META_ROBOTS']) && $arParams['SET_META_ROBOTS'] == 'Y') {
                    $arMeta[] = $arParams['META_ROBOTS'];
                }
                $meta = implode(", ", $arMeta);
                $arMetaResult = $USER->SelectRow("$meta", $arParams["IBLOCK_TYPE"], "SECTION_CODE='{$arParams['ELEMENT_CODE']}'");
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
                */

            } else {
                return null;
            }



        } else {
            return null;
        }

        //here is the code for $parentComponent
        if ($parentComponent) {
            echo $parentComponent . '<br>';
        } else {
            return null;
        }

    }

    public function ShowTitle() {

    }

}
$APPLICATION = new Application();
?>