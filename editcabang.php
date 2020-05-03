<?php
    include "DB/database.php";
    session_start();
    
    if(isset($_POST['btnedit'])){
        $queryupdate="UPDATE cabang set nama_cabang= :nama_cabang, kota_cabang = :kota_cabang, alamat_cabang= :alamat_cabang where id_cabang = $_GET[cabang]";
        try {
            $stmt=$db->prepare($queryupdate);
            $stmt->bindValue(':nama_cabang',$_POST['nama_cabang'],PDO::PARAM_STR);
            $stmt->bindValue(':kota_cabang',$_POST["kota_cabang"],PDO::PARAM_STR);
            $stmt->bindValue(':alamat_cabang',$_POST["alamat_cabang"],PDO::PARAM_STR);
            $result=$stmt->execute();
            header('Location: cabang.php');
    }
         catch (\Throwable $th) {
                //throw $th;
        }
}
$query = "SELECT * from cabang where id_cabang = $_GET[cabang]";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['btncancel'])){
    header('Location: cabang.php');
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
        <!--NAVBAR-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
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
                    <li class="nav-item active">
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
        <h3 class="mb-5">Edit Cabang</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Cabang</label><br>
                <input class="form-control" type="text" name="nama_cabang" value="<?php echo ($result[0]['nama_cabang'])?>">
            </div>
            <div class="form-group">
                <label>Kota</label><br>
                <input class="form-control" type="text" name="kota_cabang" value="<?php echo ($result[0]['kota_cabang'])?>">
            </div>

            <div class="form-group">
                <label>Alamat</label><br>
                <input class="form-control" type="text" name="alamat_cabang" value="<?php echo ($result[0]['alamat_cabang'])?>">
            </div>

            <button type="submit" class="btn btn-primary" name="btnedit">Edit</button>
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