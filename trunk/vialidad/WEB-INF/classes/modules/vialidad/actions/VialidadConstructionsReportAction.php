<?php

class VialidadConstructionsReportAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$constructions = ConstructionQuery::create()->find();
		$smarty->assign('constructions', $constructions);
		
		
		$this->template->template = 'TemplatePlain.tpl';
		return $mapping->findForwardConfig('success');
	}
}