<?php
    include "DB/database.php";
    session_start();
    if (!isset($_SESSION["email"])){
        header("Location: ticketing.php");
     }
    if(isset($_POST['btnadd'])){
        $queryinsert='INSERT INTO studio(nama_studio,id_cabang) VALUES(:nama_studio,:id_cabang)';
        try {
            $stmt=$db->prepare($queryinsert);
            $stmt->bindValue(':nama_studio',$_POST['nama_studio'],PDO::PARAM_STR);
            $stmt->bindValue(':id_cabang',$_POST["cabang"],PDO::PARAM_STR);
            $result=$stmt->execute();
            header('Location: studio.php');
    }
         catch (\Throwable $th) {
                //throw $th;
        }
}


if(isset($_POST['btncancel'])){
    header('Location: studio.php');
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
    <title>Studio</title>
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
                    <li class="nav-item">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="studio.php">Studio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="konfirmasi.php">Konfirmasi Pembayaran</a>
                    </li>
                </ul>
                <form method="POST">
                <button class = 'btn btn-danger ml-4' type='submit' name='btn_logout'>Logout</button>
                </form>
                <?php
                if (isset($_POST['btn_logout'])) {
                    unset($_SESSION['email']);
                    unset($_SESSION['snackcart']);
                    header("Location: index.php");
                }
                ?>
        </nav>


        <div class="container mt-5">
            <form method="post">
                <div class="form-group">
                    <label for="nama_studio">Nama</label><br>
                    <input class="form-control" type="text" name="nama_studio" required>
                </div>
                <div class="form-group">
                <label for="cast">Cabang</label><br>
              <select class="form-control" name="cabang" id="cabang">
                   <?php
                    $querycabang = "SELECT id_cabang,nama_cabang FROM cabang";
                    $listcabang = $db->query($querycabang)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listcabang as $key => $value) {        
                        $id_cabang = $listcabang[$key]["id_cabang"];  
                        $cabang = $listcabang[$key]["nama_cabang"];  
                        echo("<option value ='$id_cabang'>$cabang</option>");
                    }
                   ?>
                </select>
                </div>
                    <button class="btn btn-primary" name="btnadd">Add</button>
                <button class="btn btn-danger" name="btncancel">Cancel</button>
                </div>
                
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

</script>
</body>
        <!-- Footer -->
        <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>

</html>