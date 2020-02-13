<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
?>

<ul class="leftNavInfoBlock">
    <?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . ".left.menu.php");?>

    <?foreach($menuLinks as &$arItem) {
            $arItem['TEXT'] = $arItem['0'];
            $arItem['LINK'] = $arItem['1'];
            unset($arItem['0']);
            unset($arItem['1']);?>

        <?$arItem['LINK'];?>

        <li class="nav_li paddingBottom_oFive <?if ($arItem['LINK'] == $uri_parts[0]) {?>active<?}?>">
            <a href="<?=$arItem['LINK'];?>" class="nav_a">
            <?=$arItem['TEXT'];?>
            </a>
        </li>

    <?}?>
</ul>