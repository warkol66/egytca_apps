<?php

class PanelResultFramesIndicatorsGetPosibleObjectsByIndicatorXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsGetPosibleObjectsByIndicatorXAction() {
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

		$type = $_POST['indicatorData']['type'];
		$parentId = $_POST['indicatorData']['parentId'];

		$objects = ResultFrameIndicatorPeer::getAllPossibleObjectsByTypeAndParentId($type, $parentId);
		$smarty->assign('objects',$objects);

		return $mapping->findForwardConfig('success');
	}

}
