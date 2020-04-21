<?php
    include "DB/database.php";
    session_start();
    
    if(isset($_POST['btnedit'])){
        $queryupdate="UPDATE film set judul= :judul, tahun = :tahun, cast = :cast, genre =:genre, deskripsi = :deskripsi,durasi = :durasi where id_film = $_GET[film]";
        try {
            $stmt=$db->prepare($queryupdate);
            $stmt->bindValue(':judul',$_POST['judul'],PDO::PARAM_STR);
            $stmt->bindValue(':tahun',$_POST["tahun"],PDO::PARAM_STR);
            $stmt->bindValue(':cast',$_POST['cast'],PDO::PARAM_STR);
            $stmt->bindValue(':genre',$_POST['genre'],PDO::PARAM_STR);
            $stmt->bindValue(':deskripsi',$_POST['deskripsi'],PDO::PARAM_STR);
            $stmt->bindValue(':durasi',$_POST['durasi'],PDO::PARAM_STR);
            $result=$stmt->execute();
            header('Location: film.php');
    }
         catch (\Throwable $th) {
                //throw $th;
        }
}

if(isset($_POST['btncancel'])){
    header('Location: film.php');
}

$query = "SELECT * FROM film where id_film = $_GET[film]";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <a href="index.php">
            <h3 style="text-align:center; float:left; margin-left: 47%;">BioskopID</h3>
        </a>

        <div style="clear: both;"></div>
        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="Index.php">BIOSKOPID</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="film.php">Film</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="snack.php">Snack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jadwal.php">Jadwal</a>
                    </li>
                </ul>
                <a href="Ticketing.php"> <text class="text-secondary mr-2">logout</text> </a>
            </div>
        </nav>


        <div class="container mt-5 col-5">
        <h3 class="mb-5">Edit Film</h3>
            <form method="post">
                <div class="form-group">
                    <label for="judul">Judul</label><br>
                    <input class="form-control" type="text" name="judul" value="<?php echo ($result[0]['judul'])?>">
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label><br>
                    <input class="form-control" type="text" name="tahun" value="<?php echo ($result[0]['tahun'])?>">
                </div>
                <div class="form-group">
                    <label for="cast">Cast</label><br>
                    <input class="form-control" type="text" name="cast" value="<?php echo ($result[0]['cast'])?>">
                </div>
                <div class="form-group">
                    <label for="cast">Genre</label><br>
                    <input class="form-control" type="text" name="genre" value="<?php echo ($result[0]['genre'])?>">
                </div>
                <div class="form-group">
                    <label for="durasi">Durasi (Menit)</label><br>
                    <input class="form-control" type="text" name="durasi" value="<?php echo ($result[0]['durasi'])?>">
                </div>                      
                <div class="form-group">
                    <label for="judul">Deskripsi</label><br>
                    <textarea class="form-control" rows="5" name="deskripsi"><?php echo ($result[0]['deskripsi'])?></textarea>
                </div>

                <button class="btn btn-primary" name="btnedit">Edit</button>
                <button class="btn btn-danger" name="btncancel">Cancel</button>
            </form>
        </div>


   
        <!-- Footer -->
        <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>


</body>

</html>