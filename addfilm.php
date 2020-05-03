<?php
    include "DB/database.php";
    session_start();
    // if(isset($_POST['btnadd'])){
    
    //var_dump($_FILES);
    if (isset($_FILES['poster'])) {
        // Kalau dikirim, cek apakah file yang di upload error apa tidak
        // Error jika diatas 0! 
        if ($_FILES["poster"]["error"] == 0) {
            // Upload file berhasil!
            var_dump($_FILES['poster']);
            $tipefile = explode(".",$_FILES['poster']['name']);
<<<<<<< HEAD
            $ctr = count($tipefile)-1;
            $tipefile = $tipefile[$ctr];
=======
            $tipefile = $tipefile[1];
            var_dump($tipefile);
>>>>>>> 547fdddef475679dd97d2c20c2bfd36ded2d7fe8
            $status = move_uploaded_file($_FILES["poster"]["tmp_name"], 
                __DIR__."/poster/".$_POST['judul'].".".$tipefile);
            if ($status != false) {
                
                $genre = $_POST['genre'];
                $cast = $_POST['cast'];
                $queryinsert='INSERT INTO film(judul,tahun,deskripsi,durasi,poster) VALUES(:judul,:tahun,:deskripsi,:durasi,:poster)';
                try {
                    #insert ke table film
                    $stmt=$db->prepare($queryinsert);
                    $stmt->bindValue(':judul',$_POST['judul'],PDO::PARAM_STR);
                    $stmt->bindValue(':tahun',$_POST["tahun"],PDO::PARAM_STR);
                    $stmt->bindValue(':durasi',$_POST['durasi'],PDO::PARAM_STR);
                    $stmt->bindValue(':deskripsi',$_POST['deskripsi'],PDO::PARAM_STR);
                    $stmt->bindValue(':poster',$_POST['judul'].".".$tipefile,PDO::PARAM_STR);
                    $result=$stmt->execute();
                    
                    #dapatkan id movie
                    $query = "SELECT max(id_film) AS id_film FROM film";
                    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                    $id_film = $result[0]["id_film"];


                     #cek apakah genre sudah ada atau belum jika ada insert baru
                    foreach ($genre as $key => $value) {              
                        $query = "SELECT * FROM genre where nama_genre = '$value'";
                        $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                        if(!$result){
                            #jika genre belum ada insert ke table genre
                            $query = "INSERT INTO genre(nama_genre) VALUES(:nama_genre)";
                            $stmt=$db->prepare($query);
                            $stmt->bindValue(':nama_genre',$value,PDO::PARAM_STR);
                            $result=$stmt->execute();
                        }
                        #insert ke table filmgenre
                        $query = "INSERT INTO filmgenre(nama_genre,id_film) VALUES(:nama_genre,:id_film)";
                            $stmt=$db->prepare($query);
                            $stmt->bindValue(':nama_genre',$value,PDO::PARAM_STR);
                            $stmt->bindValue(':id_film',$id_film,PDO::PARAM_STR);
                            $result=$stmt->execute();

                    }
                    #cek apakah cast sudah ada atau belum jika ada insert baru
                    $cast = $_POST['cast'];
                    foreach ($cast as $key => $value) {              
                        $query = "SELECT * FROM listcast where nama_cast = '$value'";
                        $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                        if(!$result){
                            #jika cast belum ada insert ke table cast
                            $querycast = "INSERT INTO listcast(nama_cast) VALUES(:nama_cast)";
                            $stmt=$db->prepare($querycast);
                            $stmt->bindValue(':nama_cast',$value,PDO::PARAM_STR);
                            $result=$stmt->execute();
                        }
                        #insert ke table filmcast
                        $query = "INSERT INTO filmcast(nama_cast,id_film) VALUES(:nama_cast,:id_film)";
                            $stmt=$db->prepare($query);
                            $stmt->bindValue(':nama_cast',$value,PDO::PARAM_STR);
                            $stmt->bindValue(':id_film',$id_film,PDO::PARAM_STR);
                            $result=$stmt->execute();
            
                    }
                    
                }
                 catch (\Throwable $th) {
                        //throw $th;
                }
            }
            header('Location: film.php');
        } else {
            // Jika file upload diatas 0 error code nya, maka upload file gagal!
            echo "Tidak ada file yang diterima oleh server!";
        }
    }
//}
if(isset($_POST['btncancel'])){
    header('Location: film.php');
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />


    <title>Hello, world!</title>
</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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
    </form>

    <div class="container mt-5 col-5">
        <h3 class="mb-5">Add Film</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label><br>
                <input class="form-control" type="text" name="judul">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label><br>
                <input class="form-control" type="text" name="tahun">
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
                <select class="form-control" multiple="multiple" name="genre[]" id="genre">
                   <?php
                    $query = "SELECT nama_genre FROM genre";
                    $listgenre = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
         
                    foreach ($listgenre as $key => $value) {        
                        $itemgenre = $listgenre[$key]["nama_genre"];  
                        echo("<option>$itemgenre</option>");
                    }
                   ?>
                </select>
                <!-- <input class="form-control" type="text" name="genre"> -->
            </div>
            <div class="form-group">
                <label for="durasi">Durasi (Menit)</label><br>
                <input class="form-control" type="text" name="durasi">
            </div>
            <div class="form-group">
                <label for="judul">Deskripsi</label><br>
                <textarea class="form-control" rows="5" name="deskripsi"></textarea>
            </div>

            <div class="form-group">
                <label for="Poster">Poster</label><br>
                <input type="file" name="poster"><br />
            </div>
            <button type="submit" class="btn btn-primary" name="btnadd">Add</button>
            <button class="btn btn-danger" name="btncancel">Cancel</button>
        </form>
    </div>

<<<<<<< HEAD




=======
>>>>>>> 547fdddef475679dd97d2c20c2bfd36ded2d7fe8
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
<<<<<<< HEAD
    <!-- Footer -->
    <footer class="page-footer font-small bottom bg-dark text-light mt-5">
        <div class="footer-copyright text-center py-3">© 2020 Copyright
        </div>
    </footer>
=======
   
   <!-- Footer -->
   <footer class="page-footer font-small bottom bg-dark text-light mt-5">
       <div class="footer-copyright text-center py-3">© 2020 Copyright
       </div>
   </footer>

>>>>>>> 547fdddef475679dd97d2c20c2bfd36ded2d7fe8
</html>