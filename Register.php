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
            $QueryInsertUser='INSERT INTO datauser(Nama,Alamat,Telepon,City,Email,Password,Gender) VALUES(:nama,:alamat,:telepon,:city,:email,:pass,:gender)';
            try {
                $stmt=$db->prepare($QueryInsertUser);
                $stmt->bindValue(':nama',$_POST['nama'],PDO::PARAM_STR);
                $stmt->bindValue(':pass', password_hash($_POST["password"], PASSWORD_DEFAULT),PDO::PARAM_STR);
                $stmt->bindValue(':alamat',$_POST['Alamat'],PDO::PARAM_STR);
                $stmt->bindValue(':telepon',$_POST['Telepon'],PDO::PARAM_STR);
                $stmt->bindValue(':city',$_POST['city'],PDO::PARAM_STR);
                $stmt->bindValue(':email',$_POST['email'],PDO::PARAM_STR);
                $stmt->bindValue(':gender',$_POST['gender'],PDO::PARAM_STR);
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

    <title>Hello, world!</title>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="Ticketing.php">Ticketing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Riwayat.php">Riwayat</a>
                    </li>
                </ul>
                <a href="Register.php"> <text class="text-primary mr-2">Sign Up</text> </a>
                <a href="Ticketing.php"> <text class="text-secondary mr-2">Login</text> </a>
            </div>
        </nav>

        <!-- ISIAN PERTAMA-->
        <div class="container col-md-6 mt-5 mb-5">
            <form>
                <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input type="text" class="form-control" id="inputName" placeholder="Nama Lengkap" name='nama' required>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Alamat</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Alamat" name='Alamat' required>
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Telepon</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" class="form-control" id="inputAddress2" name='Telepon' required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name='city' required>
                </div>
                <div class="form-group">
                    <label for="inputEmail4">Email</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="inputEmail4" name='email' required>
                        <div class="input-group-append">
                            <span class="input-group-text">@example.com</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name='password' required>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name='confirmPassword' required>
                    </div>

                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Gender</label>
                    <select class="form-control" name='gender'>
                        <option value='Laki-Laki'>Laki-Laki</option>
                        <option value='Perempuan'>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" name='register'>Register</button>
                </div>
                </div>
            </form>
        </div>
    </form>
    <!--FOOTER-->
    <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>
</body>

</html>