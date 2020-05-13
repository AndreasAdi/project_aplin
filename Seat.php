<?php
      session_start();
      include_once "DB/database.php";
      if(!isset($_SESSION['Email'])){
        header("Location: Ticketing.php");
    }

      $selectGambarFilm="SELECT * FROM film WHERE id_film=$_GET[idFilm]";
      $stmt=$db->prepare($selectGambarFilm);
      $stmt->execute();
      $resGambar=$stmt->fetch(PDO :: FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
    <script src='jquery.js' type='text/javascript'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <a href="index.php"> <h3 style="text-align:center; float:left; margin-left: 47%;">BioskopID</h3> </a>
    <a href="Register.php" style="float:left; margin-left: 500px;"> <text class="text-secondary">Hello, User!</text> </a>
    <div style="clear: both;"></div>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="Index.php"><img src="logo.png" height="30"> <b>Bioskop.ID</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <a class="nav-link" href="Riwayat.php">Riwayat</a>
            </li>
            </ul>
            <a href="Register.php"> <text class="text-primary">Sign Up</text> </a>
            <a href="Ticketing.php"> <text class="text-secondary">Login</text> </a>
        </div>
    </nav>

    <!-- ISIAN PERTAMA-->
    <form method='post'>
    <div name="isianform" style="width: 400px; height: 600px; margin-left: 30px; float:left; margin-top: -21px;">
    <br><br>
      <div class="form-group col-md-6">
        <div class="card" style="width: 17rem;">
          <img class="card-img-top" src='poster/<?php echo $resGambar['poster'];?>' alt="Card image cap" style="width: 260px; height: 350px; margin-left: 6px;"> 
          <div class="card-body" id="bodycard">
            <?php
              echo"
              <h4>$_GET[judul]</h4>
              <input type='hidden' id='judul' value= $_GET[judul]>
              <input type='hidden' id='idFilm' value= $_GET[idFilm]>
              <input type='hidden' id='tgl' value= $_GET[tgl]>
              <input type='hidden' id='jam' value= $_GET[jam]>
              <input type='hidden' id='email' value= $_SESSION[email]>
              <input type='hidden' id='studio' value= $_GET[idStudio]>
              <input type='hidden' id='jadwal' value= $_GET[idJadwal]>
              <p> $_GET[nama] - Studio $_GET[idStudio]  <br>
                  Date: <b>$_GET[tgl]</b><br>
                  Time: <b>$_GET[jam]</b><br>
                  Snacks: <b>Without Snacks</b> <br>
                  <b>Rp. 50.0000/Seat</b>
              </p>
              
              <button type='button' name='btnconfirm' id='btnconfirm' class='btn btn-primary'>Confirm</button>
                ";
            ?>
              
          </div>
        </div>
      </div>
    <br><br>
    </div>
    
    <!--Simulasi Kursi Bioskop-->
    
    <div id='container' name="kursicontainer" style="width: 650px; height: 600px; margin-left: 30px; float:left;">
      <div name="layar" style="background-color: black; width: 300px; height: 40px; margin-left: 160px; color: white; text-align: center;">SCREEN</div>
      <?php
        $query = "SELECT * FROM seat where id_jadwal = $_GET[idJadwal]";
        // Query Bare! Jangan digunakan kalau TERIMA DATA DARI CLIENT!
        $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $key => $value) {
          //ini tolong dibuat rapih layout seatnya
          if ($value['status'] == 0) {
              echo "<button id='kursi' type='submit' name='kursi' style='text-align: center; color: white; font-size: 30px; padding-top: 3px; width: 60px; height: 60px; margin-left: 20px; margin-top: 10px; float:left; background-color:green;' value='$value[nama]'> $value[nama] </button>";
          }
          else {
            echo "<button id='kursi' type='submit' name='kursi' style='text-align: center; color: white; font-size: 30px; padding-top: 3px; width: 60px; height: 60px; margin-left: 20px; margin-top: 10px; float:left; background-color:red;' value='$value[nama]'> $value[nama] </button>";
          }
        }
      ?>
    </div>
    
    <div style="clear:both"></div>
    <br><br><br>
    </form>
    <script>
      $(document).ready(function(){
        var selectedSeat=[];
        var seat='';
        var ctr=0;

        // $('#container').children('#kursi').each(function () {
        //   $(this).css('background-color','green');
        // });
        
        $('#container').on('click','#kursi',function(e){
          e.preventDefault();
          if ($(this).css('background-color') == "rgb(0, 128, 0)") {
            $(this).css('background-color','red');
            selectedSeat[ctr]=$(this).attr('value');
            seat=$(this).attr('value')+','+seat;
            ctr++;
          }
          
        });
        $('#bodycard').on('click','#btnconfirm',function(e){
          e.preventDefault();
          harga=selectedSeat.length*50000;
          $.ajax({
              method : "post", // metode ajax
              url : "AjaxInsertTicket.php", // tujuan request
              data : {
                id_film : $("#idFilm").val(),
                tgl : $("#tgl").val(),
                jam : $("#jam").val(),
                seat : seat,
                harga : harga,
                Email : $('#email').val(),
                Studio : $('#studio').val(),
                jadwal : $('#jadwal').val()
              }, // data yang dikirim
              success : function(res){
                // window.location.replace("http://www.w3schools.com")
                if(res=='sukses'){
                  alert('Berhasil');
                  seat='';
                  location.replace("confirmbayar.php");
                }else{
                  alert('gagal');
                }
            }
          });
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