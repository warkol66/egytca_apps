<?php
/** 
 * CommonConfigEditAction
 *
 * @package config 
 */

class CommonConfigEditAction extends BaseAction {

	function CommonConfigEditAction() {
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

		$module = "Common";
		$smarty->assign("module",$module);
		$section = "Config";
		$smarty->assign("section",$section);

		global $system;
		$smarty->assign("config",$system["config"]);

		return $mapping->findForwardConfig('success');
	}

}
