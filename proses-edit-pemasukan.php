<?php

session_start();

include('koneksi.php');

define('LOG','log.txt');

function write_log($log){  
    $time = date('[Y-d-m:H:i:s]');
    $op = $time.' '.$log."\n".PHP_EOL;
    $fp = fopen(LOG, 'a');
    $write = fwrite($fp, $op);
    fclose($fp);
}

$id = (int) $_GET['id_pemasukan'];
$tgl = date('Y-m-d', strtotime($_GET['tgl_pemasukan']));
$jumlah = abs((int) $_GET['jumlah']);
$sumber = abs((int) $_GET['id_sumber']);

// Query update
$query = mysqli_query($koneksi, "UPDATE pemasukan SET tgl_pemasukan='$tgl', jumlah='$jumlah', id_sumber='$sumber' WHERE id_pemasukan='$id'");

$namaadmin = $_SESSION['nama'];
if ($query) {
    write_log("Nama Admin: ".$namaadmin." => Edit Pemasukan => ".$id." => Sukses Edit");
    // Redirect to index page
    header("location: pendapatan.php");
} else {
    write_log("Nama Admin: ".$namaadmin." => Edit Pemasukan => ".$id." => Gagal Edit");
    echo "ERROR, data gagal diupdate: " . mysqli_error($koneksi);
}

// Close the database connection
mysqli_close($koneksi);
?>
