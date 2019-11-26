<?php
header('Content-type: text/html; charset=utf-8');

function uploadPdf($newfolder, $newindex) {
    $info = pathinfo($_FILES['pdfFile']['name']);
    $ext = $info['extension']; // get the extension of the file
    
    if ($ext != "pdf") {
        echo "<img src=\"../images/red-cross.png\" style=\"height: 20px\"></img> Nahraný soubor není ve formátu PDF! Soubor nebyl aktualizován.";
        return false;
    }

    $target_pdf = $newfolder."/".$newindex.".pdf";
    $target_htm = $newfolder."/".$newindex.".htm";

    move_uploaded_file( $_FILES['pdfFile']['tmp_name'], $target_pdf);
    $newFile = fopen($target_htm, "w");
    $content = '<object data="content/'.$newfolder."/".$newindex.'.pdf" type="application/pdf" width="100%" height="100%">
    alt : <a href="'.$newfolder."/".$newindex.'.php">PDF for you</a>
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
    echo $title;
} else {
    echo "title must be inserted";
}


// --- CREATE SIGNPOST IN SPECIFIED FOLDER ---
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

// --- CREATE A DIR FOR UPLOADED FILES AND UPLOAD FILES
$newfolder=dirname($signpost)."/".$newindex."/";
echo "\nCreating dir for files storing: ".$newfolder."\n";
mkdir($newfolder, 0777, true);
echo "After mkdir\n";

if ($filetype == "pdf") {
    if (uploadPdf($newfolder, $newindex)){
        echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubor byl nahrán.";
    }
} else {
    uploadWord($newfolder, $newindex);
    echo "<img src=\"../images/green-tick.png\" style=\"height: 20px\"></img>Soubory byly nahrány.";
}

echo "<br><br>";
echo "<input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";
echo "<input type='submit' value='Nahrát další článek'onclick=\"window.location='../../approve.php';\" />";

// --- REFRESH SIGHNPOST HTML FILE

$signpost_html = "../content/".$major."/".$minor."/".$minor.".htm";
if(!file_exists(dirname($signpost_html))) {
    mkdir(dirname($signpost_html), 0777, true);
}

$handle_htm = @fopen($signpost_html, "w+");
$handle_txt= @fopen($signpost, "r");
$start = true;
$content = "<h3> Rozcestník </h3><br><br>";
while (($line = fgets($handle_txt)) !== false) {
    if ($start == true) {
        $start = false;
        continue;
    }
    $Data = str_getcsv($line, "_");
    echo $Data[1];
    $content = $content.'<a  href="#" onclick="loadArticleJS(\''.$major.'\',\''.$minor.'\',\''.$Data[0].'\')">'.$Data[1].'</a><br>';    
}
echo $content;
fwrite($handle_htm, $content);
fclose($handle_htm);

?>