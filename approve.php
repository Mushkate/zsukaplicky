<!doctype html>
<html lang="css">
<head>
  <link rel="stylesheet" href="styles.css">     
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>     
  <script src="js/uploadForm.js" type="text/javascript"></script>

<style>
.mySlides {display:none;}
</style>
                          
</head>
<body style="margin: 20px">

 <?php

session_start();
      if(isset($_POST['submit'])){
        $username = $_POST['username']; $password = $_POST['password'];
        if($username === 'admin' && $password === 'MameRadiDeti2019'){
          $_SESSION['login'] = true; 
          echo '<style type="text/css">
        #logform {
            display: none;
        }
        </style>';
        } else {
          echo "<div class='alert alert-danger'>Username and Password do not match.</div>";
        }

      }

      if(isset($_SESSION['login'])) {
        include 'form.php';
      } else {
        echo '<form action="" method="post" id="logform">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Login</button>
      </form>';
      }
    ?>
    
<body>