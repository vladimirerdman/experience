<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 08/09/2019
 * Time: 12:59
 */
?>

<?
class LANGSwitch {

    /**
     * @param $to
     * @return string
     *
     * Generate new URL based on user choice
     */
    public function SwitchLang($to) {
        global $arLanguages;
        global $langDefault;
        global $url;

        if ($to !== $langDefault) {
            //if LANG from DB not found in the URL
            if (!isset($arLanguages[$url[2]]) || !array_key_exists("$url[2]", $arLanguages)) {
                //add language into the URL
                array_splice($url, 2, 0, Array($to));
                $newUrl = implode("/", $url);
                return $newUrl;
            } else {
                //replace language from the URL
                $changeUrl = array_replace($url, Array(2 => $to));
                $newUrl = implode("/", $changeUrl);
                return $newUrl;
            }
        } else {
            //if LANG from DB found in the URL
            if (isset($arLanguages[$url[2]]) || array_key_exists("$url[2]", $arLanguages)) {
                //Remove LANG from the URL but not from an array
                $changeUrl = array_diff_key($url, array_flip((array) 2));
                $newUrl = implode("/", $changeUrl);
                return $newUrl;
            }
        }
    }

    /**
     * @param $to
     * @param $response_number
     *
     * Redirection to an URL based on user language
     */
    public function Redirect($to, $response_number) {
        global $SUBDIR;
        global $langDefault;

        if (LANGUAGE_ID !== $langDefault) {
            //header('HTTP/1.1 200 OK');
            //http_response_code(201);
            //header("Status: 200 All rosy");
            //header('HTTP/1.1 301 Moved Permanently');
            header("Location: " . $SUBDIR . LANGUAGE_ID . "/" . $to, true, $response_number);
            die();
        } else {
            header("Location: " . $SUBDIR . $to, true, $response_number);
            die();
        }
    }

}
$URL = new LANGSwitch();
?>