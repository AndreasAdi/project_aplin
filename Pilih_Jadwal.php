<?php
    session_start();
    include_once "DB/database.php";
    $querySelectedFilm="SELECT * FROM film WHERE id_film=$_GET[idfilm]";
    $stmt = $db->prepare($querySelectedFilm);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $querySelectedFilmCast="SELECT * FROM filmcast WHERE id_film=$_GET[idfilm]";
    $stmt = $db->prepare($querySelectedFilmCast);
    $stmt->execute();
    $resultcast = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="List_Film.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="snack.php">Pre-Order Snack</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="DaftarFilm.php">Beli Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Riwayat.php">Riwayat</a>
                    </li>
                </ul>
                <a href="Ticketing.php"> <text class="text-secondary mr-2">logout</text> </a>
            </div>
        </nav>
      <div class="container mt-5">
            <form method="post">
                <div class="container mt-5">
                    <table class="table">
                        <thead>
                           <th>Nama</th>
                           <th>Select</th>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($result as $key => $value) {
                                    echo"
                                        <tr>
                                            <td>$value[nama_cabang]</td>
                                            <td><button class='btn btn-primary' name='select' value='$value[id_cabang]'>Select</button></td>
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