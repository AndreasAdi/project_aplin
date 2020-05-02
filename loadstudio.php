<?php include "DB/database.php";
    $query="SELECT s.nama_studio AS nama_studio,s.id_studio AS id_studio FROM studio s  where s.id_cabang = $_POST[id] ";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>