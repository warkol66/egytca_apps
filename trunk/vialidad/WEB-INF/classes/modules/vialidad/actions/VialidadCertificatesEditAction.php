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
				$relations = MeasurementRecordRelationQuery::create()
					->filterByMeasurementrecordid($certificate->getMeasurementrecordid())->find();
				
				//TODO confirmar
				$certificate->setTotalprice($certificate->totalPrice());
				////////////////

				$smarty->assign("relations", $relations);
				$smarty->assign("action","edit");
			}
		}
		else {
			$certificate = new Certificate();
			$smarty->assign("action","create");
		}
		
		$records = MeasurementRecordQuery::create()->find();
		
		$smarty->assign('allRecords', $records);
		$smarty->assign("certificate",$certificate);
		return $mapping->findForwardConfig('success');
	}
}