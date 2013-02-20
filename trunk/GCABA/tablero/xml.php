<?php
header('Content-Type: text/html; charset=utf-8');
require_once("ReportService.php");
$report = new ReportService($_GET["id"]);
echo $report->xmlAvanceMetas();

