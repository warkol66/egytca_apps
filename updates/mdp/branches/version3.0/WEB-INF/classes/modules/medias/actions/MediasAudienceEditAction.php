<?php

class MediasAudienceEditAction extends BaseAction {

	function MediasAudienceEditAction() {
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

			$mediaAudience = MediaAudiencePeer::get($_GET["id"]);

			if (!is_null($mediaAudience)) {

			}
			else
				$mediaAudience = new MediaAudience();

			$smarty->assign("mediaAudience",$mediaAudience);
			$smarty->assign("action","edit");

		}
		else {
			//voy a crear un objeto nuevo
			$mediaAudience = new MediaAudience();
			$smarty->assign("mediaAudience",$mediaAudience);
			$smarty->assign("action","create");
		}

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}
