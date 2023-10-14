<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exceltosql";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection error to database: " . $conn->connect_error);
}

// Excel dosyasının yolu
$excelDosya = $_POST['file']; // Excel dosyanızın adını ve yolunu değiştirin

// PhpSpreadsheet'i yükle
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$objPHPExcel = IOFactory::load($excelDosya);

// İlk sayfayı seç
$sheet = $objPHPExcel->getActiveSheet();

// Verileri oku ve SQL veritabanına ekleyin
foreach ($sheet->getRowIterator() as $row) {
    $veri = array();
    foreach ($row->getCellIterator() as $cell) {
        $veri[] = $cell->getValue();
    }

    // SQL sorgusu
    $sql = "INSERT INTO students (name, surname, school_id) VALUES ('" . $veri[0] . "', '" . $veri[1] . "', '" . $veri[2] . "')";

    if ($conn->query($sql) === TRUE) {
        header('location:index.php?process=success');
    } else {
        header('location:index.php?process=error');
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
