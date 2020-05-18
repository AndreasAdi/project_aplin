<?php
session_start();
include_once "DB/database.php";
if (!isset($_SESSION['email'])) {
    header("Location: Ticketing.php");
}

$querySelectedFilm = "SELECT * FROM film WHERE id_film=$_GET[idfilm]";
$stmt = $db->prepare($querySelectedFilm);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$querySelectedFilmCast = "SELECT * FROM filmcast WHERE id_film=$_GET[idfilm]";
$stmt = $db->prepare($querySelectedFilmCast);
$stmt->execute();
$resultcast = $stmt->fetchAll(PDO::FETCH_ASSOC);

$querygenre = "SELECT nama_genre FROM filmgenre WHERE id_film = $_GET[idfilm]";
$stmt = $db->prepare($querygenre);
$stmt->execute();
$resultgenre = $stmt->fetchAll(PDO::FETCH_ASSOC);


$query = "SELECT DISTINCT c.kota_cabang FROM cabang c, jadwal j WHERE c.id_cabang = j.id_cabang AND j.id_film = $_GET[idfilm]";
$stmt = $db->prepare($query);
$stmt->execute();
$listkota = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $query = "SELECT DISTINCT c.nama_cabang,c.id_cabang FROM cabang c, jadwal j WHERE c.id_cabang = j.id_cabang AND j.id_film = $_GET[idfilm]";
// $stmt = $db->prepare($query);
// $stmt->execute();
// $listcabang = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['select'])) {
    $queryAmbilNamaCabang = "SELECT * FROM cabang WHERE id_cabang=$_POST[select]";
    $stmt = $db->prepare($queryAmbilNamaCabang);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Location: Pilih_Jadwal.php?nama=' . $result['nama_cabang'] . '&idCabang=' . $_POST['select'] . '&idFilm=' . $_GET['idfilm'] . '&judul=' . $_POST['judul'] . '');
}

