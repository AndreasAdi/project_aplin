<?php
session_start();
include_once "DB/database.php";
    if(!isset($_SESSION['email'])){
        header("Location: Ticketing.php");
    }
    $queryRiwayat="SELECT * FROM pendingticket WHERE Email=:email";
    $stmt = $db->prepare($queryRiwayat);
    $stmt->bindValue(":email",$_SESSION['email'],PDO :: PARAM_STR);
    $stmt->execute();
    $resultRiwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    if(isset($_POST['btn_logout'])){
        unset($_SESSION['email']);
        header("Location: index.php");
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

    <title>Riwayat</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="Meals.php">Pre-Order Snack</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Riwayat.php">Riwayat</a>
            </li>
            </ul>
            <form method="POST">
            <?php
                   if(!isset($_SESSION['email'])){
                   echo "<a href='Register.php'><button class = 'btn btn-primary' type ='button'>Register</button></a>
                   <a href='Ticketing.php'> <button class = 'btn btn-success' type ='button'>Login</button> </a>";
                }
                else{
                    echo"<button class = 'btn btn-danger' name='btn_logout'>Logout</button>";
                }
                ?>
            </form>
        </div>
    </nav>

    <!-- ISIAN PERTAMA-->
    <br>
    <h1>Riwayat</h1>
      <div class="container mt-5">
            <form method="post">
                <div class="container mt-5">
                    <table class="table">
                        <thead>
                           <th>Judul</th>
                           <th>Status</th>
                           <th>Detail</th>
                        </thead>
                        <tbody>
                            <?php
                            $ctr=0;
                                foreach ($resultRiwayat as $key => $value) {
                                    //Select Judul Film
                                    $querySelectJudul="SELECT * FROM film WHERE id_film=$value[id_film]";
                                    $stmt=$db->prepare($querySelectJudul);
                                    $stmt->execute();
                                    $resultJudul=$stmt->fetch(PDO::FETCH_ASSOC);

                                    //Select Nama Studio dan id Cabang
                                    $querySelectStudio="SELECT * FROM studio WHERE id_studio=$value[studio]";
                                    $stmt=$db->prepare($querySelectStudio);
                                    $stmt->execute();
                                    $resultStudio=$stmt->fetch(PDO::FETCH_ASSOC);

                                    //Select Nama Cabang
                                    $querySelectCabang="SELECT * FROM cabang WHERE id_cabang=$resultStudio[id_cabang]";
                                    $stmt=$db->prepare($querySelectCabang);
                                    $stmt->execute();
                                    $resultCabang=$stmt->fetch(PDO::FETCH_ASSOC);
                                    echo "
                                        <tr>
                                            <td>$resultJudul[judul]</td>
                                            <td>$value[StatusBayar]</td>
                                            <td><button class='btn btn-primary' name='btnDetail' id='btnDetail' data-toggle='modal' data-target='#modal$ctr' type='button'>Detail</button></td>
                                        </tr>
                                        <div class='modal fade' id='modal$ctr' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog' role='document'>
                                            <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'>$resultJudul[judul]</h5>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <div class='modal-body'>
                                                <b>Cabang : </b> $resultCabang[nama_cabang] <br>
                                                <b>Studio : </b> $resultStudio[Nama_Studio] <br>
                                                <b>Tanggal: </b> $value[tanggal] <br>
                                                <b>Jam    : </b> $value[jam] <br>
                                                <b>Seat   : </b> $value[Seat] <br>
                                                <b>Harga  : </b> Rp.$value[Harga] <br>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    ";
                                    $ctr++;
                                }
                            ?>
                        </tbody>
                    </table>
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