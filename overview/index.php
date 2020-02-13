<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
?>

<?define("NEED_AUTH", true);?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/smartnote/local/templates/header.php");?>

<?
//check dir and subdir
/*
$dir = $_SERVER["DOCUMENT_ROOT"] . "/smartnote/";
$file = '.section.php';
$files = scandir($dir);
unset($files[array_search('.', $files, true)]);
unset($files[array_search('..', $files, true)]);

if (count($files) < 1)
    return;

foreach ($files as $d) {
    if (!is_dir($dir . '/' . $d)) {
        echo "SECTION ONE - FILE: ". $d . "<br>";

        if ($d == $file) {
            echo "SECTION ONE - FILE: ". $file . " FOUND.<br>";
            return $dir . "/" . $d;
        }
    } else {
        //echo "SECTION ONE - DIR: ". $d . "<br>";

        $res = $dir . "/" . $d;
        $subfiles = scandir($res);

        unset($subfiles[array_search('.', $subfiles, true)]);
        unset($subfiles[array_search('..', $subfiles, true)]);

        if (count($subfiles) < 1)
            return;

        foreach ($subfiles as $subD) {

            if (!is_dir($res . '/' . $subD)) {
                echo "SECTION TWO - FILE: ". $subD . "<br>";
                // need to add i++
                if ($subD == $file) {
                    //echo "SECTION TWO - FILE: ". $file . " FOUND.<br>";
                    return $res . "/" . $subD;
                }

            } else {
                //echo "SECTION TWO - DIR: ". $subD . "<br>";
            }

        }

    }
}
*/

// getting ID
/*
function FileSearch($dir, $file) {
    $files = scandir($dir);
    unset($files[array_search('.', $files, true)]);
    unset($files[array_search('..', $files, true)]);

    if (count($files) < 1)
        return;

    foreach ($files as $d) {
        if (!is_dir($dir . '/' . $d)) {
            if ($d == $file) {
                return $dir . "/" . $d;
            }
        } else {
            $res = FileSearch($dir . "/" . $d, $file);
            if ($res) {
                return $res;
            }
        }
    }
}

$file_path = FileSearch($_SERVER["DOCUMENT_ROOT"] . "/smartnote/", '.section.php');

if ($file_path) {
    $handle = fopen($file_path, 'r');
}
*/
?>




<?require($_SERVER["DOCUMENT_ROOT"] . $SUBDIR . "local/templates/footer.php");?>