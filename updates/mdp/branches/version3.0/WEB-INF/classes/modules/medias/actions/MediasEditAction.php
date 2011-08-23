<?php


class MediasEditAction extends BaseAction {

	function prepareEdit($smarty) {

		$mediaMarkets = MediaMarketPeer::getAll();
		$smarty->assign('mediaMarkets',$mediaMarkets);

		$mediaAudiences = MediaAudiencePeer::getAll();
		$smarty->assign('mediaAudiences',$mediaAudiences);

	}

	function MediasEditAction() {
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

		$mediaTypes = MediaTypePeer::getAll();
		$smarty->assign("mediaTypes",$mediaTypes);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto
			$media = MediaPeer::get($_GET["id"]);
			$smarty->assign("media",$media);
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un objeto nuevo
			$media = new Media();
			$smarty->assign("media",$media);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

  	$this->prepareEdit($smarty);

		return $mapping->findForwardConfig('success');
	}

}
