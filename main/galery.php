<?php
function imagePart($number) {
    $directory = "./galery/".$number."/";
    $files = scandir ($directory);
    $firstFile = $directory . $files[2];
    return "<image src=\"".$firstFile."\" style=\"height:50px\"";
}

$subDir = array();
$galery = "./galery/";
$signpost = $galery."galery.txt";

$file = file($signpost);
$file = array_reverse($file);
$firstStart = "<tr><td>";
$firstEnd = "</td>";
$secondStart = "<td>";
$secondEnd = "</td></tr>";
$output = "<table>";
$first = true;
foreach($file as $line){
    $pieces = explode("_", $line);
    if(count($pieces) == 1) {
        break;
    }
    if($first) {
        $output = $output.$firstStart."<td>";
        $output = $output.imagePart($pieces[0])."</td><td>";
        $output = $output.$pieces[1]."<br>".$pieces[2].$firstEnd;
    } else {
        $output = $output.$secondStart."<td>";
        $output = $output.imagePart($pieces[0])."</td><td>";
        $output = $output.$pieces[1]."<br>".$pieces[2].$secondEnd;
    }
    $first = !$first;
}
$output = $output."</table>";
echo $output;
?>