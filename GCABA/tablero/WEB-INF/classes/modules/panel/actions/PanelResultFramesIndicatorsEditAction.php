<?php

class PanelResultFramesIndicatorsEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function PanelResultFramesIndicatorsEditAction() {
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

		$module = "Panel";
		$smarty->assign("module",$module);
		
		//obtengo las categorias que el usuario puede acceder	
		$loginUser = Common::getAdminLogged();
		$smarty->assign('loginUser',$loginUser);

		$resultFrameIndicatorPeer = new ResultFrameIndicatorPeer();
		$indicatorTypes = $resultFrameIndicatorPeer->getTypesTranslated();
		$smarty->assign("indicatorTypes",$indicatorTypes);

		$indicatorTypes = $resultFrameIndicatorPeer->getTypesTranslated();
		$smarty->assign("indicatorTypes",$indicatorTypes);

		if ( !empty($_GET["id"]) ) {
			$indicator = ResultFrameIndicatorPeer::get($_GET["id"]);			
			$indicators =  ResultFrameIndicatorPeer::getAllPossibleParentsByType($indicator->getType());
			$type = $indicator->getType();
			$objectType = ResultFrameIndicatorPeer::getObjectTypeByIndicatorType($type);
			$parentId = $indicator->getParent()->getId();
			$objects = ResultFrameIndicatorPeer::getAllPossibleObjectsByTypeAndParentId($type, $parentId);
			$smarty->assign('objectType',$objectType);
			$smarty->assign('objects',$objects);
			
			$object = $indicator->getObject();
			if (!empty($object)) {
				$smarty->assign(Common::strtocamel($objectType, false), $object);              //Permite renderizar el formulario
				$this->prepareEmbeddedForm($objectType, $smarty);                              //de la entidad para el lightBox.
			}
			
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un position nuevo
			$indicator = new ResultFrameIndicator();
			$indicators =  ResultFrameIndicatorPeer::getAll();
			$smarty->assign("action","create");
		}
		
		$indicatorValues = $indicator->getValues();
		$smarty->assign('indicatorValues', $indicatorValues);

		$smarty->assign("indicator",$indicator);
		$smarty->assign("indicators",$indicators);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		if ($_GET["policyGuidelineId"])
			$smarty->assign("policyGuidelineId",$_GET["policyGuidelineId"]);
		if ($_GET["from"])
			$smarty->assign("from",$_GET["from"]);

		return $mapping->findForwardConfig('success');
	}
}

