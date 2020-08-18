<?php

$page = $_GET['page'];
if ($page > 0 ) {
    $actPerPage=10;
    $startIndex=($page-1)*$actPerPage;
    $endIndex=$page*$actPerPage;
} else {
    $actPerPage=3;
    $startIndex=0;
    $endIndex=3;
}

$years = array_diff(scandir("../actuality", SCANDIR_SORT_DESCENDING), array('..', '.')) ;

$actsWentThrough=0;
//print_r($years);
//print(count($scanned_directory));
$actualities=[];

foreach ($years as $year){ 
    $months = array_diff(scandir("../actuality/".$year, SCANDIR_SORT_DESCENDING), array('..', '.'));
    foreach($months as $month) {
        $articles = array_diff(scandir("../actuality/".$year."/".$month, SCANDIR_SORT_DESCENDING), array('..', '.'));
        foreach ($articles as $article) {
            $actsWentThrough++;
            if ($actsWentThrough > $startIndex ) {
                array_push($actualities, "../actuality/".$year."/".$month."/".$article);
            }
            if ($actsWentThrough == $endIndex ){
                break;
            }
        }
        if ($actsWentThrough == $endIndex ){
            break;
        }
    }
    if( count($actualities) == $actPerPage ) {
        break;
    }
} 

$output='<table class="actuality_table"><tr>';
if ($page < 0 ) {
    $output='<h2>Aktuality</h2>'.$output;
}
foreach ($actualities as $act ) {
    $cont=file_get_contents($act);
    $handle = @fopen($act, "r");
    $title = fgets($handle);
    $text = fgets($handle);
    while (!feof($handle)) {
        $newLine=fgets($handle);
        $text=$text."<br>".$newLine;
    }
    fclose($handle);
    if ($page > 0) {
        $output=$output."<td><div class='actuality'><p>".$title."</p><br>".$text."<br></div></td></tr>";
    } else {
        $output=$output."<td><div class='actuality'><p style=\"font-weight:bold\">".$title."</p><br>".$text."<br></div></td></tr>";
    }
}
$output=$output."</table>";
echo $output;
?>