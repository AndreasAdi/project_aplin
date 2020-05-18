<?php
include "DB/database.php";
session_start();
if (isset($_FILES["bukti"])) {
    // Kalau dikirim, cek apakah file yang di upload error apa tidak
    // Error jika diatas 0! 
    if ($_FILES["bukti"]["error"] == 0) {
        // Upload file berhasil!
        var_dump($_FILES['bukti']);
        $tipefile = explode(".",$_FILES['bukti']['name']);

        $ctr = count($tipefile)-1;
        $tipefile = $tipefile[$ctr];

        $status = move_uploaded_file($_FILES["bukti"]["tmp_name"], 
            __DIR__."/bukti/".$_SESSION['email'].".".$tipefile);
        $nama = $_SESSION['email'].".".$tipefile;
        if ($status != false) {
            $queryupdate="UPDATE pendingticket
            SET buktiBayar = '$nama'
            WHERE id_tiket = '$_SESSION[id_tiket]'";
            $db->exec($queryupdate);
        }
        unset($_SESSION['snackcart']);
        header('Location: index.php');
    } else {
        // Jika file upload diatas 0 error code nya, maka upload file gagal!
        echo "Tidak ada file yang diterima oleh server!";
    }
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

    <title>Pembayaran</title>
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
                    <a class="nav-link" href="List_Film.php">List Film</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Meals.php">Pre-Order Snack</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Ticketing.php">Ticketing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Riwayat.php">Riwayat</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- ISIAN PERTAMA-->
    <br>
    <div class="container mb-5">
        <div class="alert alert-success" role="alert">
            Berhasil booking tiket, Silahkan melakukan pembayaran
        </div>
        <div>
            <h3>Rincian</h3>
            <h4>Tiket</h4>
            <?php
        //isi detail tiket
            $querySelectDataTiket="SELECT * FROM pendingticket WHERE id_tiket = '$_SESSION[id_tiket]'";
            $stmt=$db->prepare($querySelectDataTiket);
            $stmt->execute();
            $dataDetailTiket=$stmt->fetch(PDO::FETCH_ASSOC);
            $totalsemua = $dataDetailTiket['Harga'];
            echo "Seats : $dataDetailTiket[Seat]<br>";
            echo "Total : ".number_format($dataDetailTiket['Harga'], 0, ',', '.');

            // echo "<ul class='list-group' style='width:35%;'>
            // <li class='list-group-item'>Seats : $dataDetailTiket[Harga]</li>
            // </ul>";
        ?>
            <h4>Snack</h4>
            <?php
            if(isset($_SESSION['snackcart'])) {
                $total = 0;
                foreach ($_SESSION['snackcart'] as $key => $value) {
                    $total = $total + $value['totalharga'];
                    echo "<ul class='list-group' style='width:35%;'>
                    <li class='list-group-item'>$value[namasnack] x $value[jumlah] = ".number_format($value['totalharga'], 0, ',', '.')."</li>
                    </ul>";
                }
                echo "Total : ".number_format($total, 0, ',', '.');
                $totalsemua = $totalsemua + $total;
            }
            else {
                echo "-";
            }
            echo "<br><br><br>";
            echo "<h3>Total Pembayaran : ".number_format($totalsemua, 0, ',', '.')."</h3>";
            echo "Metode pembayaran : Bank Transfer<br>";
            echo "Nomor Rekening : 1233 1233 1233";

        ?>
            <br><br>
        </div>
        <form method='post' enctype="multipart/form-data">
            <div class='form-group'>
                <label>Upload Bukti Pembayaran</label>
                <input type='file' class='form-control-file' name='bukti'>
                <button type='submit' name='bayar' class='btn btn-primary mb-5'>Bayar</button>
            </div>
        </form>
    </div>
</body>


<!--FOOTER-->
<footer class="page-footer font-small bottom bg-dark text-light mt-5">
    <div class="footer-copyright text-center py-3">© 2020 Copyright
    </div>
</footer>

</html>