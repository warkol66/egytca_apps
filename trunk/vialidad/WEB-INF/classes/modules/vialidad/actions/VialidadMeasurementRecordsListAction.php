<?php

class VialidadMeasurementRecordsListAction extends BaseAction {

	function VialidadMeasurementRecordsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "MeasurementRecords";
		$smarty->assign("section",$section);

		$smarty->assign("message",$_GET["message"]);

		$filters = $_GET["filters"];
		$pager = MeasurementRecordQuery::create()->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$url = "Main.php?do=vialidadMeasrementRecordsList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("filters",$filters);
		$smarty->assign("records",$pager->getResults());
		$smarty->assign("pager",$pager);

		return $mapping->findForwardConfig("success");
	}
		
}
