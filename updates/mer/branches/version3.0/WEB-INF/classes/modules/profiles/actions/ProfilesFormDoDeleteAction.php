<?php

class ProfilesFormDoDeleteAction extends BaseAction {

	function ProfilesFormDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		if ($_POST["page"] > 0)
			$params["page"] = $_GET["page"];

		if (!empty($_GET["filters"]))
			$filters = $_GET["filters"];

		if (isset($_GET["id"])) {
			$form = FormQuery::create()->findPK($_GET["id"]);
			if (!empty($form)) {
				$form->delete();
				if ($form->isDeleted()) {
					if (mb_strlen($form->getName()) > 120)
						$cont = " ... ";

					$logSufix = "$cont, " . Common::getTranslation('action: delete','common');
					Common::doLog('success', substr($form->getName(), 0, 120) . $logSufix);

					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
				}
			}
		}
		return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'failure');
	}
}
