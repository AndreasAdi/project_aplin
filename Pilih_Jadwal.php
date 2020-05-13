<?php
    session_start();
    include_once "DB/database.php";
    if(!isset($_SESSION['Email'])){
        header("Location: Ticketing.php");
    }

    $querySelectJadwal="SELECT * FROM jadwal WHERE id_cabang=$_GET[idCabang] AND id_film=$_GET[idFilm]";
    $stmt= $db->prepare($querySelectJadwal);
    $stmt->execute();
    $resultJadwal=$stmt->fetchAll(PDO::FETCH_ASSOC);
    if(isset($_POST['selectJadwal'])){
        $querySelectDetailJadwal="SELECT * FROM jadwal WHERE id_jadwal=$_POST[selectJadwal]";
        $stmt=$db->prepare($querySelectDetailJadwal);
        $stmt->execute();
        $result=$stmt->fetch(PDO :: FETCH_ASSOC);
        header("Location: Seat.php?nama=".$_GET['nama']."&idJadwal=".$_POST['selectJadwal']."&idStudio=".$result['id_studio']."&idFilm=".$_GET['idFilm']."&tgl=".$result['tanggal']."&jam=".$result['jam']."&judul=".$_GET['judul']."");
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

    <title>Hello, world!</title>
  </head>
  <body>
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
            <a href="Register.php"> <text class="text-primary">Sign Up</text> </a>
            <a href="Ticketing.php"> <text class="text-secondary">Login</text> </a>
        </div>
    </nav>
        <h1>Pilih Jadwal</h1>
      <div class="container mt-5">
            <form method="post">
                <div class="container mt-5">
                    <table class="table">
                        <thead>
                           <th>Studio</th>
                           <th>Tanggal</th>
                           <th>Jam</th>
                           <th>Select</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($resultJadwal as $key => $value) {
                                    echo"
                                        <tr>
                                            <td>$value[id_studio]</td>
                                            <td>$value[tanggal]</td>
                                            <td>$value[jam]</td>
                                            <td><button class='btn btn-primary' name='selectJadwal' value='$value[id_jadwal]'>Select</button>
                                            </td>
                                            </tr>
                                    ";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>