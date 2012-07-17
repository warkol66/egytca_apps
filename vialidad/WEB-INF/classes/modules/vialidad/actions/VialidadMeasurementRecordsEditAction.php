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
				return $mapping->findForwardConfig('success');
			}
			else {
				$smarty->assign("action","edit");
			
				$record->updateItems();
				$record->updateExtrasRelations();
				$itemRecords = MeasurementRecordRelationQuery::create()
					->useConstructionItemQuery()
					->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
					->endUse()
					->findByMeasurementrecordid($_GET["id"]);
				$smarty->assign('itemRecords', $itemRecords);
				
				$fines = $record->getFines();
				$smarty->assign('fines', $fines);
				
				$dailyWorks = $record->getDailyWorks();
				$smarty->assign('dailyWorks', $dailyWorks);
				
				$adjustments = $record->getAdjustments();
				$smarty->assign('adjustments', $adjustments);
				
				$others = $record->getOthers();
				$smarty->assign('others', $others);

				$comments = MeasurementRecordCommentQuery::create()->filterByMeasurementrecordid($_GET['id'])
					->orderByCreatedAt(Criteria::DESC)->find();
				
				$smarty->assign('comments', $comments);
			}
		}
		else {
			$record = new MeasurementRecord();
			$smarty->assign("action","create");
		}
		
		$smarty->assign("record",$record);
		return $mapping->findForwardConfig('success');
	}
}