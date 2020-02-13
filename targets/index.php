<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 11/08/2019
 * Time: 20:28
 */
?>

<?define("NEED_AUTH", true);?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/smartnote/local/templates/header.php");?>

<?
//Getting targets
$targets = $USER->Select('*', 'targets');
if($targets) {
    foreach ($targets as $target) {?>
        <span>Target Name: <?=$target['SECTION_NAME'];?></span><br>
        <span>Target Created: <?=$target['SECTION_CREATED'];?></span><br>
        <span>Target Deadline: <?=$target['SECTION_DEADLINE'];?></span><br>
        <span>Target Priority: <?=$target['SECTION_PRIORITY'];?></span><br>
        <a href="<?=$GENERAL_PAGE . 'targets/' . $target['SECTION_CODE'];?>">View</a> | <a href="<?=$uri_parts[0];?>?delete=<?=$target['SECTION_ID'];?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
        <br><br>
    <?}
} else {
    echo 'You don\'t have any target. But you are ready to create it.';
}
?>
    <br><br>
    <br><br>
<?
//insert info
$tgName = 'Достать луну';
$tgCode = 'tst';
$tgCreation = '2019-08-10 09:25:19';
$tgDeadline = '2020-08-10 09:25:19';
$tgSort = '300';

if ($_POST) {
    $arInsert = $USER->Insert('targets', 'SECTION_NAME, SECTION_CODE, SECTION_CREATED, SECTION_DEADLINE, SECTION_SORT', "$tgName, $tgCode, $tgCreation, $tgDeadline, $tgSort");
    ?>
    <script>
        window.location = 'https://xorax.ru/smartnote/targets/';
    </script>
    <?
} else {?>
    <form action="" method="post">
        <button type="submit" name="create">Create</button>
    </form>
<?}?>

<?
//delete info
$delete = false;
if(isset($_GET['delete'])){
    $delete = addslashes($_GET['delete']);
    $arDelete = $USER->Delete("targets", "SECTION_ID=$delete");
    ?>
    <script>
        window.location = 'https://xorax.ru/smartnote/targets/';
    </script>
    <?
} else {
    $delete = false;
}
?>

    <br><br>
    <br><br>

<?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/templates/footer.php");?>
