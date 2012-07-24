<?php

class MediasMarketEditAction extends BaseAction {

	function MediasMarketEditAction() {
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

		if (!empty($_GET["id"])) {
			//voy a editar un objeto

			$mediaMarket = MediaMarketPeer::get($_GET["id"]);

			if (!is_null($mediaMarket)) {

			}
			else
				$mediaMarket = new MediaMarket();

			$smarty->assign("mediaMarket",$mediaMarket);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un objeto nuevo
			$mediaMarket = new MediaMarket();
			$smarty->assign("mediaMarket",$mediaMarket);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
