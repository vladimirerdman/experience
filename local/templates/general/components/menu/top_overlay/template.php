<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
?>

<div class="topNavOverlay">
    <ul class="topNavOverlay_ul">
        <?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . ".left.menu.php");?>

        <?
        foreach($menuLinks as &$arItem) {
                $arItem['TEXT'] = $arItem['0'];
                $arItem['LINK'] = $arItem['1'];
                unset($arItem['0']);
                unset($arItem['1']);
        ?>

        <li class="nav_li <?if ($arItem['LINK'] == $uri_parts[0]) {?>active<?}?>">
            <a href="<?=$arItem['LINK'];?>" data-text="<?=$arItem['TEXT'];?>" class="nav_a">
            <?=$arItem['TEXT'];?>
            </a>
        </li>

        <?}?>
    </ul>
</div>