<!doctype html>
<html>
<head>
  <link rel="stylesheet" href="style/styles.css">    
  <link rel="stylesheet" href="style/header.css">  
  <link rel="stylesheet" href="style/body.css">    
  <link rel="stylesheet" href="style/left.css">        
  <link rel="stylesheet" href="style/mid.css">  
  <link rel="stylesheet" href="style/right.css"> 
  <link rel="stylesheet" href="style/pin.css">  
  <link rel="stylesheet" href="style/menu.css">  
  <link rel="stylesheet" href="style/galery.css">  
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  
  <!--<script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>       -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="js/menu.js" type="text/javascript"></script>
        <!--<script src="upload/upload.js" type="text/javascript"></script>-->
        <script src="js/menu_load.js" type="text/javascript"></script>
        <script src="js/schoolroom.js" type="text/javascript"></script>
                
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Marcellus&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

  <style>
  .mySlides {display:none;}
  </style>
</head>
<body style="z-index:0">                          
<div class="header" id="header">
<a href="index.php">
  <table class="headerTable">
    <tr>
      <td><img src="images/children.jpg" class="childImg" ></td>
      <td style="widht:100%;"><p class="headerText">Základní škola U Kapličky, Orlová&#x2011;Lutyně</p> </td>
      <td><img src="images/logo.jpg" style="max-height:90px"></td>
    </tr>
  </table>
</a>
</div>                               
                    
<?php 
    include 'menu.php';  
    echo "<div id=\"main\" class=\"main\">
    <table class=\"tableMid\">
    <tr>
      <td class=\"tdMid\"><h1 style=\"text-align:center\">Přehled učeben</h1><br>";
    include './main/schoolroom.php';
    echo "</td>
      <td style=\"width: var(--right-size);\" class=\"tdRight\">";
    include "main/right.php"; 
    echo "</td></tr> </table>";
    echo "</div>";
    include 'footer.php'
?>

</body>
</html>
