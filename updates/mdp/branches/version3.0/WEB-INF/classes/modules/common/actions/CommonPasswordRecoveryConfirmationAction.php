<?php
/**
 * CommonPasswordRecoveryConfirmationAction
 *
 * @package users
 */

require_once("EmailManagement.php");

class CommonPasswordRecoveryConfirmationAction extends BaseAction {

	function CommonPasswordRecoveryConfirmationAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplatePlain.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$section = "Users";

		$this->template->template = "TemplateLogin.tpl";
		
		if (ConfigModule::get('users','askForNewPasswordOnRecovery')) {
			$smarty->assign("recoveryHash", $_GET["recoveryHash"]);
			return $mapping->findForwardConfig('askNewPass');
		} 
		else
			return $this->addParamsToForwards(array("recoveryHash"=>$_GET["recoveryHash"]),$mapping,'sendNewPass');

	}

}
