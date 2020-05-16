<?php include "DB/database.php";
    $query="SELECT DATE_FORMAT(j.tanggal, '%W %M %e %Y') AS tanggal,j.tanggal AS tanggal_value,j.jam AS jam,s.nama_studio AS nama_studio,s.id_studio AS id_studio FROM studio s ,jadwal j where s.id_cabang = $_POST[id_cabang] AND j.id_film = $_POST[id_film] AND j.id_studio = s.id_studio AND s.id_cabang = j.id_cabang";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>