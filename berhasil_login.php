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
    <a href="Register.php" style="float:left; margin-left: 500px;"> <text class="text-secondary">Hello, User!</text> </a>
  
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
    <div id="isianform" style="width: 400px; height: 600px; margin-left: 30px; float:left;">
      
    <br><br>
    <div class="form-group col-md-6">
      <label style="font-size: 20px;">Transformer </label>
      <label >Tunjungan - Studio 1</label>
      <label >Rabu, 15 April 2020</label>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Waktu Tayang</label>
      <select id="inputState" class="form-control">
        <option selected>15.30 - 17.45</option>
        <option>...</option>
      </select>
    </div>
    <div class="col-auto my-1">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Jumlah Tiket</label>
      <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
        <option selected>1 Seat</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>

      <label >1 x Rp 50.000 = Rp 50.000</label>
    </div>

    <div class="form-group col-md-6">
      <label for="inputState">Pembayaran</label>
      <select id="inputState" class="form-control">
        <option selected>Transfer BCA</option>
        <option>...</option>
      </select>

      <br>
      <a href="konfirmasi_bayar.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Accept</a>
    </div>
    
    
    </div>

    <!--Simulasi Kursi Bioskop-->
    <div id="kursi" style="width: 650px; height: 600px; margin-left: 30px; float:left;">
      <div id="layar" style="background-color: black; width: 300px; height: 40px; margin-left: 160px; color: white; text-align: center;">SCREEN</div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: red; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1A </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1B </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 1C </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1D </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1E </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1F </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 1G </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 1H </div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 2C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2D </div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 2G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 2H</div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 3C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 3G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 3H</div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 4C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 4G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 4H</div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 5C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 5G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 5H</div>


      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 6C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 6G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 6H</div>
      


      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 7C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 7G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 7H</div>

      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8A</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8B</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 8C</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8D</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8E</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8F</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 40px; margin-top: 10px; float:left;"> 8G</div>
      <div id="kursi" style="text-align: center; color: white; font-size: 30px; padding-top: 3px; background-color: green; width: 60px; height: 60px; margin-left: 10px; margin-top: 10px; float:left;"> 8H</div>
      
    </div>

    <!--PRE ORDERS MEAL-->
    <div id="IsianKanan">

    <div class="form-check" style="border: 3px solid navy; width: 330px; height: 600px; margin-left: 75%; margin-top: 3px;">
      <h3>Book Your Pre-Order Meals Here!</h3>

      <br>
      <h5>Popcorn</h5>
      
      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Popcorn Jumbo </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 40.000 <br> 

      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Popcorn Medium </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 30.000 <br> 

      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Popcorn Small </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 20.000 <br> 

      <br>
      <h5>Beverages</h5>
      
      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Coca-cola </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 25.000 <br> 

      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Sprite </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 25.000 <br>

      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" style="margin-left: 10px; margin-top: 10px;">
      <label class="form-check-label" for="defaultCheck1" style="margin-left: 30px;"> Mineral Water </label> 
      <input style="width: 40px; height: 20px;" type="number" value="0" min="0" max="10" step="1"/> x Rp 20.000 <br>

      <br><br>
      <div id="summary" style="width: 270px; height: 210px;"> 

          <div id="Summary" style="float: left;">Summary : </div>

          <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" style="float: left; width: 100px; height: 45px; font-size: 16px; float: left; margin-left: 90px;">Confirm</a>
          

          <div id="total"> Rp. 0</div>
      </div>

    </div>

    </div>
    <!--FOOTER-->
    <ul class="nav justify-content-center bg-dark" style="position: fixed; left: 0; bottom: 0; width:100%;">
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Copyright 2020</a>
      </li>
    </ul>
  </body>
</html>