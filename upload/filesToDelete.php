<?php
header('Content-type: text/html; charset=utf-8');

function removeOld($major, $minor) {
    $path = '../content/'.$major."/".$minor;
    $old = glob($path.".*");    
    echo sizeof($old);
    if (sizeof($old) == 0){
        return;
    }
    $old = current($old); // only one file should be present

    if (substr($old, -4) === ".htm"){
        $dir=$path.'_soubory';
        $files = glob($dir."/*"); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                unlink($file); // delete file
        }
        rmdir($dir);
        unlink($path.".htm");
    } else {
        unlink($path.".pdf");
        unlink($path.".htm");
    }
}

$option = isset($_POST['major']) ? $_POST['major'] : false;
if ($option) {
    $major = htmlentities($_POST['major'], ENT_QUOTES, "UTF-8");
} else {
    echo "main option is required\n";
}

$option = isset($_POST['minor']) ? $_POST['minor'] : false;
if ($option) {
    $minor = htmlentities($_POST['minor'], ENT_QUOTES, "UTF-8");
} else {
    echo "minor option is required";
}    

$signpost = "../content/".$major."/".$minor."/".$minor.".txt";
$handle = @fopen($signpost, "r");
$first=true;
$html="<option>Vyberte soubor pro smazání</option>";
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if ($first) {
            $first=false;
            continue;
        }
        $items = explode("_", $line);
        $html = $html . "<option value=" . $items[0] . ">" . $items[1] . "</options>";
    }

    fclose($handle);
}
echo $html;
?>