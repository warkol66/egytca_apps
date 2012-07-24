<?php

class MediasMarketEditFieldXAction extends BaseAction {

	function MediasMarketEditFieldXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Medias";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$mediaMarket = MediaMarketPeer::retrieveByPK($_POST['id']);

		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$mediaMarket->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$mediaMarket->save();
		}

		if (!empty($_POST['paramName']))
			$smarty->assign("paramValue", $mediaMarket->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));

		return $mapping->findForwardConfig('success');
	}

}
