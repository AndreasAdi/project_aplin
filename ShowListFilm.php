<?php
    include "DB/database.php";
    session_start();

    $query = "SELECT * FROM jadwal where id_cabang=$_GET[cabang]";
    // Query Bare! Jangan digunakan kalau TERIMA DATA DARI CLIENT!
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body>
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
                <button class="btn btn-primary" type="submit" name="addfilm">Add</button>

                <div class="container mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Poster</th>
                                <th>Judul</th>
                                <th>Tahun</th>
                                <th>Cast</th>
                                <th>Genre</th>
                                <th>Deskripsi</th>
                                <th>Durasi (Menit)</th>
                                <th>Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($result as $key => $id_film) {
                                    $query = "SELECT * FROM film where id_film =$id_film[id_film]";
                                    $film = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($film as $key =>$value){
                                        $genre ="";
                                        $cast ="";
                                        
                                        $query = "SELECT nama_cast FROM filmcast where id_film =$value[id_film]";
                                        $listcast = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
                                        foreach ($listcast as $key => $hasil) {
                                            #concat hasil select genre dan beri coma
                                           $cast =$cast.$hasil["nama_cast"].",";                
                                        }
                                        #hapus coma paling belakang
                                        $cast = substr($cast,0,-1);
                                        #select genre sesuai film
                                        $query = "SELECT nama_genre FROM filmgenre where id_film =$value[id_film]";
                                        $listgenre = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($listgenre as $key => $hasil) {
                                            #concat hasil select genre dan beri coma
                                        $genre =$genre.$hasil["nama_genre"].",";                
                                        }
                                        #hapus coma paling belakang
                                        $genre = substr($genre,0,-1);
                                        
                                        echo " 
                                        <tr>
                                        <td><img src='poster/$value[poster]' style ='height : 10%'></td>
                                        <td> $value[judul]</td>
                                        <td>$value[tahun]</td>
                                        <td>$cast</td>
                                        <td>$genre</td>
                                        <td>$value[deskripsi]</td>
                                        <td>$value[durasi]</td>
                                        <td><button class='btn btn-primary' type ='submit' value ='$value[id_film]' name ='btnSelectFilm'><i class='fas fa-check'></i></button></td>
                                        </tr>";
                                    }
                              }
                             ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <!-- datatable -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $("table").DataTable();
        </script>
         <!-- datatable -->

</body>
  <!-- Footer -->
        <footer class="page-footer font-small bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>
</html>