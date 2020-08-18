<?php

function getSchRooms(){
    $schRoomFile = "./schoolroom/schoolroom.txt";
    $handle = @fopen($schRoomFile, "r");
    $number = fgets($handle);
    $text = "<table>";
    while (!feof($handle)) {
        $line=fgets($handle);
        $pieces = explode("_", $line);
        $text = $text."<tr><td>".$pieces[1]."</td><td><button onclick=\"deleteSchRoom('".$pieces[0]."')\">Odstranit</button></td></tr>";
    }
    fclose($handle);
    $text = $text."</table>";
    echo $text;
}

?>