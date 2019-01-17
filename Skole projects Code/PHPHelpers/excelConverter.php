<?php

require 'phpspreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");

$sql = 'SELECT PC.ID as PCID, Models.Navn, PC.SerieNr, PC.Kommentar, RAM.Size, Processor.Navn as ProcessorNavn, Status.Status, HDD.Size as HDD FROM (((((PC
			INNER JOIN Models ON PC.Model = Models.ID)
			INNER JOIN RAM ON PC.RAM = RAM.ID)
			INNER JOIN Processor ON PC.Processor = Processor.ID)
			INNER JOIN HDD ON PC.HDD = HDD.ID)
			INNER JOIN Status ON PC.Status = Status.ID AND (PC.Status = 3 OR PC.Status = 4))';

$filename = "(" . date("d-m-Y h.i") . ")" . " Klargjorte PC'er.xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Model');
$sheet->setCellValue('C1', 'Serienummer');
$sheet->setCellValue('D1', 'RAM');
$sheet->setCellValue('E1', 'Processor');
$sheet->setCellValue('F1', 'HDD');
$sheet->setCellValue('G1', 'Kommentar fra rep.');
$sheet->setCellValue('H1', 'Status');

if ($result = $conString->prepare($sql))
{
	$count = 2;
	$result -> execute();

	foreach ($result as $row)
	{
		$sheet->setCellValue("A$count", $row["PCID"]);
		$sheet->setCellValue("B$count", $row["Navn"]);
		$sheet->setCellValue("C$count", $row["SerieNr"]);
		$sheet->setCellValue("D$count", $row["Size"]);
		$sheet->setCellValue("E$count", $row["ProcessorNavn"]);
		$sheet->setCellValue("F$count", $row["HDD"]);
		$sheet->setCellValue("G$count", $row["Kommentar"]);
		$sheet->setCellValue("H$count", $row["Status"]);
		$count++;
	}
}

$writer = new Xlsx($spreadsheet);

$writer->save($filename);


// Set the content-type:
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . filesize($filename));
header("Content-Disposition: attachment; filename= $filename ");
readfile($filename); // send file
unlink($filename); // delete file
exit;

?>