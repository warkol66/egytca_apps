<?php

class ConstructionsInspectionsEditAction extends BaseAction {

	function ConstructionsInspectionsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Constructions";
		$smarty->assign("module",$module);

		$id = $request->getParameter("id");

		if (!empty($id) ) {
			$inspection = InspectionQuery::create()->findOneById($id);
			$smarty->assign("inspection",$inspection);
		}
		else {
			//voy a crear un construction nuevo
			$inspection = new Inspection();
			$smarty->assign("inspection",$inspection);
		}

		$constructionId = $request->getParameter("constructionId");
		if (!empty($constructionId) ) {
			$construction = ConstructionQuery::create()->findOneById($constructionId);
			if (!empty($construction))
				$smarty->assign("construction", $construction);
			else
				$smarty->assign("constructions", ConstructionQuery::create()->find());
		}
		
		$smarty->assign("inspectors", InspectorQuery::create()->find());
		$smarty->assign("statuses", Inspection::getStatuses());
		$smarty->assign("workingRates", Inspection::getWorkingRates());

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);

		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');

	}
}
