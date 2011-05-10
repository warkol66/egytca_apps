<?php

class PanelResultFramesIndicatorsGetAllParentsByIndicatorXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsGetAllParentsByIndicatorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = 'TemplateAjax.tpl';

		$module = "Panel";
		$smarty->assign("module",$module);

		$type = $_POST['indicatorDataX']['type'];

		$indicators =  ResultFrameIndicatorPeer::getAllPossibleParentsByType($type);
		
		$objectType = ResultFrameIndicatorPeer::getObjectTypeByIndicatorType($type);
		$smarty->assign('objectType',$objectType);
		
		$smarty->assign('type',$type);
		$smarty->assign('indicators',$indicators);

		return $mapping->findForwardConfig('success');
	}

}
