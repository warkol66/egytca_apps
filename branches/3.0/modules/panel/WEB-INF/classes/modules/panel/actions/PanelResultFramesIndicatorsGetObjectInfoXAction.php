<?php

class PanelResultFramesIndicatorsGetObjectInfoXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsGetObjectInfoXAction() {
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
		
		$objectType = $_POST['indicatorData']['objectType'];
		$objectId = $_POST['indicatorData']['objectId'];
		
		$objectPeerName = $objectType . 'Peer';
		if (class_exists($objectPeerName)) {
			if (method_exists($objectPeerName, 'get')) {
				$object = call_user_func(array($objectPeerName, 'get'), $objectId);
			}
		}
		if (!empty($object)) {
			$smarty->assign(Common::strtocamel($objectType, false), $object);    //Permite renderizar el formulario
			$this->prepareEmbeddedForm($objectType, $smarty);                    //de la entidad para el lightBox.
		}
		$smarty->assign('objectId',$objectId);

		return $mapping->findForwardConfig('success');
	}
}

