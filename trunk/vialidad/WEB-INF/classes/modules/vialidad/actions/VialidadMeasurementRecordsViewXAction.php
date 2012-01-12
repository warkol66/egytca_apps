<?php

class VialidadMeasurementRecordsViewXAction extends BaseAction {

	function VialidadMeasurementRecordsViewXAction() {
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

		if ($_GET['id']) {
			$record = MeasurementRecordQuery::create()->findPk($_GET["id"]);
			if (empty($record)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else {
			
				$record->updateItems();
				$itemRecords = MeasurementRecordRelationQuery::create()->findByMeasurementrecordid($_GET["id"]);
				$smarty->assign('itemRecords', $itemRecords);
				
				$comments = MeasurementRecordCommentQuery::create()->filterByMeasurementrecordid($_GET['id'])
					->orderByCreatedAt(Criteria::DESC)->find();
				
				$smarty->assign('comments', $comments);
			}
		}
		
		$smarty->assign("record",$record);
		return $mapping->findForwardConfig('success');
	}
}