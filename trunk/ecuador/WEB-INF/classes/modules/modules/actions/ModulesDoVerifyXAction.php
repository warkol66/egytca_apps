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
			if (!file_put_contents($verify->file, serialize($verify->hashes))){
				$smarty->assign('error','intentar guardar los fingerprints');
			}
			$smarty->assign('directoryHash',$verify->getDirectoryHash());
			$smarty->assign('newFiles',$verify->newFiles);
			$smarty->assign('changedFiles',$verify->changedFiles);
		}
		
		return $mapping->findForwardConfig('success');
	}

}
