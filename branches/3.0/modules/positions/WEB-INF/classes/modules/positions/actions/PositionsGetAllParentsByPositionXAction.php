<?php

class PositionsGetAllParentsByPositionXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PositionsGetAllParentsByPositionXAction() {
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

		$module = "Positions";
		$smarty->assign("module",$module);

		$type = $_POST['positionDataX']['type'];

		$version = $_POST['positionData']['version'];
		if (empty($version))
			$version = PositionPeer::getLatestVersion();

		$positions =  PositionPeer::getAllPossibleParentsByType($type, $version);
//		$positions =  PositionPeer::getAllParentsByPositionType($type, $version);
		$smarty->assign('type',$type);
		$smarty->assign('positions',$positions);

		return $mapping->findForwardConfig('success');
	}

}