if (isset($_POST['btn_logout'])) {
    unset($_SESSION['email']);
    header("Location: index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="detailfilm.css">
    <link rel="stylesheet" href="YoutubePopUp.css">
    <title><?php echo $result['judul'] ?></title>
</head>

<body>
    <input type="hidden" id="email" value="<?php echo($_SESSION['email'])?>">
    <img id="bg" src='poster/<?php echo "$result[poster]" ?>'>
    <form method='post'>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="Meals.php">Pre-Order Snack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Riwayat.php">Riwayat</a>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['email'])) {
                    echo "<a href='Register.php'><button class = 'btn btn-primary' type ='button'>Register</button></a>
                   <a href='Ticketing.php'> <button class = 'btn btn-success' type ='button'>Login</button> </a>";
                } else {
                    echo "<button class = 'btn btn-danger' name='btn_logout'>Logout</button>";
                }
                ?>
                ?>

            </div>
        </nav>

        <!-- <img style='width: 400px; height: 500px;' src='poster/<?php echo "$result[poster]" ?>'> -->
        <!--Deskripsi Dan Cast -->
        <div class="container text-light">
            <input type="hidden" id='id_film' value='<?php echo $_GET['idfilm']; ?>'>
            <div class="row">
                <div class="col-5 mt-5">
                    <img style='height: 500px;' src='poster/<?php echo "$result[poster]" ?>'>
                </div>
                <div class="col-7 mt-5">
                    <h1><?php echo "<b>$result[judul]</b>" ?>
                        <input type="hidden" name='judul' value='<?php echo $result['judul']; ?>'>
                    </h1>

                    <div class="d-flex justify-content-start">
                        <div class="mr-2">
                            <b>
                                <?php echo "$result[tahun]" ?>
                            </b>

                        </div>
                        <div>

                            <?php
                            foreach ($resultgenre as $key => $value) {
                                echo "<span class='badge badge-secondary mr-1'>";
                                echo $value["nama_genre"];
                                echo "</span>";
                            }
                            ?>
                        </div>


                    </div>
                    <div class="mt-4">
                        <h4><b>Sinopsis</b></h4>
                        <?php echo $result['deskripsi']; ?>
                        <h4 class="mt-4"><b>Cast</b></h4>
                        <?php
                        foreach ($resultcast as $key => $value) {
                            echo "<span class='badge badge-secondary mr-1'>";
                            echo $value['nama_cast'];
                            echo "</span>";
                        }
                        ?>
                    </div>


                    <!-- Buat Nampilin Bioskop e -->
                    <div class="mt-5 mb-5">
                        <button class="btn btn-warning pt-2" type="button" data-toggle="modal" data-target="#modalseat">
                            <i class="fas fa-ticket-alt h4"></i>
                            <span class="h4 font-weight-bold">Book Ticket</span>
                        </button>
                        <button class="btn btn-danger pt-2" type="button">
                            <a class="text-light" id="trailer" href="<?php echo ($result['trailer']) ?>" style="text-decoration : none">
                                <i class="fas fa-film h4"></i>
                                <span class="h4 font-weight-bold">Watch Trailer</span>
                            </a>
                        </button>
                    </div>



                    <!-- <?php
                            $querySelectJadwal = "SELECT DISTINCT id_cabang FROM jadwal WHERE id_film=$_GET[idfilm]";
                            $stmt = $db->prepare($querySelectJadwal);
                            $stmt->execute();
                            $resultJadwal = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                        
                            <table class="table bg-light">
                                <thead class="thead-dark">
                                    <th>Nama</th>
                                    <th>Select</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($resultJadwal as $key => $value) {
                                        $querySelectCabang = "SELECT * FROM cabang WHERE kota_cabang='$_SESSION[kota]' AND id_cabang=$value[id_cabang]";
                                        $stmt = $db->prepare($querySelectCabang);
                                        $stmt->execute();
                                        $resultCabang = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($resultCabang as $key => $value) {
                                            echo "
                                            <tr>
                                                <td>$value[nama_cabang]</td>
                                                <td>
                                                <button class='btn btn-primary' name='select' value='$value[id_cabang]'>Select</button></td>
                                            </tr>
                                        ";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table> -->


                </div>


            </div>

        </div>
        <!--Simulasi Kursi Bioskop-->
        <div class="modal fade modal-fullscreen" id="modalseat" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">

                    <select class="form-control col-2 ml-2" name="kota" id="kota">
                            <option>Pilih Kota</option>
                            <?php
                            foreach ($listkota as $key => $value) {
                                echo "<option value ='$value[kota_cabang]'>$value[kota_cabang]</option>";
                            }
                            ?>
                        </select>

                        <select class="form-control col-2 ml-2" name="cabang" id="cabang">
                            <<option>Pilih Cabang</option>
                            <?php
                            foreach ($listcabang as $key => $value) {
                                echo "<option value ='$value[id_cabang]'>$value[nama_cabang]</option>";
                            }
                            ?> -->
                        </select>

                        <select class="form-control col-2 ml-2" name="studio" id="studio">
                        </select>

                        <select class="form-control col-3 ml-2" name="tanggal" id="tanggal">
                        </select>
                        <select class="form-control col-2 ml-2" name="jam" id="jam"></select>

                        <div class="container-fluid  mt-1 text-center" id="seat"></div>

                        <div class="container-fluid mr-auto mt-1 text-center" id="info">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <h3 id="harga_ticket"></h3>
                        <h3 id="total" class="mr-3"></h3>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning text-dark" id="btnconfirm">Finish Book</button>
                    </div>
                </div>
            </div>
        </div>




    </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="YoutubePopUp.jquery.js"></script>
    <script src="bs-modal-fullscreen.js"></script>
    <script src="https://kit.fontawesome.com/b371d8c573.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script>
        var total = 0;
        var harga_ticket = 0;
        jQuery("a#trailer").YouTubePopUp();
        $(document).ready(function() {
            $('#modalseat').fullscreen();

            $("#kota").change(function() {
                loadcabang($(this).val(), $("#id_film").val());

            })
            $("#cabang").change(function() {
                loadstudio($(this).val(), $("#id_film").val());

            })
            $("#jam").change(function() {
                loadseat($("#studio").val(), $("#jam").val(), $("#tanggal").val());
            })
            $("#tanggal").change(function() {
                loadseat($("#studio").val(), $("#jam").val(), $("#tanggal").val());
            })
            $("#studio").change(function() {
                loadseat($("#studio").val(), $("#jam").val(), $("#tanggal").val());
            })

            $(document).on('click', '#btnconfirm', function(e) {
                seatdipilih();
                e.preventDefault();
                harga = total * harga_ticket;
                $.ajax({
                    method: "post", // metode ajax
                    url: "AjaxInsertTicket.php", // tujuan request
                    data: {
                        id_film: $("#id_film").val(),
                        tgl: $("#tanggal").val(),
                        jam: $("#jam").val(),
                        seat: $("#selectedseat").val(),
                        harga: harga,
                        Email: $('#email').val(),
                        Studio: $('#studio').val(),
                        jadwal: $('#id_jadwal').val()
                    }, // data yang dikirim
                    success: function(res) {
                        // window.location.replace("http://www.w3schools.com")
                        if (res == 'sukses') {
                            alert('Berhasil');
                            seat = '';
                            location.replace("Meals.php");
                        } else {
                            alert('gagal');
                        }
                    }
                });
            });

        })

        function loadstudio(id_cabang, id_film) {
            $("#seat").html('');
            $("#harga_ticket").html('');
            $("#total").html('');
            $("#info").html('');
            $("#studio").html('');
            $("#tanggal").html('');
            $("#jam").html('');
            $.ajax({
                method: "post", // metode ajax
                url: "loadstudio1.php", // tujuan request
                data: {
                    'id_cabang': id_cabang,
                    'id_film': id_film
                }, // data yang dikirim
                success: function(res) {
                    studio = JSON.parse(res);
                    console.log(studio);
                    studio.forEach(item => {
                        $("#studio").append(`
                    <option value = ` + item.id_studio + `>` + item.nama_studio + `</option>
                    `)
                        $("#tanggal").append(`
                    <option value = ` + item.tanggal_value + `>` + item.tanggal + `</option>
                    `)
                        $("#jam").append(`
                    <option value = ` + item.jam + `>` + item.jam + `</option>
                    `)
                    })
                    loadseat($("#studio").val(), $("#jam").val(), $("#tanggal").val());
                }
            });

        }

        function loadcabang(kota_cabang, id_film) {
            $("#cabang").html('');
            $("#seat").html('');
            $("#harga_ticket").html('');
            $("#total").html('');
            $("#info").html('');
            $("#studio").html('');
            $("#tanggal").html('');
            $("#jam").html('');
            $("#cabang").append(`
                    <option>Pilih Cabang</option>
                    `)
            $.ajax({
                method: "post", // metode ajax
                url: "loadcabang.php", // tujuan request
                data: {
                    'kota_cabang': kota_cabang,
                    'id_film': id_film
                }, // data yang dikirim
                success: function(res) {
                    studio = JSON.parse(res);
                    console.log(studio);
                    studio.forEach(item => {
                        $("#cabang").append(`
                    <option value = ` + item.id_cabang + `>` + item.nama_cabang + `</option>
                    `)
                      
                    })
                }
            });

        }

        function loadseat(id_studio, jam, tanggal) {
            total = 0;
            ctr2 =0;
            loadtotal();
            $("#seat").html('');
            $("#harga_ticket").html('');
            $("#total").html('');
            $("#info").html('');
            $.ajax({
                method: "post", // metode ajax
                url: "loadseat.php", // tujuan request
                data: {
                    'id_studio': id_studio,
                    'jam': jam,
                    'tanggal': tanggal
                }, // data yang dikirim
                success: function(res) {
                    if(res!="[]"){
                        seat = JSON.parse(res);
                    ctr = 0;
                    $("#seat").append(`<div class ="text-center bg-dark text-light">Screen</div>`)
                    seat.forEach(item => {
                        ctr++;
                        ctr2++;
                        bg = "";
                        if (item.status == 0) {
                            bg = "success";
                        } else {
                            bg = "secondary";
                        }
                        $("#seat").append(`<button type ="button" class= 'btn btn-` + bg + ` text-center text-light  m-1 ' style ="height :50px; width : 50px" id="kursi" status = "` + item.status + `" value = "` + item.id_seat + `">` + item.nama + `</button>`)

                        if (ctr == 8) {
                            $("#seat").append('<br>')
                            ctr = 0;
                        }
                        if (ctr2 == 64) {
                            $("#seat").append(`<input id="id_jadwal" type ="hidden" value ="`+item.id_jadwal+`" name="id_jadwal">`);
                            $("#seat").append(`<input id ="id_film" type ="hidden" value ="`+item.id_film+`" name="id_film">`);
                            ctr2 = 0;
                        }
                        harga_ticket = item.harga_ticket;
                        $("#harga_ticket").html('');
                        $("#harga_ticket").append("Harga Ticket : Rp." + seperator(item.harga_ticket))
                    })


                    $("#info").append(`
                    Available Seat: <span class="bg-success  ml-2 mr-2">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    Reserved Seat : <span class="bg-secondary ml-2 mr-2">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    Your Seat : <span class="bg-warning ml-2 mr-2">&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                    `)
                    }
                    else{
                        $("#seat").append('<h1>No Seat Available</h1>')
                    }
                    
                }
            });





        }


        $(document).on("click", "#kursi", (function(e) {

            if ($(this).attr("status") == 0) {
                console.log("masuk");
                $(this).removeClass("btn");
                $(this).removeClass("btn-success");
                $(this).addClass("btn");
                $(this).addClass("btn-warning");
                $(this).attr("status", 2)
                total++;
            } else if ($(this).attr("status") == 2) {
                console.log("masuk");
                $(this).removeClass("btn");
                $(this).removeClass("btn-warning");
                $(this).addClass("btn");
                $(this).addClass("btn-success");
                $(this).attr("status", 0);
                total--;
            }

            loadtotal();
          
        }))

        function loadtotal() {
            $("#total").html(``);
            $("#total").append("Total : " + seperator((total * harga_ticket)));

        }

        function seperator(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        var temp ="";
        function seatdipilih() {
            var btnkursi = $(".btn-warning#kursi");
            for (let i = 0; i < btnkursi.length; i++) {
                console.log($((btnkursi)[i]).val());
                temp = temp+$((btnkursi)[i]).text()+",";
                console.log(temp);
            }
            $("#seat").append(`<input id="selectedseat" type ="hidden" value = "`+temp+`">`)
        }
    </script>

</body>

</html>