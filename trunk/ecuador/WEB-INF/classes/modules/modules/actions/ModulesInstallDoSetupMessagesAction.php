<?php
/**
 * InstallDoSetupMessagesAction
 *
 * @package install
 */

class ModulesInstallDoSetupMessagesAction extends BaseAction {

	function ModulesInstallDoSetupMessagesAction() {
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
			$queryData .= '&file_errors[]=' . 'messages_' . $lang . '.sql';
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
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
		if (!is_dir($modulePath)) {
			if(!mkdir($modulePath,0755))
				return $mapping->findForwardConfig('failure-create');
		}

		$modulePath .= '/';

		$fds = Array();
		foreach ($_POST["languages"] as $languageCode) {
			$open_file = fopen($modulePath . 'messages_'.$languageCode.'.sql','w');
			//si el archivo existe y tiene permisos de escritura lo modifico
			if($open_file) {
				$fds[$languageCode] = $open_file;
				fprintf($fds[$languageCode],"%s\n",ActionLogLabelPeer::getSQLCleanup($_POST['moduleName'],$languageCode));
			}else{
				//si no lo pude abrir, lo voy a informar
				$file_errors[$languageCode] = $languageCode;
			}
		}

		$messages = $_POST['message'];

		foreach (array_keys($messages) as $action) {

			foreach(array_keys($messages[$action]) as $forward) {

				foreach(array_keys($messages[$action][$forward]) as $lang) {

					//creamos un action log label
					$actionLogLabel = new ActionLogLabel();
					$actionLogLabel->setAction(ucfirst($action));
					$actionLogLabel->setForward($forward);
					$actionLogLabel->setLanguage($lang);
					$actionLogLabel->setLabel($messages[$action][$forward][$lang]);
					//obtenemos el insert asociado a la instancia
					$sql = $actionLogLabel->getSQLInsert();
					fprintf($fds[$lang],"%s\n",$sql);
				}
			}

		}

		foreach ($_POST["languages"] as $languageCode)
			fclose($fds[$languageCode]);
			
		//si no se pudo escribir algun archivo, lo informo
		if(count($file_errors) > 0)
			return $this->executeFailure($mapping, $file_errors);

		//solamente se ejecuta este paso
		if (isset($_POST['stepOnly']))
			return $mapping->findForwardConfig('success-step');

		return $this->executeSuccess($mapping);
	}

}
