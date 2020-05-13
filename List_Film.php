<?php
 session_start();
 include "DB/database.php";
 if(!isset($_SESSION['email'])){
    header("Location: Ticketing.php");
}

if(isset($_POST['keyword'])){
    header("Location: list_film.php?search=$_POST[keyword]");
}
if(isset($_GET['search'])){
    $query = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =0 AND f.judul like '%$_GET[search]%' ";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1 AND f.judul like '%$_GET[search]%' ";
}
else{
    $query = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =0";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1";
}

$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare($query2);
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['btnbook'])){
    header("Location: Detail_film.php?idfilm=".$_POST['btnbook']."");
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

    <title>List Film!</title>
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

    <!-- ISIAN PERTAMA-->
    <!-- <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="height:40%; width: 60%; text-align: center; left: 300px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="silver.png" class="d-block w-100" style="width:100%; height:300px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Film 1</h5>
                <p>Deskripsi Film 1</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="silver.png" class="d-block w-100" style="width:100%; height:300px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Film 2</h5>
                <p>Deskripsi Film 2</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="silver.png" class="d-block w-100" style="width:100%; height:300px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Film 3</h5>
                <p>Deskripsi Film 3</p>
            </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br><br><br> -->
    <!--COMING SOON-->

 
    
    <div id="comingsoon" class="container mt-5">
    <form method="POST">
            <div class="input-group col-4 ml-auto">
                <input type="text" class="form-control mr-1" name="keyword" placeholder="Search by Name">
                <button type="submit" class="btn btn-warning" name="btnsearch">Search</button>
            </div>
        </form>
    <h1 style="text-align: center;">COMING SOON</h1>
    <div class="row text-dark d-flex justify-content-center flex-wrap">
 
        <?php
            foreach ($result as $key => $value){
                echo "<form method='post'>";
                    echo "<div class='card col-xs-2 m-4' style='width: 18rem'>";
                    echo"<img class= 'card-img-top' src='poster/$value[poster]'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>$value[judul]</h5>";
                    echo"<button class='btn btn-block btn-warning text-dark' type ='submit' name ='btnbook' value ='$value[id_film]'><b>Book Ticket</b></button>";
                    // echo"<input type ='hidden' value = '$value[id_menu]' name = 'idmenu'>";
                    echo"</div>";
                    echo"</div>";
                    echo "</form>";
            }
        ?>
    </div>

    <h1 style="text-align: center;">Now Playing</h1>
    <div class="row text-dark d-flex justify-content-center flex-wrap">
    <?php
            foreach ($result2 as $key => $value){
                echo "<form method='post'>";
                    echo "<div class='card col-xs-2 m-4' style='width: 18rem'>";
                    echo"<img class= 'card-img-top' src='poster/$value[poster]'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>$value[judul]</h5>";
                    echo"<button class='btn btn-block btn-warning text-dark' type ='submit' name ='btnplay' value ='$value[id_film]'><b>Book Ticket</b></button>";
                    // echo"<input type ='hidden' value = '$value[id_menu]' name = 'idmenu'>";
                    echo"</div>";
                    echo"</div>";
                    echo "</form>";
            }
        ?>
    </div>
    </div>


  </body>
  
   
        <!-- Footer -->
        <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>

</html>