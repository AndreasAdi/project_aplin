<?php include "DB/database.php";
    $query = "SELECT CONCAT(f.judul,' (',f.tahun,')') AS judul_film FROM film f";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
?>