<?php

class IndicatorsViewXmlAction extends BaseAction {

	function IndicatorsViewXmlAction() {
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

		$indicatorsPeer = new IndicatorPeer();

		if ( !empty($_GET["id"]) ) {
			if (!empty($_GET["entity"])) {
				$indicator = IndicatorPeer::getDisbursementIndicator($_GET["entity"], $_GET["id"]);
				$smarty->assign("disbursement",true);
			} 
			else {
				$indicator = IndicatorPeer::get($_GET["id"]);

		if (method_exists($indicator,'getIndicatorCategorys'))
				$categories = $indicator->getIndicatorCategorys();
		
				foreach ($categories as $category)
					if ($category->getId() == -1)
					$smarty->assign("disbursement",true);
			}
			$smarty->assign("indicator",$indicator);
		}
		$smarty->assign("disbursement",true);
		return $mapping->findForwardConfig('success');
	}
}
