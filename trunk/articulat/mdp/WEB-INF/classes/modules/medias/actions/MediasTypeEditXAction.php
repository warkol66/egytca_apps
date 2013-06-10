<?php

class MediasTypeEditXAction extends BaseAction {

	function MediasTypeEditXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$mediaType = new MediaType();
		$smarty->assign("mediaType",$mediaType);
		$smarty->assign("action","create");

		return $mapping->findForwardConfig('success');
	}

}
