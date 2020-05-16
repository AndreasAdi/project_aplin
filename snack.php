<?php
    include "DB/database.php";
    session_start();

    if(isset($_POST['addsnack'])){
        header('Location: addsnack.php');
    }
    $query = "SELECT * FROM snack";
    // Query Bare! Jangan digunakan kalau TERIMA DATA DARI CLIENT!
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST['btnupdate'])){
        $id = $_POST['btnupdate'];
        header("Location: editsnack.php?snack=$id");
    }
    if(isset($_POST['btndelete'])){
        $id = $_POST['btndelete'];
        $querydelete="DELETE FROM snack where id_snack =$id";
        $db->exec($querydelete);
        header('Location: snack.php');
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
    <title>Hello, world!</title>
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
                <button class="btn btn-primary" type="submit" name="addsnack">Add</button>

                <div class="container mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                 foreach ($result as $key => $value) {
                            ?>
                           
                            <tr>
                                <td><?php echo $value["id_snack"];?></td>
                                <td><?php echo "<img src ='gambar_snack/$value[gambar_snack]' height = '50px'>" ?></td>
                                <td><?php echo $value["nama_snack"];?></td>
                                <td><?php echo number_format($value["harga_snack"], 0, ',', '.');?></td>
                                <td><?php echo"<button class='btn btn-warning' type ='submit' value ='$value[id_snack]' name ='btnupdate'><i class='fas fa-edit'></i></button>"?></td>
                                <td><?php echo"<button class='btn btn-danger' type ='submit' value ='$value[id_snack]' name='btndelete'><i class='fas fa-trash'></i></button>"?></td>
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