<?php
    if(!isset($_SESSION['email'])){
        header("Location: Ticketing.php");
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

    <title>Hello, world!</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
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
    <br>
    <div class="container">
    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Judul Film</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>INV0X121</td>
            <td>23-03-2020</td>
            <td>DILAN MILEA</td>
            <td>Rp. 50.000</td>
            <td>Verified</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>INV0X138</td>
            <td>27-03-2020</td>
            <td>TRANSFORMER</td>
            <td>Rp. 50.000</td>
            <td>Verified</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>INV0X147</td>
            <td>04-04-2020</td>
            <td>MULAN</td>
            <td>Rp. 50.000</td>
            <td>Waiting Approval</td>
        </tr>
    </tbody>
    </table>
</div>
  </body>
  

    <!--FOOTER-->
    <footer class="page-footer font-small fixed-bottom bg-dark text-light mt-5">
            <div class="footer-copyright text-center py-3">© 2020 Copyright
            </div>
        </footer>
</html>