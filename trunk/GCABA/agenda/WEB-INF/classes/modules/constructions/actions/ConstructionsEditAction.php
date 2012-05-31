<?php

class ConstructionsEditAction extends BaseAction {

	function ConstructionsEditAction() {
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
			$construction = ConstructionQuery::create()->findOneById($id);
			$smarty->assign("construction",$construction);
		}
		else {
			//voy a crear un construction nuevo
			$construction = new Construction();
			$smarty->assign("construction",$construction);
		}

		$smarty->assign("regions", RegionQuery::create()->find());
		$smarty->assign("categories", CategoryQuery::create()->find());

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);

		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');

	}
}
