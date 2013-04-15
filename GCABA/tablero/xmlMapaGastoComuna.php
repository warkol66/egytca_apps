<?php
header ("Content-Type:text/xml; charset=utf-8");
require_once("ReportService.php");
$report = new ReportService();
echo $report->xmlMapaGastoComuna($_GET['year']);
