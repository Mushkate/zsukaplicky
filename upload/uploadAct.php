<?php
header('Content-type: text/html; charset=utf-8');

$title = $_POST['ActTitle'];
$text = $_POST['ActText'];

echo $title;
echo "<br>";
echo $text;

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