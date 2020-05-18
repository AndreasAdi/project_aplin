<?php include "DB/database.php";
   $query = "SELECT DISTINCT c.nama_cabang AS nama_cabang, c.id_cabang AS id_cabang FROM cabang c, jadwal j WHERE c.id_cabang = j.id_cabang AND j.id_film = $_POST[id_film] AND c.kota_cabang = '$_POST[kota_cabang]'";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>