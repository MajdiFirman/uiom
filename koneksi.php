<?php

$host = "localhost";
$username = "root";
$pw = "";
$db = "db_majdi_firman_ukk_rpl_2024";

$koneksi = mysqli_connect($host, $username,$pw, $db);

if(!$koneksi){
    die("koneksi gagal". mysqli_connect_error());
}
// echo "jaya jaya jaya"
?>  