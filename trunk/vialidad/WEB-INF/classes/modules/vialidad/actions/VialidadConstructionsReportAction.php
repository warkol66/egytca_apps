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
		
		$time = time();
		$smarty->assign('date', $time);
		require_once 'Period.php';
		$period = new Period(date('Y-m-d', $time), 'Y-m-d');
		$smarty->assign('period', $period);
		
		$this->template->template = 'TemplatePlain.tpl';
		return $mapping->findForwardConfig('success');
	}
}