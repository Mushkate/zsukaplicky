 <?php
echo "<div style=\"margin:20px\"><a href=\"./schoolroom.php\"> &larr; Zpět do seznamu učeben<br><br></a></div>";
$schroomNumber = $_POST['name'];
  
$signpost = "../schoolroom/schoolroom.txt";
$file = file($signpost);
$text = "";

// --- HEADER ---
foreach($file as $line){
  if (substr($line, 0, strlen($schroomNumber)+1) === $schroomNumber."_"){
    $pieces = explode("_", $line);
    $text = "<div style=\"text-align:center\"><h1>".$pieces[1]."<h1></div>";
    break;
  }
}

// --- TEXT ---
$textFile="../schoolroom/".$schroomNumber."/text.txt";
$handle = @fopen($textFile, "r");
$textdiv="<div style=\"margin:30px\">";
$textFromFile=$textdiv.fgets($handle);
while (!feof($handle)) {
    $newLine=fgets($handle);
    $textFromFile=$textFromFile."<br>".$newLine;
}
fclose($handle);
$textFromFile=$textFromFile."</div>";

$text=$text.$textFromFile;

// --- TABLE WITH IMAGES ---
$files = scandir('../schoolroom/'.$schroomNumber);
$counter=1;
$pictures_per_row=7;
foreach($files as $file) {
  if ( $file == "." || $file == ".." ) continue;
  if ( substr($file, -4) === ".txt" ) continue;
  if ($counter%$pictures_per_row == 1) {
    $text = $text."<div class=\"row\">";
  }
  $text = $text."<div class=\"column\">
    <img src=\"../schoolroom/".$schroomNumber."/".$file."\" onclick=\"enlargeImage(this);\">
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