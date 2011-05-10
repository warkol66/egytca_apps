<?php

class RegionsGetAllParentsByRegionXAction extends BaseAction {

	function RegionsGetAllParentsByRegionXAction() {
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

		$module = "Regions";
		$smarty->assign("module",$module);

		$type = $_POST['regionDataX']['type'];
		$regions =  RegionPeer::getAllParentsByRegionType($type);
		$smarty->assign('type',$type);
		$smarty->assign('regions',$regions);

		return $mapping->findForwardConfig('success');
	}

}
