<?php

class ProfilesFormDoEditAction extends BaseAction {

	function ProfilesFormDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$module = "Profiles";
		$section = "Forms";

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$mediaParams = array_merge_recursive($_POST["params"],$userParams);

		if ($request->getParameter("id")) {
			$form = FormQuery::create()->findPK($_POST["id"]);
			if (!empty($form)) {
				if (isset($_POST["params"]["id"]))
					unset($_POST["params"]["id"]);

				$form = Common::setObjectFromParams($form,$_POST["params"]);
				if ($form->isModified() && !$form->save())
					return $mapping->findForwardConfig('failure');
				else {
					if (mb_strlen($form->getName()) > 120)
						$cont = " ... ";
					$logSufix = "$cont, " . Common::getTranslation('action: edit','common');
					Common::doLog('success', substr($form->getName(), 0, 120) . $logSufix);
					return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
				}
			}
		}
		else {
			$form = new Form();
			$form = Common::setObjectFromParams($form,$_POST["params"]);
			$section = new FormSection();
			$section->setTitle($_POST["sectionTitle"]);
			$section->save();
			$form->setRootSectionid($section->getId());
			if ($form->save()) {
				if (mb_strlen($form->getName()) > 120)
					$cont = " ... ";
				$logSufix = "$cont, " . Common::getTranslation('action: create','common');
				Common::doLog('success', substr($form->getName(), 0, 120) . $logSufix);
				return $this->addParamsAndFiltersToForwards($params,$filters,$mapping,'success');
			}
			else
				return $mapping->findForwardConfig('failure-create');
		}
	}
}
