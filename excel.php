<?php
include_once 'classes/PHPExcel.php';
include 'variables.php';

session_start();

$objPHPExcel = new PHPExcel();

$active_sheet = $objPHPExcel->setActiveSheetIndex(0);
$active_sheet = $objPHPExcel->getActiveSheet();

$style_title = array('font' => array('size' => 10,'bold' => true,'color' => array('rgb' => '000000')));
$style_background = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '5F9EA0')));
$style_empty_line = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'D3D3D3')));
$style_ok = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '2E8B57')));
$style_error = array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'CD5C5C')));

$count_lines = 19;
for($i = 2; $i <= $count_lines; $i+=3) {
   $active_sheet->mergeCells('A'.($i).':F'.($i));
   $active_sheet->getStyle('A'.($i).':F'.($i))->applyFromArray($style_empty_line);
}

for($i = 3; $i <= $count_lines; $i+=3) {
   $active_sheet->mergeCells('A'.($i).':A'.($i+1));
   $active_sheet->mergeCells('B'.($i).':B'.($i+1));
   $active_sheet->mergeCells('C'.($i).':C'.($i+1));
}

$active_sheet->getColumnDimension('A')->setWidth(5);
$active_sheet->getColumnDimension('B')->setWidth(50);
$active_sheet->getColumnDimension('C')->setWidth(10);
$active_sheet->getColumnDimension('D')->setWidth(50);
$active_sheet->getColumnDimension('E')->setWidth(80);

$active_sheet->setCellValue('A1','№');
$active_sheet->setCellValue('B1','Название проверки');
$active_sheet->setCellValue('C1','Статус');
$active_sheet->setCellValue('D1','');
$active_sheet->setCellValue('E1','Текущее состояние');
$active_sheet->setCellValue('F1','');

$start_line = 3;
$line = 0;
for($i = 0; $i < count($_SESSION['number']); $i++){
    $start_line +=$line;
    $active_sheet->setCellValue('A'.$start_line,$_SESSION['number'][$i]);
    $line = 3;
}

$start_line = 3;
$line = 0;
for($i = 0; $i < count($_SESSION['name']); $i++){
    $start_line +=$line;
    $active_sheet->setCellValue('B'.$start_line,$_SESSION['name'][$i]);
    $line = 3;
}

$start_line = 3;
$line = 0;
for($i = 0; $i < count($_SESSION['status']); $i++){
    $start_line +=$line;
    $active_sheet->setCellValue('C'.$start_line,$_SESSION['status'][$i]);
    $line = 3;
    if($_SESSION['status'][$i] == $ok){
        if($i == 0){
            $cell = 3;
        }
        $cell = $start_line;
        $active_sheet->getStyle('C'.($cell).':C'.($cell+1))->applyFromArray($style_ok);
    }
    if($_SESSION['status'][$i] == $error){
        if($i == 0){
            $cell = 3;
        }
        $cell = $start_line;
        $active_sheet->getStyle('C'.($cell).':C'.($cell+1))->applyFromArray($style_error);
    }
}

for($i = 3; $i < 20; $i+=3) {
    $active_sheet->setCellValue('D'.$i,'Состояние');
}

for($i = 4; $i < 22; $i+=3) {
    $active_sheet->setCellValue('D'.$i,'Рекомендации');
}

$start_line = 3;
$line = 0;
for($i = 0; $i < count($_SESSION['state']); $i++){
    $start_line +=$line;
    $active_sheet->setCellValue('E'.$start_line,$_SESSION['state'][$i]);
    $line = 3;
}

$start_line = 4;
$line = 0;
for($i = 0; $i < count($_SESSION['recommendations']); $i++){
    $start_line +=$line;
    $active_sheet->setCellValue('E'.$start_line,$_SESSION['recommendations'][$i]);
    $line = 3;
}

$active_sheet->getStyle('A1:E1')->applyFromArray($style_title);
$active_sheet->getStyle('A1:E1')->applyFromArray($style_background);

header("Content-Type:application/vnd.ms-excel");
header('Content-Disposition:attachment;filename="result.xls"');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
$objWriter->save('php://output');
exit();
