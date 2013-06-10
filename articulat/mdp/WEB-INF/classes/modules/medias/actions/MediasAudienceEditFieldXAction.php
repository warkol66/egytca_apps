<?php

class MediasAudienceEditFieldXAction extends BaseAction {

	function MediasAudienceEditFieldXAction() {
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

		$mediaAudience = MediaAudiencePeer::retrieveByPK($_POST['id']);

		if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
			$mediaAudience->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
			$mediaAudience->save();
		}

		if (!empty($_POST['paramName']))
			$smarty->assign("paramValue", $mediaAudience->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));

		return $mapping->findForwardConfig('success');
	}

}
