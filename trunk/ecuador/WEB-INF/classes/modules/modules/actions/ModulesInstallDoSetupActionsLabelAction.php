<?php
/**
 * InstallDoSetupActionsLabelAction
 *
 * @package install
 */

class ModulesInstallDoSetupActionsLabelAction extends BaseAction {

	function ModulesInstallDoSetupActionsLabelAction() {
		;
	}

	function executeSuccess($mapping) {

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&moduleName='.$_POST["moduleName"];
		if (isset($_POST['mode']))
			$queryData .= '&mode=' . $_POST['mode'];
		foreach ($_POST["languages"] as $languageId)
			$queryData .= '&languages[]=' . $languageId;
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}
	
	function executeFailure($mapping, $file_errors) {

		$myRedirectConfig = $mapping->findForwardConfig('failure');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&moduleName='.$_POST["moduleName"];
		if (isset($_POST['mode']))
			$queryData .= '&mode=' . $_POST['mode'];
		foreach ($file_errors as $lang)
			$queryData .= '&file_errors[]=' . 'actionLabel_' . $lang . '.sql';
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		global $PHP_SELF;
		//////////
		// Call our business logic from here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Install";
		$smarty->assign("module",$module);
		
		if (!isset($_POST['moduleName']))
			return $mapping->findForwardConfig('failure');

		//salto de paso
		if (isset($_POST['skip']))
			return $this->executeSuccess($mapping);

		$modulePath = "WEB-INF/classes/modules/" . $_POST['moduleName'] . '/setup';
		if (!is_dir($modulePath)){
			if(!mkdir($modulePath,0755))
				return $mapping->findForwardConfig('falure');
		}

		$modulePath .= '/';

		//guardado de informacion de descripcion del modulo

		$fds = Array();
		$file_errors = Array();
		foreach ($_POST["languages"] as $languageCode) {
			//si el archivo existe y tiene permisos de escritura lo modifico
			if(is_writable($modulePath . 'actionLabel_'.$languageCode.'.sql')) {
				$fds[$languageCode] = fopen($modulePath . 'actionLabel_'.$languageCode.'.sql','w');
				$securityActionLabel = new SecurityActionLabel();
				$sql = $securityActionLabel->getSQLCleanup($_POST['moduleName'],$languageCode);
				fprintf($fds[$languageCode],"%s\n",$sql);
			}else{
				//si no existe o no tiene permisos de escritura, lo voy a informar
				$file_errors[$languageCode] = $languageCode;
			}
		}

		foreach ($_POST["labels"] as $action => $labels) {
			foreach ($labels as $languageCode => $label) {
				$securityActionLabel = new SecurityActionLabel();
				$securityActionLabel->setAction($action);
				$securityActionLabel->setLabel($label['label']);
				$securityActionLabel->setDescription($label['description']);
				$securityActionLabel->setLanguage($languageCode);
				$sql = $securityActionLabel->getSQLInsert();
				fprintf($fds[$languageCode],"%s\n",$sql);
			}
		}

		foreach ($_POST["languages"] as $languageCode)
			fclose($fds[$languageCode]);
			
		/*print_r($file_errors);
		die();*/
		$smarty->assign("file_errors",$file_errors);
		
		return $this->executeFailure($mapping, $file_errors);

		//solamente se ejecuta este paso
		if (isset($_POST['stepOnly']))
			return $mapping->findForwardConfig('success-step');

		return $this->executeSuccess($mapping);

	}

}
