<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
?>

<?define("NEED_AUTH", true);?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/smartnote/local/templates/header.php");?>

<?
//user info
$arAccess = $USER->SelectRowJoin(
    '*',
    'users as u',
    'LEFT JOIN roles_n_users as rnu ON u.USER_ID = rnu.USER_ID
          LEFT JOIN roles_of_users as rou ON rnu.ROLE_ID = rou.ROLE_ID',
    "USER_EMAIL='".$_SESSION['email']."'",
    "IS_STAFF=1"
);
echo '<pre>';
var_dump($arAccess);
echo '</pre>';

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
?>

<br><br>
<br><br>
<br><br>
<br><br>

<?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/templates/footer.php");?>
