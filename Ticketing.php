<?php
include "DB/database.php";
if (isset($_POST['login'])) {
  $QueryCekUser = "SELECT * FROM datauser WHERE Email=:email";
  $stmt = $db->prepare($QueryCekUser);
  $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
  $result = $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($data) {
    $password = $data['Password'];
    $cekpass = password_verify($_POST['password'], $password);
    if ($cekpass) {
      if ($data['role'] == 'admin') {
        session_start();
        $_SESSION['user'] = $data['Nama'];
        $_SESSION['email'] = $data['Email'];
        $_SESSION['kota'] = $data['City'];
        header("Location: admin.php");
      } else if ($data['role'] == 'user') {
        session_start();
        $_SESSION['user'] = $data['Nama'];
        $_SESSION['email'] = $data['Email'];
        $_SESSION['kota'] = $data['City'];
        header("Location: index.php");
      }
    } else {
      echo "<script>alert('Password Salah!')</script>";
    }
  } else {
    echo "<script>alert('Email Tidak Terdaftar!')</script>";
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
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />

  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
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
    <div class="container">
      <form method="post">
        <div class="limiter">
          <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
              <form class="login100-form validate-form">
                <span class="login100-form-title p-b-33">
                  Account Login
                </span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="email" placeholder="Email">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="password" placeholder="Password">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                  <button class="login100-form-btn" name="login" type="submit">
                    Sign in
                  </button>
                </div>



                <div class="text-center p-t-45 p-b-4">
                  <span class="txt1">
                    Create an account?
                  </span>

                  <a href="register.php" class="txt2 hov1">
                    Sign up
                  </a>
                </div>
              </form>
            </div>
          </div>
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