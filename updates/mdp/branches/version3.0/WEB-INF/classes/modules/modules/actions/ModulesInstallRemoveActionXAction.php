<?php
/**
 * InstallRemoveActionAction
 *
 * @package install
 */


class ModulesInstallRemoveActionXAction extends BaseAction {

	function ModulesInstallRemoveActionXAction() {
		;
	}

	function deleteAction($actionName) {
		$filename = 'WEB-INF/classes/modules/'.$_POST['moduleName'].'/actions/'.$actionName.'Action.php';

		if (file_exists($filename)) {
			if (!unlink($filename))
				throw new Exception('No se pudo eliminar el archivo '.$filename.'. Compruebe que el directorio tenga los permisos necesarios');
		}
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

		if (!empty($_POST['moduleName']) && !empty($_POST['actionName'])) {

			$modulePath = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/actions/";
			$directoryHandler = opendir($modulePath);
			$actions = array();

			while (false !== ($filename = readdir($directoryHandler))) {
				
				//verifico si es un archivo php
				if (is_file($modulePath . $filename) && (preg_match('/(.*)Action.php$/',$filename,$regs)))
					array_push($actions,$regs[1]);

			}
			closedir($directoryHandler);

			//separacion entre accions con par y acciones sin par

			foreach ($actions as $action) {

				//separamos los pares de aquellos que no tienen pares
				if (preg_match("/(.*)([a-z]Do[A-Z])(.*)/",$action,$parts)) {
					//armamos el nombre de la posible action sin do
					$actionWithoutDo = $parts[1].$parts[2][0].$parts[2][3].$parts[3];

					if (in_array($actionWithoutDo,$actions))
						$pairActions[$actionWithoutDo] = $action;

				}
			}

			try {
				$this->deleteAction($_POST['actionName']);
				if (in_array($_POST['actionName'], array_keys($pairActions)))
					$this->deleteAction($pairActions[$_POST['actionName']]);
			} catch (Exception $e) {
				$smarty->assign('message', $e->getMessage());
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');

		}
		else {
			$smarty->assign('message', 'wrongParams');
			return $mapping->findForwardConfig('failure');
		}
	}

}
