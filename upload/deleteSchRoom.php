<?php

function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file ); 
            print("file ".$file." deleted");     
        };
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

// --- DELETE FILES AND FOLDER ---
$id = $_POST['id'];
$dir = "../schoolroom/".$id;
delete_files($dir."/");
rmdir($dir);

// --- DELETE LINE FROM schoolroom.txt ---
$newFile = "../schoolroom/2.txt";
$newFileHandle = fopen($newFile, "w");
$handle = fopen("../schoolroom/schoolroom.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (substr($line, 0, strlen($id)+1) === $id."_"){
        } else {
            fwrite($newFileHandle, $line);
        }
    }

    fclose($handle);
    fclose($newFileHandle);
    //unlink("../galery/galery.txt");
    rename($newFile, "../schoolroom/schoolroom.txt");
} else {
    // error opening the file.
} 
?>