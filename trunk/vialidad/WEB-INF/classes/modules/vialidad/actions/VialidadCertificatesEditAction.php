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
				$certificate = new Certificate();
				$smarty->assign("action","create");
			}
			else {
				$certificate->getMeasurementRecord()->updateItems();
				
				$relations = MeasurementRecordRelationQuery::create()
					->filterByMeasurementrecordid($certificate->getMeasurementrecordid())->find();

				$smarty->assign("relations", $relations);
				$smarty->assign("action","edit");
			}
		}
		else {
			$certificate = new Certificate();
			$smarty->assign("action","create");
		}
		
		$otherCertificates = CertificateQuery::create()->find();
		$recordsQuery = MeasurementRecordQuery::create();
		
		foreach ($otherCertificates as $otherCertificate) {
			$recordsQuery->filterByCertificate($otherCertificate, Criteria::NOT_EQUAL);
		}
		
		$smarty->assign('eligibleRecords', $recordsQuery->find());
		$smarty->assign("certificate",$certificate);
		return $mapping->findForwardConfig('success');
	}
}