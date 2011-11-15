<?php

class VialidadCertificatesDoEditAction extends BaseAction {

	function VialidadCertificatesDoEditAction() {
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
		
		if (empty($_POST['params']['measurementRecordId']))
			throw new Exception('invalid arguments');

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$certificateParams = array_merge_recursive($_POST["params"],$userParams);

		$smarty->assign("filters",$filters);

		if ($_POST["action"] == "edit" && !empty($_POST["id"])) {
			$params["id"] = $_POST["id"];
			$certificate = CertificateQuery::create()->findPk($_POST["id"]);
			if (!empty($certificate)) {
				$certificate = Common::setObjectFromParams($certificate,$_POST["params"]);

				if ($certificate->isModified() && $certificate->validate() && !$certificate->save()) 
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	
				$smarty->assign("message","ok");
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
			}
		}
		else {
			$certificate = new Certificate();
			$certificate = Common::setObjectFromParams($certificate,$certificateParams);

			if (!$certificate->save())
				return $this->returnFailure($mapping,$smarty,$certificate);

			if (mb_strlen($_POST["params"]["name"]) > 120)
				$cont = " ... ";

			$logSufix = "$cont, " . Common::getTranslation('action: create','common');
			Common::doLog('success', substr($_POST["params"]["name"], 0, 120) . $logSufix);

			$params['id'] = $certificate->getId();
			return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success-edit');
		}

	}

}
