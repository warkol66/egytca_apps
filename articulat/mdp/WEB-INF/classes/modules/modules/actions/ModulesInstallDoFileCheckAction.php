<?php
/**
 * InstallDoFileCheckAction
 *
 * @package install
 */

require_once("includes/assoc_array2xml.php");

class ModulesInstallDoFileCheckAction extends BaseAction {

	function ModulesInstallDoFileCheckAction() {
		;
	}

	function loadSQLtoDatabase($filename) {

		$data = file_get_contents($filename);

		require_once('config/DBConnection.inc.php');

		$db = new DBConnection();

		$sql = str_replace("\r\n","\n",$data);
		$queries = explode(";\n",$data);

		foreach ($queries as $query) {
			$query = trim($query);
			if (!empty($query))
				$db->query($query);
		}

		return true;

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

		$path = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/";

		//mensaje de exito
		$queryData = '&message='. "success";

		if (isset($_POST['executeSQL'])) {

			//carga de informacion de los SQL generados
			$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'information.sql';
			$this->loadSQLtoDatabase($filename);

			foreach ($_GET["languages"] as $languageCode) {
				$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'modulesLabel_' . $languageCode . '.sql';
				$this->loadSQLtoDatabase($filename);
			}

			foreach ($_GET["languages"] as $languageCode) {
				$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'actionLabel_' . $languageCode . '.sql';
				$this->loadSQLtoDatabase($filename);
			}

			$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . $_POST['moduleName'] . '-permissions.sql';
			$this->loadSQLtoDatabase($filename);

			foreach ($_GET["languages"] as $languageCode) {
				$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'messages_' . $languageCode . '.sql';
				$this->loadSQLtoDatabase($filename);
			}

			foreach ($_GET["languages"] as $languageCode) {
				$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'multilangText_' . $languageCode . '.sql';
				$this->loadSQLtoDatabase($filename);
			}

			//Cargo los textos propios del sistema
			$filename = "WEB-INF/classes/modules/" . $_POST['moduleName'] . "/setup/" . 'multilangText_sys.sql';
			$this->loadSQLtoDatabase($filename);

			//mensaje de exito si ejecuta con SQL
			$queryData = '&message='. "success-sql";
		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;
	}

}
