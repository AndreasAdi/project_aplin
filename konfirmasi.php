<?php
    include "DB/database.php";
    include("DB/function.php");
    session_start();

    $query = "SELECT * FROM pendingticket where StatusBayar = 'Pending'";
    // Query Bare! Jangan digunakan kalau TERIMA DATA DARI CLIENT!
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['confirm'])){
        //ubah status jadi confirmed
        $id = $_POST['confirm'];
        $queryupdate="UPDATE pendingticket
        SET StatusBayar = 'Confirmed'
        WHERE id_tiket = '$id'";
        $db->exec($queryupdate);
        $queryupdate="UPDATE header_ordersnack
        SET status_order = 'Confirmed'
        WHERE id_tiket = '$id'";
        $db->exec($queryupdate);
        
        //Select Email User
        $querySelectEmailUser="SELECT * FROM pendingticket WHERE id_tiket = $id";
        $stmt=$db->prepare($querySelectEmailUser);
        $stmt->execute();
        $resultEmail = $stmt->fetch(PDO::FETCH_ASSOC);

        //Select Judul Film
        $querySelectJudul="SELECT * FROM film WHERE id_film = $resultEmail[id_film]";
        $stmt=$db->prepare($querySelectJudul);
        $stmt->execute();
        $resultJudul = $stmt->fetch(PDO::FETCH_ASSOC);

        //Select Nama Studio dan id Cabang
        $querySelectStudio="SELECT * FROM studio WHERE id_studio=$resultEmail[studio]";
        $stmt=$db->prepare($querySelectStudio);
        $stmt->execute();
        $resultStudio=$stmt->fetch(PDO::FETCH_ASSOC);

        //Select Nama Cabang
        $querySelectCabang="SELECT * FROM cabang WHERE id_cabang=$resultStudio[id_cabang]";
        $stmt=$db->prepare($querySelectCabang);
        $stmt->execute();
        $resultCabang=$stmt->fetch(PDO::FETCH_ASSOC);

        //Select Header snack
        $querySelectHeader="SELECT * FROM header_ordersnack WHERE id_tiket=$id";
        $stmt=$db->prepare($querySelectHeader);
        $stmt->execute();
        $resultHeader=$stmt->fetch(PDO::FETCH_ASSOC);

        //Select snack detail
        $querySelectDetail="SELECT * FROM ordersnack WHERE id_header=$resultHeader[id_header]";
        $stmt=$db->prepare($querySelectDetail);
        $stmt->execute();
        $resultDetail=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $total = 0;
        foreach ($resultDetail as $key => $value) {
            $total = $total + $value['totalharga'];
        }
        $total = $total + $resultEmail['Harga'];

        if ($resultDetail) { //kalau ada snack
            $isi = "<b>Judul:</b> $resultJudul[judul]<br>
            <b>Cabang: </b> $resultCabang[nama_cabang] <br>
            <b>Studio: </b> $resultStudio[Nama_Studio]<br> 
            <b>Tanggal: </b>$resultEmail[tanggal]<br> 
            <b>Jam: </b>$resultEmail[jam]<br>
            <b>Seat: </b>$resultEmail[Seat]<br> 
            <b>Snacks: </b><br>";
            foreach ($resultDetail as $key => $value) {
                $isi = $isi . "$value[nama_snack] @$value[harga_snack] x $value[jumlah_snack] = $value[totalharga]<br>";
            }
            $isi = $isi . "
            <b>Grand Total: </b>$total<br>
            Thank you for your purchase at <b>Bioskop Id</b>,Enjoy Your Movie.";
            sendEmail($resultEmail['Email'], "Your Receipt for ".$resultJudul['judul']."",$isi);
        }
        else { //kalau tidak ada snack
            sendEmail($resultEmail['Email'], "Your Receipt for ".$resultJudul['judul']."","<b>Judul:</b> $resultJudul[judul]<br>
                        <b>Cabang: </b> $resultCabang[nama_cabang] <br>
                        <b>Studio: </b> $resultStudio[Nama_Studio]<br> 
                        <b>Tanggal: </b>$resultEmail[tanggal]<br> 
                        <b>Jam: </b>$resultEmail[jam]<br> 
                        <b>Seat: </b>$resultEmail[Seat]<br> 
                        <b>Grand Total: </b>$resultEmail[Harga]<br>
                        Thank you for your purchase at <b>Bioskop Id</b>,Enjoy Your Movie.");
        }
        
    }
    if(isset($_POST['reject'])){
        $id = $_POST['reject'];
        //ubah status jadi confirmed
        $queryupdate="UPDATE pendingticket
        SET StatusBayar = 'Rejected'
        WHERE id_tiket = '$id'";
        $db->exec($queryupdate);
        $queryupdate="UPDATE header_ordersnack
        SET status_order = 'Rejected'
        WHERE id_tiket = '$id'";
        $db->exec($queryupdate);

        $queryseat = "SELECT * FROM pendingticket where id_tiket = '$id'";
        $hasil = $db->query($queryseat)->fetch(PDO::FETCH_ASSOC);
        $idjadwal = $hasil['id_jadwal'];
        $seat = explode(',',$hasil['Seat']);
        for ($i=0; $i < count($seat)-1; $i++) {
            $query="UPDATE seat
            SET status = 0
            WHERE nama = '$seat[$i]' and id_jadwal = '$idjadwal'";
            $stmt = $db->exec($query);
        }
        //tambah diubah status seatnya (belum bisa), seharusnya table pendingticket itu isinya id_jadwal bukan id_film
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
    <!-- datatable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Konfirmasi</title>
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
                    <li class="nav-item active">
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


        <div class="container mt-5">
            <form method="post">
                <div class="container mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Seat</th>
                                <th>Total Tiket</th>
                                <th>Total Snack</th>
                                <th>Total Semua</th>
                                <th>Bukti</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 foreach ($result as $key => $value) {
                                $totalsemua = 0;
                            ?>
                           
                            <tr>
                                <td><?php echo $value["Email"];?></td>
                                <td><?php echo $value["Seat"];?></td>
                                <td><?php
                                $totalsemua = $totalsemua + $value['Harga']; 
                                echo number_format($value["Harga"], 0, ',', '.');?></td>
                                <td><?php
                                    $querysnack = "SELECT * FROM header_ordersnack where id_tiket = $value[id_tiket]";
                                    $resultsnack = $db->query($querysnack)->fetch(PDO::FETCH_ASSOC);
                                    if ($resultsnack) {
                                        $idheader = $resultsnack['id_header'];
                                        $querysnack = "SELECT * FROM ordersnack where id_header = $idheader";
                                        $resultsnack = $db->query($querysnack)->fetchAll(PDO::FETCH_ASSOC);
                                        $total = 0;
                                        foreach ($resultsnack as $keya => $valuea) {
                                            $total = $total + $valuea['totalharga'];
                                        }
                                        $totalsemua = $totalsemua + $total;
                                        echo number_format($total, 0, ',', '.');
                                    }
                                    else {
                                        echo "Tidak ada snack";
                                    }

                                ?></td>
                                <td><?php echo number_format($totalsemua, 0, ',', '.');?></td>
                                <td><?php if ($value['buktiBayar'] == "-") {
                                    echo "Belum ada butki";
                                }
                                else {
                                    echo "<img src='bukti/$value[buktiBayar]' width='300px' height='200px'>";
                                } ?></td>
                                <td><?php echo"<button class='btn btn-success' type ='submit' value ='$value[id_tiket]' name ='confirm'>Confirm</button><button class='btn btn-danger' type ='submit' value ='$value[id_tiket]' name ='reject'>Reject</button>";?></td>
                            </tr>
                            <?php
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

    <!--FOOTER-->
    <footer class="page-footer font-small bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>
</html>