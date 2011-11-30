<?php

class VialidadMeasurementRecordsEditAction extends BaseAction {

	function VialidadMeasurementRecordsEditAction() {
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

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if ($_GET['id']) {
			$record = MeasurementRecordQuery::create()->findPk($_GET["id"]);
			if (empty($record)) {
				$smarty->assign("notValidId","true");
				$record = new MeasurementRecord();
				$smarty->assign("action","create");
			}
			else {
				$smarty->assign("action","edit");
			
				$record->updateItems();
				$itemRecords = MeasurementRecordRelationQuery::create()->findByMeasurementrecordid($_GET["id"]);
				$smarty->assign('itemRecords', $itemRecords);
				
				$comments = MeasurementRecordCommentQuery::create()->filterByMeasurementrecordid($_GET['id'])
					->orderByCreatedAt(Criteria::DESC)->find();
				
				$smarty->assign('comments', $comments);
			}
		}
		else {
			$record = new MeasurementRecord();
			$smarty->assign("action","create");
		}
		
		$constructions = ConstructionQuery::create()->find();
		
		$smarty->assign('allConstructions', $constructions);
		$smarty->assign("record",$record);
		return $mapping->findForwardConfig('success');
	}
}