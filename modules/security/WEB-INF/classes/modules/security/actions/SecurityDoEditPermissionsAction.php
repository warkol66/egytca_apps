<?php
/**
 * InstallDoSetupPermissionsAction
 *
 * @package install
 */

class SecurityDoEditPermissionsAction extends BaseAction {

	function SecurityDoEditPermissionsAction() {

	}

	function generateSQLInsertSecurityModule($module,$access,$accessAffiliateUser) {
		$query = "INSERT INTO `security_module` ( `module` , `access` , `accessAffiliateUser` ) VALUES ('$module', '$access', '$accessAffiliateUser');";
		return $query;
	}

	/**
	 * Actualiza los permisos
	 * @param $module modulo al que pertenecen las actions
	 * @param $permission array de permisos de usuario para las acciones recibido por post
	 * @param $permission array de permisos de afiliado para las acciones recibido por post
	 * @param bd la conexion a la base de datos para ejecutar los querys
	 *
	 */
	function updateActionsPermissionsToOutput($module,$pairs,$permission,$permissionAffiliate,$permissionRegistration,$noCheckLoginArray,$db) {

		$sql = SecurityActionPeer::getSQLCleanup($module);

		$queries = explode(";",$sql);

		foreach ($queries as $query) {
			$query = trim($query);
			if (!empty($query))
				$db->query($query);
		}

		foreach (array_keys($permission) as $action) {

			if (array_key_exists('all',$permission[$action])) //para ese action todos los permisos
				$bitLevel = SecurityModulePeer::LEVEL_ALL;
			else {
				$bitLevel = 0;
				foreach ($permission[$action]['access'] as $access)
					$bitLevel += $access;

				if ($bitLevel > 0)
					$bitLevel += 1;	//El supervisor siempre tiene acceso

			}

			if (isset($permissionAffiliate[$action]['all'])) //para ese action todos los permisos
				$bitLevelAffiliate = SecurityModulePeer::LEVEL_ALL;
			else {
				$bitLevelAffiliate = 0;
				foreach ($permissionAffiliate[$action]['access'] as $access)
					$bitLevelAffiliate += $access;
			}

			$accessRegistrationUser = 0;
			if ($permissionRegistration[$action] == '1')
				$accessRegistrationUser = 1;

			$noCheckLogin = 0;
			if ($noCheckLoginArray[$action] == '1')
				$noCheckLogin = 1;


			$pairedAction = "";
			if (array_key_exists('pair',$pairs[$action])) //vemos si la accion tiene definido un pair
				$pairedAction = lcfirst($pairs[$action]['pair']);

			//TODO FALTA SECCION
			$section = '';

			$securityAction = new SecurityAction();
			$securityAction->setAction(lcfirst($action));
			$securityAction->setModule($module);
			$securityAction->setSection($section);
			$securityAction->setAccess($bitLevel);
			$securityAction->setAccessRegistrationUser($accessRegistrationUser);
			$securityAction->setNoCheckLogin($noCheckLogin);
			$securityAction->setAccessAffiliateUser($bitLevelAffiliate);
			$securityAction->setActive(1);
			$securityAction->setPair($pairedAction);

			$sql = $securityAction->getSQLInsert();

			if (!empty($sql))
				$db->query($sql);

		}

	}

	/**
	 * Escribe los permisos a la salida
	 * @param $module modulo al que pertenecen las actions
	 * @param $permission array de permisos de usuario para las acciones recibido por post
	 * @param $permission array de permisos de afiliado para las acciones recibido por post
	 * @param bd la conexion a la base de datos para ejecutar los querys
	 *
	 */
	function updateGeneralPermissionsToOutput($module,$permission,$permissionAffiliate,$permissionRegistration,$db) {

		if (isset($permission['all']))		//para ese action todos los permisos
			$bitLevel = SecurityModulePeer::LEVEL_ALL;
		else {
			$bitLevel = 0;
			foreach ($permission['access'] as $access)
				$bitLevel += $access;

			if ($bitLevel > 0)
				$bitLevel += 1;	//El supervisor siempre tiene acceso
		}

		if (isset($permissionAffiliate['all'])) //para ese action todos los permisos
			$bitLevelAffiliate = SecurityModulePeer::LEVEL_ALL;
		else {
			$bitLevelAffiliate = 0;

			foreach ($permissionAffiliate['access'] as $access) {
				$bitLevelAffiliate += $access;

			}

		}

		$accessRegistrationUser = 0;

		if ($permissionRegistration == '1')
			$accessRegistrationUser = 1;

		$securityModule = new SecurityModule();
		$securityModule->setModule($module);
		$securityModule->setAccess($bitLevel);
		$securityModule->setAccessRegistrationUser($accessRegistrationUser);
		$securityModule->setAccessAffiliateUser($bitLevelAffiliate);
		$securityModule->setNoCheckLogin($_POST["noCheckLoginModule"]);

		$sql = $securityModule->getSQLCleanup();

		$queries = explode(";",$sql);

		foreach ($queries as $query) {
			$query = trim($query);
			if (!empty($query))
				$db->query($query);
		}

		$sql = $securityModule->getSQLInsert();

		$queries = explode(";",$sql);

		foreach ($queries as $query) {
			$query = trim($query);
			if (!empty($query))
				$db->query($query);
		}

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

		//asigno modulo
		$module = "Security";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();


		if (!isset($_POST['permission']) && (!isset($_POST['moduleName'])))
			return $mapping->findForwardConfig('failure');

		$permission = $_POST['permission'];
		$permissionAffiliate = $_POST['permissionAffiliate'];
		$permissionGeneral = $_POST['permissionGeneral'];
		$permissionAffiliateGeneral = $_POST['permissionAffiliateGeneral'];
		$permissionRegistrationGeneral = $_POST['permissionRegistrationGeneral'];
		$permissionRegistration = $_POST['permissionRegistration'];
		$noCheckLogin = $_POST['noCheckLogin'];

		foreach (array_keys($noCheckLogin) as $action)
			if (!array_key_exists($action,$permission))
				$permission[$action] = $action;

		$moduleName = $_POST['moduleName'];

		require_once('config/DBConnection.inc.php');
		$db = new DBConnection();
		if (!$db->connect()) {
			echo "No db conection!!!";
			die();
		}
		$this->updateGeneralPermissionsToOutput($moduleName,$permissionGeneral,$permissionAffiliateGeneral,$permissionRegistrationGeneral,$db);
		$this->updateActionsPermissionsToOutput($moduleName,$pairs,$permission,$permissionAffiliate,$permissionRegistration,$noCheckLogin,$db);

		$params["moduleName"] = $moduleName;
		$logSufix = ', ' . Common::getTranslation("action: edit permissions","common");
		Common::doLog('success',$moduleName . $logSufix);
		return $this->addParamsToForwards($params,$mapping,'success');

	}

}
