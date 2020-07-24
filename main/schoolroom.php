<?php
$galeryfile = "schoolroom/schoolroom.txt";
$text = "<table style=\"margin-left:10%;width:90%\">";
$counter=1;
$file = file($galeryfile);
$file = array_reverse($file);
$first = true;

foreach($file as $line){
    $pieces = explode("_", $line);
    if(count($pieces) == 1) {
        break;
    }

    $directory = "schoolroom/".$pieces[0];
    $files = scandir($directory);
    $firstFile = $directory."/".$files[2];

    switch ($counter%3) {
    case 1:
        $text=$text."<tr><td>";
        break;
    case 2:
    case 0:
        $text=$text."<td>";
        break;
}
$text=$text."<br><a href=\"#\" onclick=\"showSchoolroom('".$pieces[0]."')\"><img src=\"".$firstFile."\" width=\"100\" height=\"100\" style=\"border-radius: 50%; float:left; margin-right:20px\"><br>";
$text=$text.$pieces[1]."</a>";
switch ($counter%3) {
    case 1:
    case 2:
        $text=$text."</td>";
        break;
    case 3:
        $text=$text."</td></tr>";
        break;
}
$counter++;
}
if ($counter%3 != 0) {
    while ($counter%3 != 0) {
        $text=$text."<td></td>";
        $counter++;
    }
    $text=$text."</tr>";
}
$text=$text."</table>";
echo $text;
?>