<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "burs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlantı hatası: " . $conn->connect_error);
}

// Excel dosyasının yolu
$excelDosya = "veriler.xlsx"; // Excel dosyanızın adını ve yolunu değiştirin

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
 $sql = "INSERT INTO kayitlar (bos, kayit_ad, kayit_soyad, kayit_baba, kayit_durum, kayit_aciklama) VALUES ('" . $veri[0] . "', '" . $veri[1] . "', '" . $veri[2] . "', '" . $veri[3] . "' , '" . $veri[4] . "' , '" . $veri[5] . "')";

    if ($conn->query($sql) === TRUE) {
        echo "Veri başarıyla eklenmiştir.<br>";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
