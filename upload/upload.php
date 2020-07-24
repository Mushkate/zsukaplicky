<?php
header('Content-type: text/html; charset=utf-8');

function uploadPdf($newPathAndFileNameWithoutSuffix) {
    $info = pathinfo($_FILES['pdfFile']['name']);
    $ext = $info['extension']; // get the extension of the file
    
    if ($ext != "pdf") {
        echo "<img src=\"../images/red-cross.png\" style=\"height: 20px\"></img> Nahraný soubor není ve formátu PDF! Soubor nebyl aktualizován.";
        return false;
    }

    $target_pdf = $newPathAndFileNameWithoutSuffix.".pdf";
    $target_htm = $newPathAndFileNameWithoutSuffix.".htm";

    move_uploaded_file( $_FILES['pdfFile']['tmp_name'], $target_pdf);
    $newFile = fopen($target_htm, "w");
    $content = '<object data="content/'.$newPathAndFileNameWithoutSuffix.'.pdf" type="application/pdf" width="100%" height="800">
    alt : <a href="'.$newPathAndFileNameWithoutSuffix.'.php">PDF for you</a>
    </object>';
    fwrite($newFile, $content);
    fclose($newFile);
    return true;
}

function uploadWord($newPathAndFileNameWithoutSuffix) {
    $count = 0;
    $dir="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        foreach ($_FILES['files']['name'] as $i => $name) {            
            if (substr($name, -4) === ".htm"){
                $dir="../content/".$newPathAndFileNameWithoutSuffix."_soubory/";
                $newfile = "../content/".$newPathAndFileNameWithoutSuffix."1.htm";
                mkdir($dir, 0777, true);
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $newfile);

                //replace path to renamed folder
                $oldFolder = substr($name, 0, -4)."_soubory";
                $str=file_get_contents($newfile);

                //replace something in the file string - this is a VERY simple example
                $str=str_replace($oldFolder, "content/".$newPathAndFileNameWithoutSuffix."_soubory", $str);
                
                //convert to utf-8
                // $str=str_replace("windows-1250", "utf-8", $str);
                // iconv('WINDOWS-1250', 'UTF-8', $str);

                //write the entire string
                file_put_contents("../content/".$newPathAndFileNameWithoutSuffix.".htm", $str);
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

function delete_files($target) {
    getcwd();
    if(is_dir($target)){
        $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

        foreach( $files as $file ){
            delete_files( $file );   
        };
         
        rmdir($target);  
    } elseif(is_file($target)) {
        unlink( $target );  
    }
}

$option = isset($_POST['insertMainSelect']) ? $_POST['insertMainSelect'] : false;
if ($option) {
    $major = htmlentities($_POST['insertMainSelect'], ENT_QUOTES, "UTF-8");
} else {
    echo "main option is required\n";
}

$option = isset($_POST['insertMinorSelect']) ? $_POST['insertMinorSelect'] : false;
if ($option) {
    $minor = htmlentities($_POST['insertMinorSelect'], ENT_QUOTES, "UTF-8");
} else {
    echo "minor option is required";
}

$option = isset($_POST['fileType']) ? $_POST['fileType'] : false;
if ($option) {
    $filetype = htmlentities($_POST['fileType'], ENT_QUOTES, "UTF-8");
} else {
    echo "fileType option is required";
}

$option = isset($_POST['title']) ? $_POST['title'] : false;
if ($option) {
    $title = htmlentities($_POST['title'], ENT_QUOTES, "UTF-8");
} else {
    echo "title must be inserted";
}


// --- CREATE SIGNPOST IN SPECIFIED FOLDER ---
// sections: Organizace, Pedagogický sobr, Školská rada, Bezpečná škola, Dětský parlament, Školní řád, Úvodní stránka - mají jen jeden soubor
$noSignpost = ["Organizace", "PedagogickySbor", "SkolskaRada", "BezpecnaSkola", "DetskyParlament", "SkolniRad", "UvodniStranka"];
            
if ( in_array($minor, $noSignpost)){
} else {
    $signpost = "../content/".$major."/".$minor."/".$minor.".txt";
    if(!file_exists(dirname($signpost))) {
        mkdir(dirname($signpost), 0777, true);
    }

    if(!file_exists($signpost)){
        $handle = @fopen($signpost, "w+");
        fwrite($handle, "1\n");
        fwrite($handle, "1_".$title); //the author should be added to the last column
        $newindex=intval("1");
    } else {
        $handle = @fopen($signpost, "r");
        $index = intval(fgets($handle));
        $newindex = ($index+1);
        fclose($handle);
        $handle = @fopen($signpost, "a");
        fwrite($handle, "\n".($newindex)."_".$title);

        $lines = file($signpost, FILE_IGNORE_NEW_LINES);
        $lines[0] = ($newindex);
        file_put_contents($signpost , implode("\n", $lines));
    }

    fclose($handle);
}

// --- CREATE A DIR FOR UPLOADED FILES AND UPLOAD FILES
if ( in_array($minor, $noSignpost)){
    $newfolder = "../content/".$major."/".$minor."/";
    $newPathAndFileNameWithoutSuffix=$newfolder.$minor;
    if(file_exists($newfolder)) {
        delete_files($newfolder);
    }
    mkdir($newfolder, 0777, true);
} else {
    $newfolder=dirname($signpost)."/".$newindex."/";
    $newPathAndFileNameWithoutSuffix=dirname($signpost)."/".$newindex."/".$newindex;
    mkdir($newfolder, 0777, true);
}

if ($filetype == "pdf") {
    if (uploadPdf($newPathAndFileNameWithoutSuffix)){
        echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubor byl nahrán.";
    }
} else {
    uploadWord($newPathAndFileNameWithoutSuffix);
    echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubory byly nahrány.";
}

echo "<br><br>";
echo "<input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";
echo "<input type='submit' value='Nahrát další článek'onclick=\"window.location='../../approve.php';\" />";

// --- REFRESH SIGHNPOST HTML FILE
if ( ! in_array($minor, $noSignpost)){
    $signpost_html = "../content/".$major."/".$minor."/".$minor.".htm";
    if(!file_exists(dirname($signpost_html))) {
        mkdir(dirname($signpost_html), 0777, true);
    }

    $handle_htm = @fopen($signpost_html, "w+");
    $handle_txt= @fopen($signpost, "r");
    $start = true;
    $content = "<div style=\"text-align: center;\"><h1> Rozcestník </h1><br><br>";
    if (($handle = fopen($signpost, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, "_")) !== FALSE) {
            if ($start == true) {
                $start = false;
                continue;
            }
            $content = $content.'<a  href="#" onclick="loadArticleJS(\''.$major.'\',\''.$minor.'\',\''.$data[0].'\')">'.$data[1].'</a><br>';    
        }
        fclose($handle);
    }
    $content=$content."</div>";
    echo $content;
    fwrite($handle_htm, $content);
    fclose($handle_htm);
}
?>