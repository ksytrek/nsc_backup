<?php

require '../../../script/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Maarten Balliauw')
    ->setLastModifiedBy('Maarten Balliauw')
    ->setTitle('Office 2007 XLSX Test Document')
    ->setSubject('Office 2007 XLSX Test Document')
    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Test result file');

// $spreadsheet->setActiveSheetIndex(0)
//     ->setCellValue('A1', 'Customer Code')
//     ->setCellValue('B1', 'Customer Name')
//     ->setCellValue('C1', 'Customer Address');

//Connect To Database MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

$sql = "SELECT * FROM customer";
$result1 = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result1);
$i = 2;
$j = 2;

if ($rows > 0) {
    
    while ($r = mysqli_fetch_assoc($result1)) {
        $rows = mysqli_num_rows($result1);

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue("A$i", 'customer_code')
            ->setCellValue("B$i", 'customer_name')
            ->setCellValue("C$i", 'customer_address');


        mysqli_set_charset($conn, "utf8");
        $sql1 = "SELECT * FROM customer";
        $result11 = mysqli_query($conn, $sql1);
        $rows1 = mysqli_num_rows($result11);
        $i++;
        if ($rows1 > 0) {
            $i++;
            while ($r2 = mysqli_fetch_assoc($result11)) {
                $rows = mysqli_num_rows($result11);
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue("A$i", $r2['customer_code'])
                    ->setCellValue("B$i", $r2['customer_name'])
                    ->setCellValue("C$i", $r2['customer_address']);
                $i++;
            }
            $i++;
        }
        
        $i++;
    }
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
