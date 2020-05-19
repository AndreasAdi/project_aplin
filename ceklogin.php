<?php
session_start();
if (isset($_SESSION["email"])){
    echo("sudah");
}
else{
    echo("belum");
}

?>