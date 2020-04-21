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
  
    <a href="index.php"> <h3 style="text-align:center; float:left; margin-left: 47%;">BioskopID</h3> </a>
    <a href="Register.php" style="float:left; margin-left: 500px;"> <text class="text-secondary">Hello, Petugas!</text> </a>

    <div style="clear: both;"></div>
    <!--NAVBAR-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="Index.php">BIOSKOPID</a>
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
    <table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No.</th>
            <th scope="col">Invoice No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Judul Film</th>
            <th scope="col">Total</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>INV0X121</td>
            <td>23-03-2020</td>
            <td>DILAN MILEA</td>
            <td>Rp. 50.000</td>
            <td><button class="btn btn-primary">Show Detail</button></td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>INV0X138</td>
            <td>27-03-2020</td>
            <td>TRANSFORMER</td>
            <td>Rp. 50.000</td>
            <td><button class="btn btn-primary">Show Detail</button></td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>INV0X147</td>
            <td>04-04-2020</td>
            <td>MULAN</td>
            <td>Rp. 50.000</td>
            <td><button class="btn btn-primary">Show Detail</button></td>
        </tr>
    </tbody>
    </table>



    <!--FOOTER-->
    <ul class="nav justify-content-center bg-dark" style="position: fixed; left: 0; bottom: 0; width:100%;">
    <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Copyright 2020</a>
    </li>
    </ul>
  </body>
</html>