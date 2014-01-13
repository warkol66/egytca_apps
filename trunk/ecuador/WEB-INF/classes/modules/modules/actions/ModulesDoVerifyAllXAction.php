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
		
		$fingerprintsFile = false;
		
		$modules = ModuleVerify::getDirs();
		
		$errors = array();
		$verifModules = array();
		$newModules = array();
		
		foreach($modules as $name => $details){
			$verify = new ModuleVerify($name);
			if (!$fingerprintsFile && !file_exists($verify->fileDir)) {
				mkdir($verify->fileDir, 0777, true);
			}
			// para evitar chequear todas las veces
			$fingerprintsFile = true;
			if (!$verify->lookDir($verify->dir['dir'])){
				$errors[$name] = 'abrir el directorio'. $verify->dir['dir'];
			}else{
				$verifModules[$name]['newFiles'] = $verify->newFiles;
				$verifModules[$name]['changedFiles'] = $verify->changedFiles;
				if($verify->getDirectoryHash() != $verify->getNewHash())
					$verifModules[$name]['newHash'] = $verify->getNewHash();
				else
					$verifModules[$name]['oldHash'] = $verify->getDirectoryHash();
				// si hay archivos nuevos
				if(!empty($verifModules[$name]['newFiles']) || !empty($verifModules[$name]['changedFiles'])){
					// si el archivo no existe, actualizo automaticamente
					if (!file_exists($verify->file)) {
						if (!file_put_contents($verify->file, serialize($verify->hashes), LOCK_EX)){
							$errors[$name] = 'intentar guardar los fingerprints de'. $verify->dir['dir'];
						}
					}else{
						$verifModules[$name]['update'] = serialize($verify->hashes);
					}
				}
			}
		}
		
		$smarty->assign('errors',$errors);
		
		$smarty->assign('verifModules',json_encode($verifModules));	
		$smarty->assign('newModules',$newModules);	
		return $mapping->findForwardConfig('success');
	}

}
