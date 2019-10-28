<?php
header('Content-type: text/html; charset=utf-8');

function uploadPdf($major, $minor) {
    $info = pathinfo($_FILES['pdfFile']['name']);
    $ext = $info['extension']; // get the extension of the file
    
    if ($ext != "pdf") {
        echo "<img src=\"../images/red-cross.png\" style=\"height: 20px\"></img> Nahraný soubor není ve formátu PDF! Soubor nebyl aktualizován.";
        return false;
    }

    $target_pdf = "../content/".$major."/".$minor.".".$ext;
    $target_htm = "../content/".$major."/".$minor.".htm";
    if(!file_exists(dirname($target_pdf))) {
        mkdir(dirname($target_pdf), 0777, true);
    }
    move_uploaded_file( $_FILES['pdfFile']['tmp_name'], $target_pdf);
    $newFile = fopen($target_htm, "w");
    $content = '<object data="content/'.$major.'/'.$minor.'.pdf" type="application/pdf" width="100%" height="100%">
    alt : <a href="data/test.pdf">test.pdf</a>
    </object>';
    fwrite($newFile, $content);
    fclose($newFile);
    return true;
}

function uploadWord($major, $minor) {
    $count = 0;
    $dir="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        foreach ($_FILES['files']['name'] as $i => $name) {            
            if (substr($name, -4) === ".htm"){
                $dir="../content/".$major."/".$minor."_soubory/";
                $newfile = "../content/".$major."/".$minor."1.htm";
                mkdir($dir, 0777, true);
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $newfile);

                //replace path to renamed folder
                $oldFolder = substr($name, 0, -4)."_soubory";
                $str=file_get_contents($newfile);

                //replace something in the file string - this is a VERY simple example
                $str=str_replace($oldFolder, "content/".$major."/".$minor."_soubory", $str);
                
                //convert to utf-8
                // $str=str_replace("windows-1250", "utf-8", $str);
                // iconv('WINDOWS-1250', 'UTF-8', $str);

                //write the entire string
                file_put_contents("../content/".$major."/".$minor.".htm", $str);
                break;
            }
        }
        foreach ($_FILES['files']['name'] as $i => $name) {            
            if (substr($name, -4) === ".htm"){
                continue;
            }
            move_uploaded_file($_FILES['files']['tmp_name'][$i],$dir.$name);
        }
    }
}

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

    $option = isset($_POST['fileType']) ? $_POST['fileType'] : false;
    if ($option) {
        $filetype = htmlentities($_POST['fileType'], ENT_QUOTES, "UTF-8");
    } else {
        echo "fileType option is required";
    }
    
    removeOld($major, $minor);

    if ($filetype == "pdf") {
        if (uploadPdf($major, $minor)){
            echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubor byl aktualizován.";
        }
    } else {
        uploadWord($major, $minor);
        echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubory byly aktualizovány.";
    }

    echo "<br><br>";
    echo "<input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";
    echo "<input type='submit' value='Nahrát další článek'onclick=\"window.location='../../form.php';\" />";

    
?>