<?php
    session_start();
    include_once 'DB/database.php';
    if(!isset($_SESSION['email'])){
        header('Location: Ticketing.php');
    }
    $querySelectSnack="SELECT * FROM snack";
    $stmt=$db->prepare($querySelectSnack);
    $stmt->execute();
    $dataSnack=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if(isset($_POST['Add'])){
        if(isset($_SESSION['snackcart'])){
            $tempcart=$_SESSION['snackcart'];
            $idsnack=$_POST['Add'];
            $jumlah=$_POST['jumlah'];

            $dataSnackBaru=array(
                "id_snack"=>$idsnack,
                "jumlah"=>$jumlah
            );

            $tempcart[$idsnack]=$dataSnackBaru;
            $_SESSION['snackcart']=$tempcart;
        }else{
            $idsnack=$_POST['Add'];
            $jumlah=$_POST['jumlah'];
            $dataSnackBaru=array(
                "id_snack"=>$idsnack,
                "jumlah"=>$jumlah
            );
            $tempcart[$idsnack]=$dataSnackBaru;
            $_SESSION['snackcart']=$tempcart;
        }
    }
    if(isset($_POST['checkout'])){
        //Query untuk id_header
        $querySelectCountSnack="SELECT * FROM header_ordersnack";
        $stmt=$db->prepare($querySelectCountSnack);
        $stmt->execute();
        $dataCountSnack=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $orderNumber=count($dataCountSnack)+1;

        $queryInsertHeaderOrder="INSERT INTO header_ordersnack(id_header,email,status_order)VALUES(:id_header,:email,:status_order)";
        $stmt=$db->prepare($queryInsertHeaderOrder);
        $stmt->bindValue(':id_header',$orderNumber,PDO::PARAM_STR);
        $stmt->bindValue(':email',$_SESSION['email'],PDO::PARAM_STR);
        $stmt->bindValue(':status_order','Pending',PDO::PARAM_STR);
        $stmt->execute();
        foreach ($_SESSION['snackcart'] as $key => $value) {
            //query untuk select data snack
            $querySelectDataSnack="SELECT * FROM snack WHERE id_snack=$value[id_snack]";
            $stmt=$db->prepare($querySelectDataSnack);
            $stmt->execute();
            $dataDetailSnack=$stmt->fetch(PDO::FETCH_ASSOC);
            $totalharga=$value['jumlah']*$dataDetailSnack['harga_snack'];
            //query insert ke ordersnack
            $queryInsertOrderSnack="INSERT INTO ordersnack(id_header,id_snack,nama_snack,harga_snack,jumlah_snack,totalharga)
            VALUES(:id_header,:id_snack,:nama_snack,:harga_snack,:jumlah_snack,:totalharga)";
            $stmt=$db->prepare($queryInsertOrderSnack);
            $stmt->bindValue(':id_header',$orderNumber,PDO::PARAM_STR);
            $stmt->bindValue(':id_snack',$value['id_snack'],PDO::PARAM_STR);
            $stmt->bindValue(':nama_snack',$dataDetailSnack['nama_snack'],PDO::PARAM_STR);
            $stmt->bindValue(':harga_snack',$dataDetailSnack['harga_snack'],PDO::PARAM_STR);
            $stmt->bindValue(':jumlah_snack',$value['jumlah'],PDO::PARAM_STR);
            $stmt->bindValue(':totalharga',$totalharga,PDO::PARAM_INT);
            $stmt->execute();
        }

        echo"<div class='alert alert-success' role='alert'>Berhasil Order Snack ! </div>";
        unset($_SESSION['snackcart']);
    }
?>
<!doctype html>
<html lang='en'>
  <head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
    
    
    <!--NAVBAR-->
    <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
        <a class='navbar-brand' href='Index.php'><img src='logo.png' height='30'> <b>Bioskop.ID</b></a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
            <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='List_Film.php'>List Film</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='Meals.php'>Pre-Order Snack</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='Riwayat.php'>Riwayat</a>
            </li>
            </ul>
            <a href='Register.php'> <text class='text-primary'>Sign Up</text> </a>
            <a href='Ticketing.php'> <text class='text-secondary'>Login</text> </a>
        </div>
    </nav>

    <!-- ISIAN PERTAMA-->

    <!--SNACK--> <br><br>
    <h3 style='text-align: center;'>Favourite Snack Of The Month</h3>
    <br>
    <div id='comingsoon' style="column-count: 4;">
    <?php
        foreach ($dataSnack as $key => $value) {
            echo "
                    <div style='break-inside:avoid;'>
                        <form method='post'>
                            <div class='card' style='width: 18rem;' >
                            <div class='card-body'>
                                <h5 class='card-title'>$value[nama_snack]</h5>
                                <p class='card-text'>Rp. $value[harga_snack]</p>
                                <input type='text' class='form-control' name='jumlah'>
                                <button class='btn btn-success' type='submit' value='$value[id_snack]' name='Add'>Add To Cart</button>
                            </div>
                            </div>
                        </form>
                    </div>
            ";
        }
    ?>
    </div>
    <form method='post'>
        <button class='btn btn-primary' name='checkout' type='submit'>Check Out</button>
    </form>

  </body>
  
   
        <!-- Footer -->
        <footer class='page-footer font-small fixed-bottom bg-dark text-light mt-5'>
            <div class='footer-copyright text-center py-3'>© 2020 Copyright
            </div>
        </footer>

</html>