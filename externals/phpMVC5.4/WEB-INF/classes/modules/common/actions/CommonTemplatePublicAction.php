<?php
/**
 * CommonTemplatePublicAction
 *
 * @package common
 */

class CommonTemplatePublicAction extends BaseAction {

	function CommonTemplatePublicAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplatePublic.tpl";
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		return $mapping->findForwardConfig('success');

	}

}
