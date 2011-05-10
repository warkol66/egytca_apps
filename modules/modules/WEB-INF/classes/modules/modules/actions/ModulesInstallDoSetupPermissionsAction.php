<?php
/**
 * InstallDoSetupPermissionsAction
 *
 * @package install
 */

if(false === function_exists('lcfirst')){
	/**
	 * Make a string's first character lowercase
	 *
	 * @param string $str
	 * @return string the resulting string.
	 */
	function lcfirst( $str ) {
		$str[0] = strtolower($str[0]);
		return (string)$str;
	}
}

class ModulesInstallDoSetupPermissionsAction extends BaseAction {

	function ModulesInstallDoSetupPermissionsAction() {

	}

	function generateSQLInsertSecurityModule($module,$access,$accessAffiliateUser) {
		$query = "INSERT INTO `security_module` ( `module` , `access` , `accessAffiliateUser` ) VALUES ('$module', '$access', '$accessAffiliateUser');";
		return $query;
	}

	/**
	 * Escribe los permisos a la salida
	 * @param $module modulo al que pertenecen las actions
	 * @param $permission array de permisos de usuario para las acciones recibido por post
	 * @param $permission array de permisos de afiliado para las acciones recibido por post
	 * @param $fd file descriptor del archivo donde se deberan guardar los permisos
	 *
	 */
	function writeActionsPermissionsToOutput($module,$pairs,$permission,$permissionAffiliate,$permissionRegistration,$noCheckLoginArray,$fd) {

		$sql = SecurityActionPeer::getSQLCleanup($module);
		fprintf($fd,"%s\n",$sql);

		foreach (array_keys($permission) as $action) {

			if (array_key_exists('all',$permission[$action])) //para ese action todos los permisos
				$bitLevel = 1073741823;
			else {
				$bitLevel = 0;
				foreach ($permission[$action]['access'] as $access)
					$bitLevel += $access;

				if ($bitLevel > 0)
					$bitLevel += 1;	//El supervisor siempre tiene acceso

			}

			if (isset($permissionAffiliate[$action]['all'])) //para ese action todos los permisos
				$bitLevelAffiliate = 1073741823;
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
			fprintf($fd,"%s\n",$sql);
		}

	}

	/**
	 * Escribe los permisos a la salida
	 * @param $module modulo al que pertenecen las actions
	 * @param $permission array de permisos de usuario para las acciones recibido por post
	 * @param $permission array de permisos de afiliado para las acciones recibido por post
	 * @param $fd file descriptor del archivo donde se deberan guardar los permisos
	 *
	 */
	function writeGeneralPermissionsToOutput($module,$permission,$permissionAffiliate,$permissionRegistration,$fd) {

		if (isset($permission['all']))		//para ese action todos los permisos
			$bitLevel = 1073741823;
		else {
			$bitLevel = 0;
			foreach ($permission['access'] as $access)
				$bitLevel += $access;

			if ($bitLevel > 0)
				$bitLevel += 1;	//El supervisor siempre tiene acceso
		}

		if (isset($permissionAffiliate['all'])) //para ese action todos los permisos
			$bitLevelAffiliate = 1073741823;
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
		fprintf($fd,"%s\n",$sql);
		$sql = $securityModule->getSQLInsert();
		fprintf($fd,"%s\n",$sql);

	}

	function executeSuccess($mapping) {

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		$queryData = '&moduleName='.$_POST["moduleName"];
		if (!empty($_POST['mode']))
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

		//asigno modulo
		$module = "Install";
		$smarty->assign("module",$module);

		$modulePeer = new ModulePeer();


		if (!isset($_POST['permission']) && (!isset($_POST['moduleName'])))
			return $mapping->findForwardConfig('failure');

		//salto de paso
		if (isset($_POST['skip']))
			return $this->executeSuccess($mapping);


		$permission = $_POST['permission'];
		$pairs = $_POST['pair'];
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
		$modulePath = "WEB-INF/classes/modules/" . $_POST['moduleName'] . '/setup';
		if (!is_dir($modulePath))
			mkdir($modulePath,0755);

		$modulePath .= '/';

		//creacion de archivo de salida
		$fd = fopen($modulePath . $moduleName . '-permissions.sql','w');
		if ($fd == false)		//error de apertura de archivo a generar
			return $mapping->findForwardConfig('failure');

		$this->writeGeneralPermissionsToOutput($moduleName,$permissionGeneral,$permissionAffiliateGeneral,$permissionRegistrationGeneral,$fd);
		$this->writeActionsPermissionsToOutput($moduleName,$pairs,$permission,$permissionAffiliate,$permissionRegistration,$noCheckLogin,$fd);

		fclose($fd);

		//solamente se ejecuta este paso
		if (isset($_POST['stepOnly']))
			return $mapping->findForwardConfig('success-step');

		return $this->executeSuccess($mapping);

	}

}
