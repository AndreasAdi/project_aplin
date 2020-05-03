<?php
    include "DB/database.php";
    session_start();
    
    if(isset($_POST['btnedit'])){
        $genre = $_POST['genre'];
        $cast = $_POST['cast'];
        $id_film =$_GET["film"];
        $queryupdate="UPDATE film set judul= :judul, tahun = :tahun,deskripsi = :deskripsi,durasi = :durasi where id_film = $id_film";
        try {
            $stmt=$db->prepare($queryupdate);
            $stmt->bindValue(':judul',$_POST['judul'],PDO::PARAM_STR);
            $stmt->bindValue(':tahun',$_POST["tahun"],PDO::PARAM_STR);
            $stmt->bindValue(':deskripsi',$_POST['deskripsi'],PDO::PARAM_STR);
            $stmt->bindValue(':durasi',$_POST['durasi'],PDO::PARAM_STR);
            $result=$stmt->execute();       


            $querydelete="DELETE FROM filmgenre where Id_film =$_GET[film]";
            $db->exec($querydelete);

            $querydelete="DELETE FROM filmcast where Id_film =$_GET[film]";
            $db->exec($querydelete);

            foreach ($genre as $key => $value) {   
            $query = "INSERT INTO filmgenre(nama_genre,id_film) VALUES(:nama_genre,:id_film)";
            $stmt=$db->prepare($query);
            $stmt->bindValue(':nama_genre',$value,PDO::PARAM_STR);
            $stmt->bindValue(':id_film',$id_film,PDO::PARAM_STR);
            $result=$stmt->execute();
            }

            foreach ($cast as $key => $value) {   
                $query = "INSERT INTO filmcast(nama_cast,id_film) VALUES(:nama_cast,:id_film)";
                $stmt=$db->prepare($query);
                $stmt->bindValue(':nama_cast',$value,PDO::PARAM_STR);
                $stmt->bindValue(':id_film',$id_film,PDO::PARAM_STR);
                $result=$stmt->execute();
            }

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

$query = "SELECT nama_genre FROM filmgenre where id_film = $_GET[film]";
$stmt = $db->prepare($query);
$stmt->execute();
$genre = $stmt->fetchAll(PDO::FETCH_ASSOC);



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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <title>Hello, world!</title>
</head>

<body>
    <Form method='post'>

        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="film.php">Film</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="snack.php">Snack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jadwal.php">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cabang.php">Cabang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="studio.php">Studio</a>
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
                    <select class="form-control" multiple="multiple" name="cast[]" id="cast">
                   <?php
                    $querycast = "SELECT nama_cast FROM listcast";
                    $listcast = $db->query($querycast)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listcast as $key => $value) {        
                        $itemcast = $listcast[$key]["nama_cast"];  
                        echo("<option>$itemcast</option>");
                    }
                   ?>
                </select>
                </div>
                <div class="form-group">
                    <label for="cast">Genre</label><br>
                    <select class="form-control" multiple="multiple" name="genre[]" id="genre">">
                   <?php
                    $query = "SELECT nama_genre FROM genre";
                    $listgenre = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
         
                    foreach ($listgenre as $key => $value) {        
                        $itemgenre = $listgenre[$key]["nama_genre"];  
                        echo("<option>$itemgenre</option>");
                    }
                   ?>
                </select>
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

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <script>
        $(document).ready(function() {
        $('#genre').select2({
            tags: true
        });
        $('#cast').select2({
            tags: true
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