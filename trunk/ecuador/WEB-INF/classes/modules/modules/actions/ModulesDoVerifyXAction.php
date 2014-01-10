<?php

require_once 'ModuleVerify.class.php';

class ModulesDoVerifyXAction extends BaseAction {

	function ModulesDoVerifyXAction() {
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
		if (!$verify->lookDir($verify->dir['dir'])){
			//echo "Could not open the directory ".$verify->dir['dir']."\n";
			$smarty->assign('error','abrir el directorio');
		}else{
			if (!file_exists($verify->fileDir)) {
				mkdir($verify->fileDir, 0777, true);
			}
			// si es un modulo nuevo guardo el fingerprint
			if (!file_exists($verify->file)) {
				if (!file_put_contents($verify->file, serialize($verify->hashes), LOCK_EX)){
					$smarty->assign('error','intentar guardar los fingerprints');
				}
			}else{
				$smarty->assign('newModule',true);
			}
			$smarty->assign('directoryHash',$verify->getDirectoryHash());
			$smarty->assign('newFiles',$verify->newFiles);
			$smarty->assign('changedFiles',$verify->changedFiles);
			$smarty->assign('allHashes',serialize($verify->hashes));
		}
		
		$smarty->assign('verifiedModule',$_POST['moduleName']);
		
		return $mapping->findForwardConfig('success');
	}

}
