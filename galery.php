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
                
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Marcellus&subset=latin,latin-ext' rel='stylesheet' type='text/css' />
        <link href='http://fonts.googleapis.com/css?family=Exo&subset=latin,latin-ext' rel='stylesheet' type='text/css' />

  <style>
  .mySlides {display:none;}
  </style>
</head>
<body style="z-index:0">                          
<div class="header" id="header">
  <table class="headerTable">
    <tr>
      <td><img src="images/children.jpg" class="childImg" ></td>
      <td style="widht:100%;"><p class="headerText">Základní škola U Kapličky, Orlová&#x2011;Lutyně</p> </td>
      <td><img src="images/logo.jpg" style="max-height:90px"></td>
    </tr>
  </table>

</div>                               
                                
<?php 
    include 'menu.php';  
?>
<div id="main" class="main">
    <?php
    include './main/galery.php';
    ?>
</div>
<?php
    include 'footer.php'
  ?>
</body>
</html>
