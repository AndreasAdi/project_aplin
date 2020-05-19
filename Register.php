<?php
    include "DB/database.php";
    session_start();
    if(isset($_POST['register'])){
        $query="SELECT * FROM datauser where Email = :email";
        $stmt = $db->prepare($query); // Prepare statement
        $stmt->bindValue(":email", $_POST["email"]);
        $result = $stmt->execute();
        $data = $stmt->fetch();
       if($_POST['confirmPassword'] == $_POST['password']){
        if($data===false){
            $QueryInsertUser='INSERT INTO datauser(Nama,Alamat,Telepon,City,Email,Password,Gender,role) VALUES(:nama,:alamat,:telepon,:city,:email,:pass,:gender,:role)';
            try {
                $stmt=$db->prepare($QueryInsertUser);
                $stmt->bindValue(':nama',$_POST['nama'],PDO::PARAM_STR);
                $stmt->bindValue(':pass', password_hash($_POST["password"], PASSWORD_DEFAULT),PDO::PARAM_STR);
                $stmt->bindValue(':alamat',$_POST['Alamat'],PDO::PARAM_STR);
                $stmt->bindValue(':telepon',$_POST['Telepon'],PDO::PARAM_STR);
                $stmt->bindValue(':city',strtoupper($_POST['city']),PDO::PARAM_STR);
                $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
                $stmt->bindValue(':gender',$_POST['gender'],PDO::PARAM_STR);
                $stmt->bindValue(':role','user',PDO::PARAM_STR);
                $result=$stmt->execute();
                echo"<div class='alert alert-success' role='alert'>Berhasil Register ! </div>";
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        else{
            echo"<div class='alert alert-danger' role='alert'>Tidak bisa register email sudah terdaftar ! </div>";
        }
       }
       else{
        echo"<div class='alert alert-warning' role='alert'>Password tidak sama ! </div>";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <title>Register</title>
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <Form method='post'>
        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="List_Film.php">List Film</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Meals.php">Pre-Order Snack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Riwayat.php">Riwayat</a>
            </li>
            </ul>
            <a href="Ticketing.php" class='btn btn-success'>Login</a>
        </div>
    </nav>

        <!-- ISIAN PERTAMA-->
        <div class="container">
      <form method="post">
        <div class="limiter">
          <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
              <form class="login100-form validate-form">
                <span class="login100-form-title p-b-33">
                  Register
                </span>

                
                <div class="wrap-input100">
                  <input class="input100" type="text" name="nama" placeholder="Nama Lengkap ">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100">
                  <input class="input100" type="text" name="city" placeholder="kota">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100">
                  <input class="input100" type="text" name="Alamat" placeholder="Alamat">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>
                <div class="wrap-input100">
                <select class="form-control" name='gender'>
                        <option value='Laki-Laki'>Laki-Laki</option>
                        <option value='Perempuan'>Perempuan</option>
                    </select>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="email" name="email" placeholder="Email">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                  <input class="input100" type="text" name="Telepon" placeholder="Phone number">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="password" placeholder="Password">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>
                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                  <input class="input100" type="password" name="confirmPassword" placeholder="Password">
                  <span class="focus-input100-1"></span>
                  <span class="focus-input100-2"></span>
                </div>


                

                <div class="container-login100-form-btn m-t-20">
                  <button class="login100-form-btn" name="register" type="submit">
                    Sign Up
                  </button>
                </div>



                <div class="text-center p-t-45 p-b-4">
                  <span class="txt1">
                    Already have an account?
                  </span>

                  <a href="ticketing.php" class="txt2 hov1">
                    Sign in
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </form>
    </div>
    </form>
</body>

   
        <!-- Footer -->
        <footer class='page-footer font-small fixed-bottom bg-dark text-light mt-5' style="clear: both; position: relative;">
            <div class='footer-copyright text-center py-3'>© 2020 Copyright
            </div>
        </footer>

</html>