<?php
session_start();

echo session_id();

header('Content-type: text/html; charset=utf-8');

$title = $_POST['ActTitle'];
$text = $_POST['ActText'];

echo $title;
echo "<br>";
echo $text;

echo "<br><br>";
echo "<input type='submit' value='Domů'onclick=\"window.location='../../index.php';\" />  ";
echo "<input type='submit' value='Nahrát další článek'onclick=\"window.location='../../approve.php';\" />";

// --- CREATE SIGNPOST IN SPECIFIED FOLDER ---
$year = date("Y");
$month = date("m");
$timestamp = time();
$signpost = "../actuality/".$year."/".$month."/".$timestamp.".txt";

if(!file_exists(dirname($signpost))) {
    mkdir(dirname($signpost), 0777, true);
}

$handle = @fopen($signpost, "w+");
fwrite($handle, $title."\n");
fwrite($handle, $text);

fclose($handle);



?>