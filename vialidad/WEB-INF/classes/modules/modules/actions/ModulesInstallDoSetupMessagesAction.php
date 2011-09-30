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

		$modulePeer = new ModulePeer();

		if (!isset($_POST['moduleName']))
			return $mapping->findForwardConfig('failure');

		//salto de paso
		if (isset($_POST['skip']))
			return $this->executeSuccess($mapping);

		$modulePath = "WEB-INF/classes/modules/" . $_POST['moduleName'] . '/setup';
		if (!is_dir($modulePath))
			mkdir($modulePath,0755);

		$modulePath .= '/';

		$fds = Array();
		foreach ($_POST["languages"] as $languageCode)
			$fds[$languageCode] = fopen($modulePath . 'messages_'.$languageCode.'.sql','w');

		foreach ($_POST["languages"] as $languageCode)
			fprintf($fds[$languageCode],"%s\n",ActionLogLabelPeer::getSQLCleanup($_POST['moduleName'],$languageCode));

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

		//solamente se ejecuta este paso
		if (isset($_POST['stepOnly']))
			return $mapping->findForwardConfig('success-step');

		return $this->executeSuccess($mapping);
	}

}
