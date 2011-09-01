<?php

class MediasTypeEditFieldXAction extends BaseAction {

	function MediasTypeEditFieldXAction() {
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

		$module = "Medias";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

        $mediaType = MediaTypePeer::retrieveByPK($_POST['id']);
        
        if (!empty($_POST['paramName']) && !empty($_POST['paramValue'])) {
            $mediaType->setByName($_POST['paramName'], $_POST['paramValue'], BasePeer::TYPE_FIELDNAME);
            $mediaType->save();
        }
        
        if (!empty($_POST['paramName'])) {
            $smarty->assign("paramValue", $mediaType->getByName($_POST['paramName'], BasePeer::TYPE_FIELDNAME));
        }
        
		return $mapping->findForwardConfig('success');
	}

}
