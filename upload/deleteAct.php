<?php

function getLastActualities($number){
    $years = array_diff(scandir("./actuality", SCANDIR_SORT_DESCENDING), array('..', '.')) ;

    $actualities=[];
    $actualities_count=20;
    $actsWentThrough=0;
    
    foreach ($years as $year){ 
        $months = array_diff(scandir("./actuality/".$year, SCANDIR_SORT_DESCENDING), array('..', '.'));
        foreach($months as $month) {
            $articles = array_diff(scandir("./actuality/".$year."/".$month, SCANDIR_SORT_DESCENDING), array('..', '.'));
            foreach ($articles as $article) {
                $actsWentThrough++;
                array_push($actualities, "./actuality/".$year."/".$month."/".$article);
                if ($actsWentThrough == $actualities_count ){
                    break;
                }
            }
        }
        if( count($actualities) == $actualities_count ) {
            break;
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