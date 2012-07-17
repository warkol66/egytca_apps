<?php

class VialidadCertificatesEditAction extends BaseAction {

	function VialidadCertificatesEditAction() {
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
		$section = "Certificates";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);

		if ($_GET['id']) {
			$certificate = CertificateQuery::create()->findPk($_GET["id"]);
			if (empty($certificate)) {
				$smarty->assign("notValidId","true");
				return $mapping->findForwardConfig('success');
			}
			else {
				$certificate->getMeasurementRecord()->updateItems();
				$certificate->getMeasurementRecord()->updateExtrasRelations();
				
				$relations = MeasurementRecordRelationQuery::create()
					->filterByMeasurementrecordid($certificate->getMeasurementrecordid())
					->useConstructionItemQuery()
					->filterByClassKey(ConstructionItemPeer::CLASSKEY_CONSTRUCTIONITEM)
					->endUse()
					->find();

				$smarty->assign("relations", $relations);
				$smarty->assign("action","edit");
				
				$smarty->assign('fines', $certificate->getMeasurementRecord()->getFines());
				$smarty->assign('dailyWorks', $certificate->getMeasurementRecord()->getDailyWorks());
				$smarty->assign('adjustments', $certificate->getMeasurementRecord()->getAdjustments());
				$smarty->assign('others', $certificate->getMeasurementRecord()->getOthers());

			}
		}
		else {
			$certificate = new Certificate();
			$smarty->assign("action","create");
		}
		
		$smarty->assign("certificate",$certificate);
		return $mapping->findForwardConfig('success');
	}
}