<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 11/08/2019
 * Time: 20:28
 */
?>

<?$META = array(
    "ELEMENT_CODE" => 'SECTION_CODE',
    "IBLOCK_TYPE" => "targets",
    "META_DESCRIPTION" => 'SECTION_DESCRIPTION',
    "META_KEYWORDS" => 'SECTION_KEYWORDS',
    "META_ROBOTS" => 'SECTION_ROBOTS',
    "SET_META_DESCRIPTION" => "Y",
    "SET_META_KEYWORDS" => "Y",
    "SET_META_ROBOTS" => "Y",
)?>

<?define("NEED_AUTH", true);?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/smartnote/local/templates/header.php");?>

<?//$APPLICATION->SetTitle("Курс");?>
<?$APPLICATION->IncludeComponent(
    "local:news.detail",
    "target_det",
    array(
        //"ACTIVE_DATE_FORMAT" => "j F Y",
        //"ADD_ELEMENT_CHAIN" => "Y",//Добавить элемент в цепочку навигации
        //"ADD_SECTIONS_CHAIN" => "Y",//Добавить разделы в цепочку навигации
        //"AJAX_MODE" => "N",//Включить режим AJAX
        //"AJAX_OPTION_ADDITIONAL" => "",//Дополнительный идентификатор
        //"AJAX_OPTION_HISTORY" => "N",//Включить эмуляцию навигации браузера
        //"AJAX_OPTION_JUMP" => "N",//Включить прокрутку к началу компонента
        //"AJAX_OPTION_STYLE" => "Y",//Включить подгрузку стилей
        //"BROWSER_TITLE" => "-",
        //"CACHE_GROUPS" => "Y",//учитывать права доступа
        //"CACHE_TIME" => "36000000",//показывать количество элементов в разделе
        //"CACHE_TYPE" => "A",//тип кеширования
        //"CHECK_DATES" => "Y",//Показывать только активные на данный момент элементы
        //"DETAIL_URL" => "",//URL, ведущий на страницу с содержимым элемента раздела
        //"DISPLAY_BOTTOM_PAGER" => "Y",//Выводить под списком
        //"DISPLAY_DATE" => "Y",//Выводить дату элемента
        //"DISPLAY_NAME" => "Y",//Выводить название элемента
        //"DISPLAY_PICTURE" => "Y",//Выводить изображение для анонса
        //"DISPLAY_PREVIEW_TEXT" => "Y",//Выводить текст анонса
        //"DISPLAY_TOP_PAGER" => "N",//Выводить над списком
        "ELEMENT_CODE" => $paramSection,
        "ELEMENT_ID" => '',//элемент
        "FIELD_CODE" => Array(),
        "IBLOCK_ID" => "21",//инфоблок
        "IBLOCK_TYPE" => "targets",//тип инфоблока
        //"IBLOCK_URL" => "",
        //"INCLUDE_IBLOCK_INTO_CHAIN" => "N",//Включить инфоблок в цепочку навигации
        //"MESSAGE_404" => "",//Сообщение для показа (по умолчанию из компонента)
        "SET_LAST_MODIFIED" => "N",//Устанавливать в заголовках ответа время модификации страницы
        "SET_BROWSER_TITLE" => "Y",//Устанавливать заголовок окна браузера
        "SET_PAGE_TITLE" => "Y",//Устанавливать заголовок страницы
        "META_DESCRIPTION" => 'SECTION_DESCRIPTION',
        "META_KEYWORDS" => 'SECTION_KEYWORDS',
        "META_ROBOTS" => 'SECTION_ROBOTS',
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_META_ROBOTS" => "Y",
        /*"PROPERTY_CODE" => array(//Свойства
            0 => "year",
            1 => "len",
            2 => "day",
            3 => "int",
            4 => "hours",
            5 => "mesto2",
            6 => "nagr",
            7 => "price",
            8 => "uch",
            9 => "cel",
            10 => "",
        ),
        */
        //"SET_CANONICAL_URL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",//Включить обработку ссылок
        "PAGER_SHOW_ALL" => "N",//Показывать ссылку "Все"
        "PAGER_TEMPLATE" => ".default",//Шаблон постраничной навигации
        "PAGER_TITLE" => "Страница",//Название категорий
        //"SET_STATUS_404" => "Y",//Устанавливать статус 404
        //"SHOW_404" => "Y",//Показ специальной страницы
        //"USE_PERMISSIONS" => "N",
        //"USE_SHARE" => "N",
        //"FILE_404" => "",
        "COMPONENT_TEMPLATE" => ""
    ),
    true
);?>

<?$arResult = $USER->SelectRow("*", $META["IBLOCK_TYPE"], "SECTION_CODE='$paramSection'");?>

<?if($_POST) {

    $targetName = $_REQUEST['targetName'];
    $targetCode = $_REQUEST['targetCode'];
    $targetDescription = $_REQUEST['targetDescription'];
    $targetKeywords = $_REQUEST['targetKeywords'];
    $targetDeadline = $_REQUEST['targetDeadline'];
    $targetPriority = $_REQUEST['targetPriority'];
    $targetSort = $_REQUEST['targetSort'];

    if($arResult) {
        $sectionCode = $arResult['SECTION_CODE'];
        $USER->Update($META["IBLOCK_TYPE"], "SECTION_NAME = '$targetName', SECTION_CODE = '$targetCode', SECTION_DESCRIPTION = '$targetDescription', SECTION_KEYWORDS = '$targetKeywords', SECTION_DEADLINE = '$targetDeadline', SECTION_PRIORITY = '$targetPriority', SECTION_SORT = '$targetSort'", "SECTION_CODE='$sectionCode'");
    }
?>

    <script>
        window.location = 'https://xorax.ru/smartnote/targets/';
    </script>

<?} else {

    if($arResult) {?>

<form action="" method="POST">
    <span>Name: </span><input type="text" name="targetName" value="<?=$arResult["SECTION_NAME"];?>" /><br>
    <span>Code: </span><input type="text" name="targetCode" value="<?=$arResult["SECTION_CODE"];?>" /><br>
    <span>Description: </span><input type="text" name="targetDescription" value="<?=$arResult["SECTION_DESCRIPTION"];?>" /><br>
    <span>Keywords: </span><input type="text" name="targetKeywords" value="<?=$arResult["SECTION_KEYWORDS"];?>" /><br>
    <span>Deadline: </span><input type="text" name="targetDeadline" value="<?=$arResult["SECTION_DEADLINE"];?>" /><br>
    <span>Priority: </span><input type="text" name="targetPriority" value="<?=$arResult["SECTION_PRIORITY"];?>" /><br>
    <span>Sort: </span><input type="text" name="targetSort" value="<?=$arResult["SECTION_SORT"];?>" /><br>

    <input id="" type="submit" name="submit" value="Сохранить" class="btn btn-lg btn-primary"/>
</form>

    <?}
}?>

<?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/templates/footer.php");?>