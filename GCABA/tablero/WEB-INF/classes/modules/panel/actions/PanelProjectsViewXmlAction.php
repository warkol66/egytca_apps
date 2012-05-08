<?php

class PanelProjectsViewXmlAction extends BaseAction {

	function PanelProjectsViewXmlAction() {
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

		$this->template->template = 'TemplatePlain.tpl';
		header ("content-type: text/xml; charset=utf-8");

		//Encabezado BOM para que el flash chart identifique el UTF-8
		echo pack ( "C3" , 0xef, 0xbb, 0xbf );

		$policyGuidelines = PolicyGuidelinePeer::getAll();
		$smarty->assign("policyGuidelines",$policyGuidelines);

		$indicatorPeer = new IndicatorPeer();
		$smarty->assign("indicatorPeer",$indicatorPeer);

		return $mapping->findForwardConfig('success');
	}
}
