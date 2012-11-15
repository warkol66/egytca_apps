<?php

class PlanningIndicatorsViewXmlAction extends BaseAction {

	function PlanningIndicatorsViewXmlAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Indicators";
		$smarty->assign("module",$module);

		$this->template->template = 'TemplateAjax.tpl';
		header ("content-type: text/xml; charset=utf-8");

		//Encabezado BOM para que el flash chart identifique el UTF-8
		echo pack ( "C3" , 0xef, 0xbb, 0xbf );

		if ( !empty($_GET["id"]) ) {
			$indicator=PlanningIndicatorQuery::create()->findPk($_GET["id"]);
			$smarty->assign("indicator",$indicator);
		}
		return $mapping->findForwardConfig('success');
	}
}


