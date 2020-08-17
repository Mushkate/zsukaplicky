 <?php
echo "<div style=\"margin:20px\"><a href=\"./galery.php\"> &larr; Zpět do galerie<br><br></a></div>";
$galeryNumber = $_POST['name'];
  
$signpost = "../galery/galery.txt";
$file = file($signpost);
$text = "";
foreach($file as $line){
  if (substr($line, 0, strlen($galeryNumber)+1) === $galeryNumber."_"){
    $pieces = explode("_", $line);
    $text = "<div style=\"text-align:center\"><h1>".$pieces[1]."<h1><h3 style=\"text-align:center\">".$pieces[2]."</h3><br><br></div>";
    break;
  }
}

$files = scandir('../galery/'.$galeryNumber);
$counter=1;
$pictures_per_row=7;
foreach($files as $file) {
  if ( $file == "." || $file == ".." ) continue;
  if ($counter%$pictures_per_row == 1) {
    $text = $text."<div class=\"row\">";
  }
  $text = $text."<div class=\"column\">
    <img src=\"./galery/".$galeryNumber."/".$file."\" alt=\"Obrazek zde\" onclick=\"enlargeImage(this);\">
  </div>";
  if ($counter%$pictures_per_row == 0) {
    $text = $text."</div>";
  }
  $counter++;
}
if ($counter%$pictures_per_row != 0 ) {
  $text = $text."</div>";
}
$text= $text."<!-- The expanding image container -->
<div class=\"container\">
  <!-- Close the image -->
  <span onclick=\"this.parentElement.style.display='none'\" class=\"closebtn\">&times;</span>

  <!-- Expanded image -->
  <img id=\"expandedImg\" >

  <!-- Image text -->
  <div id=\"imgtext\"></div>
</div>";

echo $text;

?>