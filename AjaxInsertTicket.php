<?php
include "DB/database.php";
session_start();
    $queryInsertPendingTicket="INSERT INTO PendingTicket(id_film,tanggal,jam,Seat,StatusBayar,Harga,Email,Studio) VALUES(:id_film,:tgl,:jam,:seat,:StatusBayar,:harga,:email,:studio)";
    $stmt = $db->prepare($queryInsertPendingTicket);
    $stmt->bindValue(':id_film',$_POST['id_film'],PDO::PARAM_INT);
    $stmt->bindValue(':tgl',$_POST['tgl'],PDO::PARAM_STR);
    $stmt->bindValue(':jam',$_POST['jam'],PDO::PARAM_STR);
    $stmt->bindValue(':seat',$_POST['seat'],PDO::PARAM_STR);
    $stmt->bindValue(':StatusBayar','Pending',PDO::PARAM_STR);
    $stmt->bindValue(':harga',$_POST['harga'],PDO::PARAM_INT);
    $stmt->bindValue(':email',$_POST['Email'],PDO::PARAM_STR);
    $stmt->bindValue(':studio',$_POST['Studio'],PDO::PARAM_INT);
    $result=$stmt->execute();
    if($result){
        echo "sukses";
    }
    else{
        echo "gagal";
    }
?>