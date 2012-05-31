<?php

class ConstructionsInspectorsEditAction extends BaseAction {

	function ConstructionsInspectorsEditAction() {
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
			$inspector = InspectorQuery::create()->findOneById($id);
			$smarty->assign("inspector",$inspector);
		}
		else {
			$inspector = new Inspector();
			$smarty->assign("inspector",$inspector);
		}

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);

		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');

	}
}
