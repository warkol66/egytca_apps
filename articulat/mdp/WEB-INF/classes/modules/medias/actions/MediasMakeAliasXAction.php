<?php

class MediasMakeAliasXAction extends BaseAction {

	function MediasMakeAliasXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Medias";
		$smarty->assign("module",$module);
		
		if (!empty($_POST['mediaId']) && !empty($_POST['aliasOf'])) {
			
			$media = MediaQuery::create()->findOneById($_POST['mediaId']);
			
			$aliasof = MediaQuery::create()->findOneById($_POST['aliasOf']);
			if (is_null($aliasof)) {
				$smarty->assign('message', 'aliasOf no es un ID válido');
				return $mapping->findForwardConfig('failure');
			}
			
			$media->setAliasof($_POST['aliasOf']);
			
			$media->save();
			
			return $mapping->findForwardConfig('success');
		} else {
			$smarty->assign('message', 'parámetros inválidos');
			return $mapping->findForwardConfig('failure');
		}
		
	}

}
