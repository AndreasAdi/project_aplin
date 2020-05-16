<?php
  include "DB/database.php";
  if(isset($_POST['login'])){
    $QueryCekUser="SELECT * FROM datauser WHERE Email=:email";
    $stmt=$db->prepare($QueryCekUser);
    $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
    $result=$stmt->execute();
    $data=$stmt->fetch(PDO::FETCH_ASSOC);
    if($data===false){
      //login admin
      if($_POST['email']=="admin@admin.com"){
          header('Location: admin.php');
      }
      else{
       echo "<script>alert('Email Tidak Terdaftar!')</script>";
      }
      
    }
    else{
        $password=$data['Password'];
        $cekpass=password_verify($_POST['password'],$password);
        if($cekpass){
          session_start();
          $_SESSION['user']=$data['Nama'];
          $_SESSION['email']=$data['Email'];
          $_SESSION['kota']=$data['City'];
          header("Location: LoginSuccess.php");
        }
        else{
          echo "<script>alert('Password Salah!')</script>";
        }
    }
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <form action="" method="post">
    <div style="clear: both;"></div>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </nav>

    <!-- ISIAN PERTAMA-->
    <div class="container col-md-3 mt-5">
      <form method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="text-center">
        <label>New Member?</label> <a href="Register.php"> <text class="text-primary">Sign Up</text> </a>
        </div>
        <div class="text-right">
        <button name="login" class="btn btn-primary active" type="submit" aria-pressed="true">Login</button>  
        </div>
 
   
      </form>
    </div>
  </body>
  
    <!--FOOTER-->
    <footer class="page-footer font-small fixed-bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>
</html>