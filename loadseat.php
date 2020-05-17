<?php include "DB/database.php";
    
    $query="SELECT j.id_film AS id_film, j.id_jadwal AS id_jadwal, t.harga_ticket AS harga_ticket, s.id_seat AS id_seat,s.nama AS nama, s.status as status FROM seat s, jadwal j ,ticket t where s.id_jadwal = j.id_jadwal AND j.jam = '$_POST[jam]' AND j.tanggal = '$_POST[tanggal]' AND j.id_studio = $_POST[id_studio] AND t.id_jadwal = j.id_jadwal";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>