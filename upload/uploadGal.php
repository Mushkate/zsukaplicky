<?php

// extract($_POST);
// $error=array();
// $extension=array("jpeg","jpg","png","gif");
// foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
// echo $key."<br>";
// $file_name=$_FILES["files"]["name"][$key];
// $file_tmp=$_FILES["files"]["tmp_name"][$key];
// $ext=pathinfo($file_name,PATHINFO_EXTENSION);
// echo "uploading file ".$file_name."<br>";
// if(in_array($ext,$extension)) {
//     if(!file_exists("./".$file_name)) {
//         if ( move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"./".$file_name) ) { echo "passed"; } else { echo "ERROR to upload files."; };
//     }
//     else {
//         $filename=basename($file_name,$ext);
//         $newFileName=$filename.time().".".$ext;
//         if (move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"./".$newFileName)) { echo "passed"; } else { echo "ERROR uploading file."; };
//         // if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $dir.$name)) { echo "passed"; } else {    echo "ERROR uploading your file. Try it again.<br>"; 	};

//     }
// }
// else {
//     array_push($error,"$file_name, ");
// }
// }


$title = $_POST['GalTitle'];
$date = $_POST['GalDate'];

echo $title;
echo "<br>";
echo $date;

// --- CREATE SIGNPOST IN SPECIFIED FOLDER ---
$signpost = "../galery/galery.txt";

if(!file_exists(dirname($signpost))) {
    mkdir(dirname($signpost), 0777, true);
}

if(!file_exists($signpost)){
    $handle = @fopen($signpost, "w+");
    fwrite($handle, "1\n");
    fwrite($handle, "1_".$title."_".$date); //the author should be added to the last column
    $newindex=intval("1");
} else {
    $handle = @fopen($signpost, "r");
    $index = intval(fgets($handle));
    $newindex = ($index+1);
    fclose($handle);
    $handle = @fopen($signpost, "a");
    fwrite($handle, "\n".($newindex)."_".$title."_".$date);

    $lines = file($signpost, FILE_IGNORE_NEW_LINES);
    $lines[0] = ($newindex);
    file_put_contents($signpost , implode("\n", $lines));
}

fclose($handle);

// --- CREATE SIGNPOST IN SPECIFIED FOLDER ---
$count = 0;

$dir="../galery/".$newindex."/";
mkdir($dir, 0777, true);
$countfiles = count($_FILES['files']['name']);
echo "<br> countfiles:".$countfiles."<br>";
//foreach ($_FILES['files']['name'] as $i => $name) {     
for($i=0; $i<$countfiles; $i++) {
    echo "i:".$i;
    echo "<br>";
    $name=$_FILES['files']['name'][$i];
    echo "name:".$name."<br>";

    if (move_uploaded_file($file_tmp=$_FILES['files']['tmp_name'][$i], $dir.$name)) { echo "passed"; } else {    echo "ERROR uploading your file. Try it again.<br>"; 	};

//move_uploaded_file($_FILES['files']['tmp_name'][$i],$dir.$name);
}

?>