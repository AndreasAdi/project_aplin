<?php
session_start();
include "DB/database.php";

if (isset($_GET['search'])) {
    $query = "SELECT DISTINCT f.id_film as id_film, f.judul AS judul ,f.poster AS poster, f.tahun AS tahun FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1 AND f.judul like '%$_GET[search]%' ";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster, f.tahun AS tahun FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1 AND f.judul like '%$_GET[search]%' ";
} else {
    $query = "SELECT DISTINCT f.id_film as id_film, f.judul AS judul ,f.poster AS poster, f.tahun AS tahun FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1";
    $query2 = "SELECT f.id_film as id_film, f.judul AS judul ,f.poster AS poster, f.tahun AS tahun FROM film f, jadwal j where f.id_film = j.id_film AND j.status =1";
}

$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $db->prepare($query2);
$stmt->execute();
$result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);



if (isset($_POST['btnbook'])) {
    if (!isset($_SESSION['email'])) {
        header("Location: Ticketing.php");
    } else {
        header("Location: Detail_film.php?idfilm=" . $_POST['btnbook'] . "");
    }
}

if (isset($_POST['btnplay'])) {
    if (!isset($_SESSION['email'])) {
        header("Location: Ticketing.php");
    } else {
        header("Location: Detail_film.php?idfilm=" . $_POST['btnplay'] . "");
    }
}


if (isset($_POST['btn_logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['snackcart']);
    header("Location: index.php");
}

$query = "SELECT f.judul AS judul_film, f.tahun AS tahun,CONCAT('detail_film.php?idfilm',f.id_film) AS link FROM film f";
$stmt = $db->prepare($query);
$stmt->execute();
$lisfilm = $stmt->fetchAll(PDO::FETCH_ASSOC);

$lisfilm = json_encode($lisfilm);
file_put_contents("film.json", $lisfilm);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="easy-autocomplete.css">
    <link rel="stylesheet" href="easy-autocomplete.themes.css">
    <link rel="stylesheet" href="detailfim.css">
    <title>List Film!</title>
</head>

<body style="background-image: url(background-collage.jpg)">

    
        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Now Showing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comingsoon.php">Coming Soon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Riwayat.php">Riwayat</a>
                    </li>
                </ul>
    <form action="search.php">
    <input type="text" class="form-control" style="border-radius: 30px" name="keyword" placeholder="Search Movies" id="search">
    </form>


    <form method="Post">
    <?php
    if (!isset($_SESSION['email'])) {
        echo "<a href='Register.php'><button class = 'btn btn-primary mr-2 ml-4' type ='button'>Register</button></a>
                   <a href='Ticketing.php'> <button class = 'btn btn-success' type ='button'>Login</button> </a>";
    } else {
        echo "<button class = 'btn btn-danger ml-4' type='submit' name='btn_logout'>Logout</button>";
    }
    ?>
    </form>
   


    </div>
    </nav>



    <h1 class="mt-5 text-light" style="text-align: center;">NOW SHOWING</h1>




    <div id="card2" class="row text-dark d-flex justify-content-center flex-wrap mt-5 m-1">
        <?php
        foreach ($result as $key => $value) {
            echo "<form method='post'>";
            echo "<a href ='detail_film.php?idfilm= $value[id_film]'><img id='card' class='rounded m-3' height = 300px src='poster/$value[poster]'  title='<b>$value[judul]</b><br>$value[tahun]'></a></li>";
            echo "</form>";
        }
        ?>
        </ul>
    </div>




    <script src="jquery.js"></script>
    <script src="jquery-ui.js"></script>
    <script src="jquery.touchSwipe.js"></script>
    <script src="jquery.film_roll.js"></script>
    <script src="jquery.easy-autocomplete.js"></script>
    <script src="jquery.sliphover.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/easing/EasePack.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/jquery.gsap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#card2").sliphover({});

        })
        var options = {
            url: "film.json",
            getValue: "judul_film",
            list: {
                match: {
                    enabled: true
                },
                onClickEvent: function() {
                    var film = $("#search").getSelectedItemData().judul_film;
                    location.replace(`search.php?search=` + film);
                }
            },

            template: {
                type: "description",
                fields: {
                    description: "tahun"
                }
            },
            theme: "round"

        };
        $("#search").easyAutocomplete(options);

        // $(function() {
        //     fr = new FilmRoll({
        //         container: '#card',
        //         configure_load: true,
        //         force_buttons: true,
        //         pager: false,
        //         position: "left"
        //     });
        // });

        // $(function() {
        //     fr = new FilmRoll({
        //         container: '#card2',
        //         configure_load: true,
        //         force_buttons: true,
        //         pager: false,
        //         position: "center"
        //     });
        // });
    </script>
</body>


<!-- Footer -->
<footer class="page-footer font-small bottom bg-dark text-light mt-5">
    <div class="footer-copyright text-center py-3">© 2020 Copyright
    </div>
</footer>

</html>