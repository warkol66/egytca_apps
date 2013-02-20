<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {includeReport} function plugin
 *
 */
function smarty_function_includeReport($params, &$smarty) {

	$id = $params["id"];
	require_once("ReportService.php");
	$report = new ReportService($id); //ID DE PROYECTO
	echo $report->getGraphMarkUp("avanceMetas","xml.php?id=" . $id ); //id del div a crear, URL DEL XML
	echo $report->tableAvanceMetas();
}
