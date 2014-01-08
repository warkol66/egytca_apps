<?php

require_once 'ModuleVerify.class.php';

class ModulesDoVerifyAllXAction extends BaseAction {

	function ModulesDoVerifyAllXAction() {
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
		
		$modules = ModuleVerify::getDirs();
		
		$errors = array();
		$verifModules = array();
		
		foreach($modules as $name => $details){
			$verify = new ModuleVerify($name);
			if (!$verify->lookDir($verify->dir['dir'])){
				$errors[$name] = 'abrir el directorio'. $verify->dir['dir'];
			}else{
				$verifModules[$name]['newFiles'] = $verify->newFiles;
				$verifModules[$name]['changedFiles'] = $verify->changedFiles;
				$verifModules[$name]['hash'] = $verify->getDirectoryHash();
				/*if (!file_put_contents($verify->file, serialize($verify->hashes))){
					$errors[$name] = 'intentar guardar los fingerprints de'. $verify->dir['dir'];
				}*/
			}
		}
		
		$smarty->assign('errors',$errors);
		
		$smarty->assign('verifModules',json_encode($verifModules));	
		return $mapping->findForwardConfig('success');
	}

}
