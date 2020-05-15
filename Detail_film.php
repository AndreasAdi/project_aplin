<?php
    session_start();
    include_once "DB/database.php";
    if(!isset($_SESSION['email'])){
        header("Location: Ticketing.php");
    }

    $querySelectedFilm="SELECT * FROM film WHERE id_film=$_GET[idfilm]";
    $stmt = $db->prepare($querySelectedFilm);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $querySelectedFilmCast="SELECT * FROM filmcast WHERE id_film=$_GET[idfilm]";
    $stmt = $db->prepare($querySelectedFilmCast);
    $stmt->execute();
    $resultcast = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $querygenre="SELECT nama_genre FROM filmgenre WHERE id_film = $_GET[idfilm]";
    $stmt = $db->prepare($querygenre);
    $stmt->execute();
    $resultgenre = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST['select'])){
        $queryAmbilNamaCabang="SELECT * FROM cabang WHERE id_cabang=$_POST[select]";
        $stmt=$db->prepare($queryAmbilNamaCabang);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        header('Location: Pilih_Jadwal.php?nama='.$result['nama_cabang'].'&idCabang='.$_POST['select'].'&idFilm='.$_GET['idfilm'].'&judul='.$_POST['judul'].'');
    }

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="detailfilm.css">
    <title><?php echo $result['judul']?></title>
</head>

<body>
    <img id="bg" src='poster/<?php echo "$result[poster]"?>'>
    <form method='post'>
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
                        <a class="nav-link" href="Riwayat.php">Riwayat</a>
                    </li>
                </ul>
                <?php
                   if(!isset($_SESSION['email'])){
                   echo "<a href='Register.php'> <text class='text-primary'>Sign Up</text> </a>
                   <a href='Ticketing.php'> <text class='text-secondary'>Login</text> </a>";
                }
                else{
                    echo"<button class = 'btn btn-danger' name='btn_logout'>Logout</button>";
                }
                ?>
                
            </div>
        </nav>

        <!-- <img style='width: 400px; height: 500px;' src='poster/<?php echo "$result[poster]"?>'> -->
        <!--Deskripsi Dan Cast -->
        <div class="container text-light">
            <div class="row">
                <div class="col-5 mt-5">
                    <img style='height: 500px;' src='poster/<?php echo "$result[poster]"?>'>
                </div>
                <div class="col-7 mt-5">
                    <h1><?php echo "<b>$result[judul]</b>"?>
                        <input type="hidden" name='judul' value='<?php echo $result['judul'];?>'>
                    </h1>

                    <div class="d-flex justify-content-start">
                        <div class="mr-2">
                            <b>
                                <?php echo "$result[tahun]" ?>
                            </b>

                        </div>
                        <div>
                        <?php 
                               foreach ($resultgenre as $key => $value) {
                                   echo "<span class='badge badge-secondary mr-1'>";
                                   echo $value["nama_genre"];
                                   echo "</span>";
                           
                                   }                       
                            ?>
                        </div>
  

                    </div>
                    <div class="mt-4">
                        <h4><b>Sinopsis</b></h4>
                        <?php echo $result['deskripsi'];?>
                        <h4 class="mt-4"><b>Cast</b></h4>
                        <?php 
                        foreach ($resultcast as $key => $value) {
                        echo "<span class='badge badge-secondary mr-1'>";
                        echo $value['nama_cast'];
                        echo "</span>";
                        }
                     ?>
                    </div>

                 <!-- Buat Nampilin Bioskop e -->
                        <h4 class="mt-4"><b>Watch On</b></h4>
                        <?php
                             $querySelectJadwal="SELECT DISTINCT id_cabang FROM jadwal WHERE id_film=$_GET[idfilm]";
                             $stmt=$db->prepare($querySelectJadwal);
                             $stmt->execute();
                             $resultJadwal = $stmt->fetchAll(PDO::FETCH_ASSOC);
                         ?>
                        
                            <table class="table bg-light">
                                <thead class="thead-dark">
                                    <th>Nama</th>
                                    <th>Select</th>
                                </thead>
                                <tbody>
                                    <?php
                                foreach ($resultJadwal as $key => $value) {
                                    $querySelectCabang="SELECT * FROM cabang WHERE kota_cabang='$_SESSION[kota]' AND id_cabang=$value[id_cabang]";
                                    $stmt=$db->prepare($querySelectCabang);
                                    $stmt->execute();
                                    $resultCabang = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($resultCabang as $key => $value) {
                                        echo"
                                            <tr>
                                                <td>$value[nama_cabang]</td>
                                                <td>
                                                <button class='btn btn-primary' name='select' value='$value[id_cabang]'>Select</button></td>
                                            </tr>
                                        ";
                                    }
                                }
                            ?>
                                </tbody>
                            </table>
                        
                  
                </div>


            </div>
            
        </div>
       


    </form>
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
</body>

</html>