<?php
    include "DB/database.php";
    session_start();
    if (!isset($_SESSION["email"])){
        header("Location: ticketing.php");
     }
    if(isset($_POST['btnedit'])){
        $queryupdate="UPDATE jadwal set id_film= :id_film, id_cabang = :id_cabang,id_studio =:id_studio,jam =:jam,tanggal =:tanggal,status =:status where id_jadwal = $_GET[jadwal]";
        try {
            $stmt=$db->prepare($queryupdate);
            $stmt->bindValue(':id_film',$_POST['film'],PDO::PARAM_STR);
            $stmt->bindValue(':id_cabang',$_POST['cabang'],PDO::PARAM_STR);
            $stmt->bindValue(':id_studio',$_POST['studio'],PDO::PARAM_STR);
            $stmt->bindValue(':tanggal',$_POST["tanggal"],PDO::PARAM_STR);
            $stmt->bindValue(':jam',$_POST["jam"],PDO::PARAM_STR);
            $stmt->bindValue(':status',$_POST['status'],PDO::PARAM_STR);
            $result=$stmt->execute();
           
    }
         catch (\Throwable $th) {
                //throw $th;
                echo($th);
        }

        $queryticket="UPDATE ticket SET harga_ticket = $_POST[harga_ticket] where id_jadwal =$_GET[jadwal]";
        $stmt = $db->exec($queryticket);
        header('Location: jadwal.php');
}
$query = "SELECT * from jadwal where id_jadwal = $_GET[jadwal]";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['btncancel'])){
    header('Location: jadwal.php');
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

    <title>Jadwal</title>
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
                    <li class="nav-item">
                        <a class="nav-link" href="film.php">Film</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="snack.php">Snack</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="jadwal.php">Jadwal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cabang.php">Cabang</a>
                    </li>
                    <li class="nav-item">
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
            </div>
        </nav>


        <div class="container mt-5 col-5">
        <h3 class="mb-5">Edit Jadwal</h3>
            <form id="add_jadwal">
                <div class="form-group">
                <label for="cast">Film</label><br>
              <select class="form-control" name="film" id="flm">
                   <?php
                    $query = "SELECT id_film,judul FROM film";
                    $listfilm = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listfilm as $key => $value) {        
                        $id_film = $listfilm[$key]["id_film"];  
                        $judul = $listfilm[$key]["judul"];  
                        echo("<option value ='$id_film'>$judul</option>");
                    }
                   ?>
                </select>
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

                <div class="form-group">
                <label for="cast">Studio</label><br>
                <select class="form-control" name="studio" id="studio">
                    <option value="">Pilih cabang dulu</option>
                </select>
                </div>


                <div class="form-group">
                <label for="cast">Tanggal</label><br>
                <input class="input-group date" type="date" id="tanggal" name="tanggal">
                </div>
                <div class="form-group">
                <label for="cast">Jam</label><br>
                <input class="input-group " id="jam" type ="time" name="jam">
                </div>
                
                <div class="form-group">
                    <label for="harga_ticket">Harga Ticket</label><br>
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="harga_ticket" name='harga_ticket' required>
                    </div>

                </div>
                <div class="form-group">
                <label for="status">Status</label><br>
                <select class="form-control" name="status" id="status">
                    <option value="0">Coming Soon</option>
                    <option value="1">Sedang Tayang</option>
                    <option value="2">Selesai Tayang</option>
                </select>
                </div>

                    <button class="btn btn-primary" name="btnedit">Edit</button>
                <button class="btn btn-danger" name="btncancel">Cancel</button>
                </div>
                
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
          <script src="jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
        <script src="http://transtatic.com/js/numericInput.min.js"></script>
<script>
            $("#harga_ticket").numericInput({
                allowNegative: "false",
                allowFloat: "false"
            })

        $("#cabang").change(function(){
        loadstudio($(this).val());
    });

    function loadstudio(id) {
        $("#studio").html("");
        $.ajax({
        method: "post", // metode ajax
        url: "loadstudio.php", // tujuan request
        data: {
            'id': id
        }, // data yang dikirim
        success: function(res) {
            studio = JSON.parse(res);
            studio.forEach(item => {
                $("#studio").append(`
                <option value = `+item.id_studio+`>`+item.nama_studio+`</option>
                `)
            })
        }
    });
}
</script>
</body>

   
        <!-- Footer -->
        <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>

</html>