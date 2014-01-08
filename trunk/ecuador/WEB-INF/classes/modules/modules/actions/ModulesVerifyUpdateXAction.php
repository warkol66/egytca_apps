<?php

require_once 'ModuleVerify.class.php';

class ModulesVerifyUpdateXAction extends BaseAction {

	function ModulesVerifyUpdateXAction() {
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
		
		$module = "Modules";
		$smarty->assign("module",$module);
		
		$verify = new ModuleVerify($_POST['moduleName']);
		// los hashes ya vienen serializados
		if (!file_put_contents($verify->file, $_POST['hashes'])){
			$smarty->assign('error','intentar guardar los fingerprints');
		}
		
		$smarty->assign('verifiedModule',$_POST['moduleName']);
		$smarty->assign('hash',md5_file($verify->file));
		
		return $mapping->findForwardConfig('success');
	}

}

