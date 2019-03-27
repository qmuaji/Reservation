<?php

error_reporting(0);

require_once '../core/init.php';
require_once '../plugins/excel/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


$query="SELECT name, price, description from studios ";
$hasil = mysql_query($query);
 
// Set properties
$objPHPExcel->getProperties()->setCreator("Risky Muaji")
      ->setLastModifiedBy("Risky Muaji")
      ->setTitle("Office 2007 XLSX Test Document")
      ->setSubject("Office 2007 XLSX Test Document")
       ->setDescription("Laporan Daftar Produk .")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Data Studios");
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue('A1', 'Nama Studio')
       ->setCellValue('B1', 'Harga/jam')
       ->setCellValue('C1', 'Deskripsi');
 
$baris = 2;
$no = 0;			
while($row=mysql_fetch_array($hasil)){
  $no = $no +1;
  $objPHPExcel->setActiveSheetIndex(0)
       ->setCellValue("A$baris", $row['name'])
       ->setCellValue("B$baris", $row['price'])
       ->setCellValue("C$baris", $row['description']);
  $baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Produk');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="DaftarStudios.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
 