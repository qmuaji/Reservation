<?php

error_reporting(0);

require_once '../core/init.php';
require_once '../plugins/excel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$start  = date('Y-m-d', strtotime($_GET['s']));
$end  = date('Y-m-d', strtotime($_GET['e'])); 

$query="SELECT book_date, book_code, (price * sum(q)) as total
            FROM transactions               
            WHERE book_date BETWEEN '$start' AND '$end'
            GROUP BY book_code";

$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Daftar Pelanggan .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Pelanggan");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Tanggal')
       ->setCellValue('B1', 'Kope Pesan')
       ->setCellValue('C1', 'Total');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['book_date'])
       ->setCellValue("B$baris", $row['book_code'])
       ->setCellValue("C$baris", $row['total']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Laporan Transaksi Penyewaan');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Laporan Transaksi Penyewaan.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 