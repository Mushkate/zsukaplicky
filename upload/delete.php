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
    echo "Hello from deleting of a file!"
    $option = isset($_POST['mainSelect']) ? $_POST['mainSelect'] : false;
    if ($option) {
        $major = htmlentities($_POST['mainSelect'], ENT_QUOTES, "UTF-8");
    } else {
        echo "main option is required\n";
    }
    
    $option = isset($_POST['minorSelect']) ? $_POST['minorSelect'] : false;
    if ($option) {
        $minor = htmlentities($_POST['minorSelect'], ENT_QUOTES, "UTF-8");
    } else {
        echo "minor option is required";
    }
    
    echo "File to be deleted is in: " + $major + "/" + $minor;
    //removeOld($major, $minor);

    echo "<input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";

    
?>