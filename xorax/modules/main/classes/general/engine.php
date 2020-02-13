<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 16/10/2019
 * Time: 08:47
 */
?>

<?
class Engine {

    private $_page_file = null;

    /**
     * Возвращает текст открытой страницы
     */
    public function getContentPage() {
        return file_get_contents("templates/" . $this->_page_file . ".php");
    }

    /**
     * Возвращает тег заголовок открытой страницы
     * @return string
     */
    public function getTitle() {
        global $SUBDIR;
        //Get URL without GET parameters
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . ".left.menu.php");

        /*
        foreach($menuLinks as &$arItem) {
            $arItem['TEXT'] = $arItem['0'];
            $arItem['LINK'] = $arItem['1'];
            unset($arItem['0']);
            unset($arItem['1']);

            if ($arItem['LINK'] == $uri_parts[0]) {?>
                <?=$arItem['TEXT'];?>
            <?}
        }
        */

        switch ($this->_page_file) {
            case "main":
                return "Главная страница сайта ox2.ru";
                break;
            case "about":
                return "О компании ox2.ru";
                break;
            case "ox2":
                return "Преимущества ox2.ru";
                break;
            default:
                break;
        }
    }

}
?>