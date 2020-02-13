<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */

global $link;
$link = mysqli_connect($DBHost, $DBLogin, $DBPassword);// or die("Error: " . mysqli_error($link));
mysqli_select_db($link, $DBName);// or die("Error: database not found");
mysqli_query($link, 'SET NAMES utf8') or die("Error: " . mysqli_error($link));
mysqli_query($link, 'SET CHARACTER SET utf8') or die("Error: " . mysqli_error($link));
mysqli_query($link, 'SET COLLATION_CONNECTION="utf8_general_ci"') or die("Error: " . mysqli_error($link));
setlocale(LC_ALL,"ru_RU.UTF8");

// Check connection
if($link === false){
    @file_put_contents($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "logs/db_error.txt", print_r("{$currentDate} Error: Could not connect to DB: " . mysqli_connect_error($link), 1) . "\n", FILE_APPEND);
    die("Connection error.");
}
if(mysqli_select_db($link, $DBName) === false){
    @file_put_contents($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "logs/db_error.txt", print_r("{$currentDate} Error: Database not found.", 1) . "\n", FILE_APPEND);
    die("Connection error");
}

//Close connection
//mysqli_close($link);
?>
