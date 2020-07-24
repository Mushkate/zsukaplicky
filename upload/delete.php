<?php
header('Content-type: text/html; charset=utf-8');

function delete_files($target) {
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );      
        };
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

$option = isset($_POST['deleteMainSelect']) ? $_POST['deleteMainSelect'] : false;
if ($option) {
    $major = htmlentities($_POST['deleteMainSelect'], ENT_QUOTES, "UTF-8");
} else {
    echo "main option is required\n";
}

$option = isset($_POST['deleteMinorSelect']) ? $_POST['deleteMinorSelect'] : false;
if ($option) {
    $minor = htmlentities($_POST['deleteMinorSelect'], ENT_QUOTES, "UTF-8");
} else {
    echo "minor option is required";
}

$option = isset($_POST['deleteFileSelect']) ? $_POST['deleteFileSelect'] : false;
if ($option) {
    $file = htmlentities($_POST['deleteFileSelect'], ENT_QUOTES, "UTF-8");
} else {
    echo "file option is required <br>";
}

$folder = "../content/${major}/${minor}/${file}";

//todo - remove file and record in a .txt & .html files
delete_files($folder);

$signpost = "../content/".$major."/".$minor."/".$minor;
$signpost_txt = $signpost.".txt";
$signpost_html = $signpost.".htm";

$signpost_txt_file = file($signpost_txt);

// update txt file
$newFile = $signpost."2.txt";
$newFileHandle = fopen($newFile, "w");
$handle = fopen($signpost_txt, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        if (substr($line, 0, strlen($file)+1) === $file."_"){
        } else {
            fwrite($newFileHandle, $line);
        }
    }

    fclose($handle);
    fclose($newFileHandle);
    rename($newFile, $signpost_txt);
} else {
    // error opening the file.
} 

// update htm file
$handle_htm = @fopen($signpost_html, "w+");
$handle_txt= @fopen($signpost_txt, "r");
$start = true;
$content = "<h3> Rozcestník </h3><br><br>";

if (($handle = fopen($signpost_txt, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "_")) !== FALSE) {
        if ($start == true) {
            $start = false;
            continue;
        }
        $content = $content.'<a  href="#" onclick="loadArticleJS(\''.$major.'\',\''.$minor.'\',\''.$data[0].'\')">'.$data[1].'</a><br>';    
    }
    fclose($handle);
}
echo $content;
fwrite($handle_htm, $content);
fclose($handle_htm);
echo "<br><input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";


?>