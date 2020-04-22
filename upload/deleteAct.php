<?php

function getLastActualities($number){
    echo "in getLastActualities!";
    $years = array_diff(scandir("./actuality", SCANDIR_SORT_DESCENDING), array('..', '.')) ;

    $actualities=[];
    $actualities_count=3;
    foreach ($years as $year){ 
        $months = array_diff(scandir("./actuality/".$year, SCANDIR_SORT_DESCENDING), array('..', '.'));
        foreach($months as $month) {
            $articles = array_diff(scandir("./actuality/".$year."/".$month, SCANDIR_SORT_DESCENDING), array('..', '.'));
            if ( (count($articles) + count($actualities) < $actualities_count) ){
                foreach ($articles as $article) {
                array_push($actualities, "./actuality/".$year."/".$month."/".$article);
                }
            } else {
                $remaining=($actualities_count - count($actualities));
                $counter=0;
                foreach($articles as $article) {
                    array_push($actualities, "./actuality/".$year."/".$month."/".$article);
                    $counter++;
                    if($counter == $remaining) {
                        break;
                    }
                }
                break;
            }
        }
    } 
    $output='<table class="actuality_table"><tr>';
    foreach ($actualities as $act ) {
        $cont=file_get_contents($act);
        $handle = @fopen($act, "r");
        $title = fgets($handle);
        fclose($handle);
        $output=$output."<td>$title</td><td><input type='button' value='Smazat'></input></td></tr>";
    }
    $output=$output."</table>";
    echo $output;
}

?>