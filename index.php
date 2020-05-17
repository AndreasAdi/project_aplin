<?php
 session_start();
 include "DB/database.php";
 
if(isset($_POST['keyword'])){
    header("Location: index.php?search=$_POST[keyword]");
}
if(isset($_GET['search'])){
    $query = "SELECT DISTINCT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =0 AND f.judul like '%$_GET[search]%' ";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1 AND f.judul like '%$_GET[search]%' ";
}
else{
    $query = "SELECT DISTINCT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =0";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1";
}

$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare($query2);
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['btnbook'])){
    if(!isset($_SESSION['email'])){
        header("Location: Ticketing.php");
    }
    else{
        header("Location: Detail_film.php?idfilm=".$_POST['btnbook']."");
    }
   
}

if(isset($_POST['btnplay'])){
    if(!isset($_SESSION['email'])){
        header("Location: Ticketing.php");
    }
    else{
        header("Location: Detail_film.php?idfilm=".$_POST['btnplay']."");
    }
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="jquery-ui.css">

    <link rel="stylesheet" href="detaifilm.css">
    <title>List Film!</title>
  </head>
  <body>
  <form method="POST">
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
                   echo "<a href='Register.php'><button class = 'btn btn-primary mr-2' type ='button'>Register</button></a>
                   <a href='Ticketing.php'> <button class = 'btn btn-success' type ='button'>Login</button> </a>";
                }
                else{
                    echo"<button class = 'btn btn-danger' type='submit' name='btn_logout'>Logout</button>";
                }
                ?>
            </form>

        </div>
    </nav>

    <!--COMING SOON-->

 
    
            <form  method="POST">
    
            <div class="input-group col-4 ml-auto mt-5">
                <input type="text" class="form-control mr-1" name="keyword" placeholder="Search by Name">
                <button type="submit" class="btn btn-warning" name="btnsearch">Search</button>
            </div>
        </form>
        
        <h1 class="mt-5" style="text-align: center;">NOW PLAYING</h1>
    <div id ="card" class="row text-dark d-flex justify-content-center flex-wrap m-1">
    <?php
            foreach ($result2 as $key => $value){
                echo "<form method='post'>";
                    echo "<div class='card col-xs-2 m-4' style='width: 18rem'>";
                    echo"<a href ='detail_film.php?idfilm= $value[id_film]'><img class= 'card-img-top' src='poster/$value[poster]'></a>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>$value[judul]</h5>";
                    echo"<button class='btn btn-block btn-warning text-dark' type ='submit' name ='btnplay' value ='$value[id_film]'><b>View Detail</b></button>";
                    // echo"<input type ='hidden' value = '$value[id_menu]' name = 'idmenu'>";
                    echo"</div>";
                    echo"</div>";
                    echo "</form>";
            }
        ?>
    </div>


    <h1 class="mt-5" style="text-align: center;">COMING SOON</h1>
    <div id ="card2" class="row text-dark d-flex justify-content-center flex-wrap m-1">
 
        <?php
            foreach ($result as $key => $value){
                echo "<form method='post'>";
                    echo "<div class='card col-xs-2 m-4' style='width: 18rem'>";
                    echo"<a href ='detail_film.php?idfilm= $value[id_film]'><img class= 'card-img-top' src='poster/$value[poster]'></a>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>$value[judul]</h5>";
                    echo"<button class='btn btn-block btn-warning text-dark' type ='submit' name ='btnbook' value ='$value[id_film]'><b>View Detail</b></button>";
                    // echo"<input type ='hidden' value = '$value[id_menu]' name = 'idmenu'>";
                    echo"</div>";
                    echo"</div>";
                    echo "</form>";
            }
        ?>
    </div>




    <script src="jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <script src="jquery.touchSwipe.js"></script>
    <script src="jquery.film_roll.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/jquery.gsap.min.js"></script>

    <script>

            $(function() {
            fr = new FilmRoll({
                container: '#card',
                configure_load: true,
                force_buttons :true,
                pager :false,
                position : "left"
              });
            });

            $(function() {
            fr = new FilmRoll({
                container: '#card2',
                configure_load: true,
                force_buttons :true,
                pager :false,
                position : "left"
              });
            });
        
       
    
    </script>
  </body>
  
   
        <!-- Footer -->
        <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>

</html>