<?php
/**
* Clase Common
*
* @package  common
*/

class Common {
	/**
	* Indica si el sistema se encuentra en mantenimiento y se debe reenviar al usuario a la pantalla de Maintenance.
	*
	* @return true si el sistema esta en mantenimiento
	**/
	public static function inMaintenance() {
		global $system;
		$maintenance = $system["config"]["system"]["parameters"]["underMaintenance"]["value"];

		if ($maintenance != "YES")
			return false;

		$noCheckMaintenance = array();
		$noCheckMaintenance[] = "commonMaintenance";
		$noCheckMaintenance[] = "usersLoginMaintenance";
		$noCheckMaintenance[] = "usersDoLogin";
		$noCheckMaintenance[] = "usersDoLogout";

		$isNoCheckMaintenanceAction = array_search($_REQUEST["do"],$noCheckMaintenance);

		//si es un action que no requiere chequeo de mantenimiento, devolver false
		if ($isNoCheckMaintenanceAction !== false)
			return false;

		$user = $_SESSION["loginUser"];

		if (!empty($user)) {
			$level = $user->getLevel();
			//si el usuario logueado tiene un nivel menor a 3 (supervisor y admin), devolver false
			if ($level < 3)
				return false;
		}

		return true;
	}

	/**
	*	Recibe una fecha en formato mm-dd-yyyy y la devuelve yyyy-mm-dd
	*
	* @param string $usDate Fecha en formato mm-dd-yyyy
	* @return string Fecha en formate yyyy-mm-dd
	*/
	public static function usDateToDbDate($usDate) {
		$dateExplode = explode("-", $usDate);
		$dbDate = date("Y-m-d",mktime(0,0,0,$dateExplode[1],$dateExplode[0],$dateExplode[2]));
		return $dbDate;
	}

	/**
	* obtiene el id de usuario y de afiliado
	* @return array $userInfo informacion encontrada
	*/
	public static function userInfoToDoLog() {
		$userInfo = array();
		if (!empty($_SESSION['loginUser'])) {
			$user = $_SESSION['loginUser'];
			if(is_object($user))
				$userInfo["userId"] = $user->getId();
			$userInfo["affiliateId"] = 0;
			$userInfo["objectType"] = 'user';
			$userInfo["objectId"] = $userInfo["userId"];
		}
		else if (!empty($_SESSION['loginUserByRegistration'])) {
			$userInfo["userId"] = $_SESSION['loginUserByRegistration'];
			$userInfo["affiliateId"] = 999999 ;
			$userInfo["objectType"] = 'registration';
			$userInfo["objectId"] = $userInfo["userId"];
		}
		else if (!empty($_SESSION["loginAffiliateUser"])) {
			$userInfo["userId"] = $_SESSION["loginAffiliateUser"]->getId();
			$userInfo["affiliateId"] = $_SESSION["loginAffiliateUser"]->getAffiliateId();
			$userInfo["objectType"] = 'affiliate';
			$userInfo["objectId"] = $userInfo["userId"];
		}
		else if (!empty($_SESSION["loginClientUser"])) {
			$userInfo["userId"] = $_SESSION["loginClientUser"]->getId();
			$userInfo["clientId"] = $_SESSION["loginClientUser"]->getClientId();
			$userInfo["objectType"] = 'client';
			$userInfo["objectId"] = $userInfo["userId"];
		}

		return $userInfo;
	}

	/**
	* Agrega la informacion del user y id a params
	* @return array $params array con la informacion recibida mas la del tipo de usuario y su id
	*/
	public static function addUserInfoToParams($params) {

		$userInfo = array();
		$loggedUser = Common::getLoggedUser();
		if($loggedUser){
			$userInfo["userObjectType"] = get_class($loggedUser);
			$userInfo["userObjectId"] = $loggedUser->getId();
			$userInfo["userId"] = $loggedUser->getId();
		}

		$params = array_merge_recursive($params, $userInfo);

		return $params;
	}

	/**
	* Guarda un registro de log.
	*
	* @param string $user datos del usuario
	* @param string $action nombre del action
	* @param string $forward tipo de forward (success, failure, errorLog, etc)
	* @param string $message mensaje resultado de la accion
	* @return void
	*/
	public static function doLog($forward,$message=null) {
		if (ConfigModule::get("global","doLog")){

			$action = ucfirst($_REQUEST['do']);
			$userInfo = Common::userInfoToDoLog();

			try{
				$logs = new ActionLog();
				$logs->setDatetime(time());
				$logs->setAction($action);
				$logs->setMessage($message);
				$logs->setForward($forward);
				$logs->setUserObjectType($userInfo["objectType"]);
				$logs->setUserObjectId($userInfo["objectId"]);
				$logs->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
	}

	/**
	 * Indica si un usuario es afiliado.
	 */
	function isAffiliatedUser() {
		if (isset($_SESSION["loginAffiliateUser"]))
			return true;
		return false;
	}

	/**
	 * Indica si un usuario es cliente.
	 */
	function isClientUser() {
		if (isset($_SESSION["loginClientUser"]))
			return true;
		return false;
	}

	/**
	 * Obtiene el Id de un afiliado apartir de un usuario
	 */
	function getAffiliatedId() {
		$user = $_SESSION["loginAffiliateUser"];
		return $user->getAffiliateId();
	}

	/**
	 * Obtiene el Id de un afiliado apartir de un usuario
	 */
	function getClientId() {
		$user = $_SESSION["loginClientUser"];
		return $user->getClientId();
	}

	/**
	 * Indica si es un usuario de sistema.
	 */
	function isSystemUser() {
		if (isset($_SESSION["loginUser"]))
			return true;
		return false;
	}

	/**
	 * Indica si el usuario es administrador
	 */
	function isAdmin() {
		if (!isset($_SESSION['loginUser']))
			return false;
		$user = $_SESSION['loginUser'];
		return $user->isAdmin();
	}

	/**
	 * Obtiene el Id de un usuario
	 */
	function getAdminUserId() {
		$user = $_SESSION["loginUser"];
		return $user->getId();
	}

	/**
	 * Obtiene la informacion de un usuario por afiliado a partir de la session
	 */
	function getAffiliatedLogged() {
		return $_SESSION["loginAffiliateUser"];
	}

	/**
	 * Obtiene la informacion de un usuario a partir de la session
	 */
	function getAdminLogged() {
		return $_SESSION["loginUser"];
	}

	/**
	 * Indica si el usuario por registro
	 */
	function isRegistrationUser() {
		if (isset($_SESSION["loginRegistrationUser"]))
			return true;
		return false;
	}

	/**
	 * Obtiene la informacion de un usuario por registro a partir de la session
	 */
	function getRegistrationUserLogged() {
		return $_SESSION["loginRegistrationUser"];
	}

	/**
	* obtiene objeto user si esta logueado algun tipo de usuario
	* @return obj $user con el objeto logueado de la session
	*/
	public static function getLoggedUser() {
		$user = NULL;
		if (!empty($_SESSION['loginUser']) && is_object($_SESSION['loginUser']) && get_class($_SESSION["loginUser"]) == "User")
			$user = $_SESSION['loginUser'];
		else if (!empty($_SESSION['loginRegistrationUser']) && is_object($_SESSION['loginRegistrationUser']) && get_class($_SESSION["loginRegistrationUser"]) == "RegistrationUser")
			$user = $_SESSION['loginRegistrationUser'];
		else if (!empty($_SESSION["loginAffiliateUser"]) && is_object($_SESSION['loginAffiliateUser']) && get_class($_SESSION["loginAffiliateUser"]) == "AffiliateUser")
			$user = $_SESSION['loginAffiliateUser'];
		else if (!empty($_SESSION["loginClientUser"]) && is_object($_SESSION['loginClientUser']) && get_class($_SESSION["loginClientUser"]) == "ClientUser")
			$user = $_SESSION['loginClientUser'];

		if (!ConfigModule::get("global","nonConcurrentSession"))
			return $user;
		else if (is_object($user) && $user->verifySession())
			return $user;
	}

	/**
	* obtiene usuario de los otros tipos disponibles
	* @return obj $user si encuentra el usuario en otros tipos disponibles
	*/
	public static function getByUsername($username) {
		$user = NULL;
		$user = BaseQuery::create('User')->findOneByUsername($username);
		if (!empty($user))
			return $user;
		if (class_exists(AffiliateUserQuery)){
			$user = BaseQuery::create('AffiliateUser')->findOneByUsername($username);
			if (!empty($user))
				return $user;
		}
		if (class_exists(ClientUserQuery)){
			$user = BaseQuery::create('ClientUser')->findOneByUsername($username);
			if (!empty($user))
				return $user;
		}
		return $user;
	}

	/**
	* obtiene objeto user si esta logueado algun tipo de usuario
	* @return obj $user con el objeto logueado de la session
	*/
	public static function authenticateByUserAndMail($username,$email) {
		if (class_exists('UserQuery')){
			$user = BaseQuery::create('User')->searchByUsernameAndMail($username,$email)->findOne();
			if (!empty($user))
				return $user;
		}
		if (class_exists('AffiliateUserQuery')){
			$user = BaseQuery::create('AffiliateUser')->searchByUsernameAndMail($username,$email)->findOne();
			if (!empty($user))
				return $user;
		}
		if (class_exists('ClientUserQuery')){
			$user = BaseQuery::create('ClientUser')->searchByUsernameAndMail($username,$email)->findOne();
			if (!empty($user))
				return $user;
		}
		return;
	}

	/**
	* obtiene objeto user si esta logueado algun tipo de usuario
	* @return obj $user con el objeto logueado de la session
	*/
	public static function getByRecoveryHash($hash) {
		if (class_exists('UserQuery')){
			$user = BaseQuery::create('User')->findOneByRecoveryhash($hash);
			if (!empty($user))
				return $user;
		}
		if (class_exists('AffiliateUserQuery')){
			$user = BaseQuery::create('AffiliateUser')->findOneByRecoveryhash($hash);
			if (!empty($user))
				return $user;
		}
		if (class_exists('ClientUserQuery')){
			$user = BaseQuery::create('ClientUser')->findOneByRecoveryhash($hash);
			if (!empty($user))
				return $user;
		}
		return;
	}

	/**
	 * Indica si hay login unificado en la configuracion del sistema
	 * @return boolean
	 */
	public static function hasUnifiedLogin() {
		if (ConfigModule::get("global","unifiedLogin"))
			return true;
		else
			return false;
	}

	/**
	* unifiedUsernames
	* Informa si se utilizan usuarios unificados con afiliados
	* @return boolean si usas los nombres unificados con afiliados
	*/
	public static function hasUnifiedUsernames(){
		if (ConfigModule::get("global","unifiedUsernames"))
			return true;
		else
			return false;
	}

	/**
	 * Obtiene los grupos a los que pertenece un usuario
	 */
	public static function getAdminGroupsIds() {
		$user = Common::getAdminLogged();
		$userGroups = $user->getGroups();
		$userGroupsIds = array();
		foreach ($userGroups as $group) {
			$userGroupsIds[] = $group->getGroupId();
		}
		return $userGroupsIds;
	}

	/*
	 * Conversion del numero al formato numerico de mysql
	 *
	 * @param string numero con separador de miles y decimal segun la configuracion del sistema
	 * @return string con el formato
	 */
	public static function convertToMysqlNumericFormat($number) {
		global $system;

		$thousandsSeparator = $system['config']['system']['parameters']['thousandsSeparator'];
		$decimalSeparator = $system['config']['system']['parameters']['decimalSeparator'];

		$number = str_replace($thousandsSeparator,'',$number);
		//el separador de decimales en MySQL es punto
		$number = str_replace($decimalSeparator,'.',$number);

		return $number;

	}

	/*
	 * Conversion del fecha al formato numerico de mysql
	 * El mismo tiene en cuenta el formato de fecha interno del sistema
	 * @param string fecha
	 * @return string con el formato
	 */
	public static function convertToMysqlDateFormat($date,$dateFormat='') {
		global $system;

		if (empty($dateFormat))
			$dateFormat = $system['config']['system']['parameters']['dateFormat']['value'];

		$dateFormat = str_replace('y','Y',$dateFormat);
		$formatArray = explode('-',$dateFormat);
		$dateArray = explode('-',$date);
		$orderedDate = array();

		for ($i=0; $i < count($formatArray); $i++)
			$orderedDate[$formatArray[$i]] = $dateArray[$i];

		$mysqlDate =  $orderedDate['Y'] . '-' . $orderedDate['m'] . '-' . $orderedDate['d'];
		return $mysqlDate;
	}

	/*
	 * Conversion del fecha y hora al formato numerico de mysql
	 * El mismo tiene en cuenta el formato de fecha y hora interno del sistema
	 * @param string fecha y hora
	 * @return string con el formato
	 */
	public static function convertToMysqlDatetimeFormat($date, $useTime = true) {
		
		if ($useTime) {
			$mysqlDate = date('Y-m-d H:i:s', strtotime($date));
			$mysqlDate = Common::getDatetimeOnGMT($mysqlDate);
		} else {
			$mysqlDate = date('Y-m-d', strtotime($date));
		}
		return $mysqlDate;
		
//		global $system;
//
//		if (empty($dateFormat))
//			$dateFormat = $system['config']['system']['parameters']['dateFormat']['value'];
//		
//		$dateFormat = str_replace('y','Y',$dateFormat);
//		$formatArray = explode('-',$dateFormat);
//		$dateArray = explode('-',$date);
//		$orderedDate = array();
//
//		for ($i=0; $i < count($formatArray); $i++)
//			$orderedDate[$formatArray[$i]] = $dateArray[$i];
//
//		$mysqlDate =  $orderedDate['Y'] . '-' . $orderedDate['m'] . '-' . $orderedDate['d'];
//		$mysqlDate = Common::getDatetimeOnGMT($mysqlDate);
//		return $mysqlDate;
	}

	/**
	 * Devuelve un datetime en la zona horaria del usuario actual
	 * @param string datetime
	 * @return string datetime en la zona horaria correspondiente al usuario
	 */
	public static function getDatetimeOnTimezone($datetime) {
		require_once('TimezonePeer.php');

		$user = Common::getLoggedUser();
		$method = "getTimezone";

		if (method_exists($user,$method))
			$timezoneCode = $user->getTimezone();

		if (empty($timezoneCode) || $timezoneCode == "") {
			//si no hubiera o no fuera un usuario administrador tomamos default de la aplicacion
			global $system;
			$timezoneCode = $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"];

			if ($timezoneCode == null)
				$timezoneCode = 0;
		}
		$timezonePeer = new TimezonePeer();
		return $timezonePeer->getGMT0TimeOnTimezone($datetime,$timezoneCode);
	}

	/**
	 * Devuelve un datetime en la zona horaria GMT
	 * @param string datetime
	 * @return string datetime en la zona horaria GMT
	 */
	public static function getDatetimeOnGMT($datetime) {
		require_once('TimezonePeer.php');

		$user = Common::getLoggedUser();
		$method = "getTimezone";

		if (method_exists($user,$method))
			$timezoneCode = $user->getTimezone();

		if (empty($timezoneCode) || $timezoneCode == "") {
			//si no hubiera o no fuera un usuario administrador tomamos default de la aplicacion
			global $system;
			$timezoneCode = $system["config"]["system"]["parameters"]["applicationTimeZoneGMT"]["value"];
			if ($timezoneCode == null)
				$timezoneCode = 0;
		}

		$timezonePeer = new TimezonePeer();
		return $timezonePeer->getGMT0DatetimeFromTimezone($datetime,$timezoneCode);
	}

	/**
	 * Valida el captcha
	 * @return boolean
	 */
	public static function validateCaptcha($field) {
		if (empty($_SESSION['security_code']))
			return false;
		if ($field == $_SESSION['security_code']) {
			unset($_SESSION['security_code']);
			return true;
		}
		return false;
	}

	/**
	 * Valida si una direccion de email tiene estructura valida
	 * @param string email a validar
	 */
	public static function validateEmail($email) {
		return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email);
	}

	/*
	 * Verifica si un email existe.
	 *
	 * @param string $email Email destino
	 * @param string $mailAddress Email origen
	 * @return boolean false si no existe, true si puede llegar a existir
	 */
	public static function verifyMailbox($email,$mailAddress="no-reply@no-mail.com") {
		$before = microtime();
		$err = false;
		if (!preg_match('/([^\@]+)\@(.+)$/', $email, $matches)) {
			 return false;
		}
		$user = $matches[1]; $domain = $matches[2];
		if(!function_exists('checkdnsrr'))
			return $err;
		if(!function_exists('getmxrr'))
			return $err;
		// Get MX Records to find smtp servers handling this domain
		if(getmxrr($domain, $mxhosts, $mxweight)) {
			for($i=0;$i<count($mxhosts);$i++){
				$mxs[$mxhosts[$i]] = $mxweight[$i];
			}
			asort($mxs);
			$mailers = array_keys($mxs);
		} elseif(checkdnsrr($domain, 'A')) {
			$mailers[0] = gethostbyname($domain);
		} else {
			return false;
		}
		// Try to send to each mailserver
		$total = count($mailers);
		$ok = 0;
		for($n=0; $n < $total; $n++) {
			$timeout = 5;
			$errno = 0; $errstr = 0;
			if(!($sock = fsockopen($mailers[$n], 25, $errno , $errstr, $timeout))) {
				continue;
			}
			$response = fgets($sock);
			stream_set_timeout($sock, 5);
			$meta = stream_get_meta_data($sock);
			$cmds = array(
				"HELO ".$_SERVER["SERVER_NAME"],
				"MAIL FROM: <$mailAddress>",
				"RCPT TO: <$email>",
				"QUIT",
			);
			if(!$meta['timed_out'] && !preg_match('/^2\d\d[ -]/', $response)) {
				break;
			}
			$success_ok = 1;
			foreach($cmds as $cmd) {
				fputs($sock, "$cmd\r\n");
				$response = fgets($sock, 4096);
				if(!$meta['timed_out'] && preg_match('/^5\d\d[ -]/', $response)) {
					$success_ok = 0;
					break;
				}
			}
			fclose($sock);
			if($success_ok){
				$ok = 1;
				break;
			}
		}
		$after = microtime();
		// Fail on error
		if(!$ok)
			return false;
		// Return a positive value on success
		return true;
	}

	/*
	 * Devuelve el nombre corto del sistema
	 * @return string nombre corto del sistema
	 */
	public static function getSiteShortName() {
		global $system;
		return $system['config']['system']['parameters']['siteShortName'];
	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	public static function getRowsPerPage($module) {
		if (!empty($module)) {
			$perPage = ConfigModule::get($module,"rowsPerPage");
			if (!empty($perPage))
				return $perPage;
			else {
				$moduleConfiguration = Common::getModuleConfiguration($module);
				$perPage = $moduleConfiguration['rowsPerPage'];
				if (!empty($perPage))
					return $perPage;
			}
		}
		global $system;
		return $system['config']['system']['rowsPerPage'];
	}

	/**
	 * Obtiene los parametros de configuracion de un modulo
	 *
	 * @param string modulo con separador de miles y decimal segun la configuracion del sistema
	 * @return array asociativo con los valores de configuracion del modulo
	 */
	public static function getModuleConfiguration($module) {
		global $system;
		$moduleConfig = $system['config'][strtolower($module)];
		return $moduleConfig;
	}

	/**
	 * getConfiguration
	 * Obtiene los parametros de configuracion de un modulo
	 * @param string modulo con separador de miles y decimal segun la configuracion del sistema
	 * @return array asociativo con los valores de configuracion del modulo
	 */
	public static function getConfiguration($section) {
		global $system;
		$config = $system['config'][strtolower($section)];
		return $config;
	}

	/**
	 * Obtiene el valor de la opcion de login de la cookie
	 * @return string El valor correspondiente o vacio si no esta seteada la cookie
	 */
	public static function getValueUnifiedLoginCookie() {
		global $system;
		$cookieName = $system["config"]["system"]["parameters"]['siteShortName'] . 'LoginOption';
		return $_COOKIE[$cookieName];
	}

	/**
	 * Define el valor de la opcion de login de la cookie
	 */
	public static function setValueUnifiedLoginCookie($value) {
		global $system;
		$cookieName = $system["config"]["system"]["parameters"]['siteShortName'] . 'LoginOption';
		setcookie($cookieName,$value);
	}

	/**
	* Obtiene los idiomas disponibles en el sistema.
	* @return Idiomas del sistema
	*/
	public static function getAllLanguages() {
		$languages = MultilangLanguageQuery::create()->find();
		return $languages;
	}

	/**
	 * Entrega la traduccion de un texto a partir del modulo y el idioma que use el sistema
	 * @param string $text				El texto a traducir
	 * @param string $moduleName  Nombre del modulo al que pertenece el texto
	 * @return translation
	 */
	public static function getTranslation($text,$moduleName) {
		$languageCode = Common::getCurrentLanguageCode();
		$translationObject = MultilangTextPeer::getByTextAndModuleNameAndCode($text,$moduleName,$languageCode);
		if (empty($translationObject))
			$translation = $text;
		else
			$translation = $translationObject->getText();
		return $translation;
	}

	/**
	 * Entrega la traduccion de un texto a partir del modulo y codigo de idioma
	 * @param string $text				El texto a traducir
	 * @param string $moduleName  Nombre del modulo al que pertenece el texto
	 * @param string $languagecode	Codigo del idioma en el que se quiere el la traduccion
	 * @return translation
	 */
	public static function getTranslationByLanguageCode($text,$moduleName,$languageCode) {
		$translationObject = MultilangTextPeer::getByTextAndModuleNameAndCode($text,$moduleName,$languageCode);
		if (empty($translationObject))
			$translation = $text;
		else
			$translation = $translationObject->getText();
		return $translation;
	}

	/**
	 * Entrega la traduccion de un array con texto a partir del modulo y el idioma que use el sistema
	 * @param string $array				El array con texto a traducir
	 * @param string $moduleName  Nombre del modulo al que pertenece el texto
	 * @return translation
	 */
	public static function getTranslatedArray($inputArray,$moduleName) {
		foreach(array_keys($inputArray) as $key)
			$translated[$key] = Common::getTranslation($inputArray[$key],$moduleName);
		return $translated;
	}

	/**
	 * Entrega el codigo de idioma a utilizar por el sistema
	 * @return languageCode
	 */
	public static function getCurrentLanguageCode() {
		global $system;

		$cookieName = $system["config"]["system"]["parameters"]['siteShortName'] . 'languageCode';
		if (isset($_COOKIE[$cookieName]))
			$currentLanguageCode = $_COOKIE[$cookieName];
		else
			$currentLanguageCode = $system["config"]["system"]["language"];
		if (isset($_SESSION['user']['languageCode']))
			$currentLanguageCode = $_SESSION['user']['languageCode'];
		if (isset($_SESSION['languageCode']))
			$currentLanguageCode = $_SESSION['languageCode'];

		return $currentLanguageCode;
	}

	/**
	 * Entrega el codigo de idioma por defecto del sistema
	 * @return languageCode
	 */
	public static function getSystemDefaultLanguageCode() {
		global $system;
		return $system["config"]["system"]["language"];
	}

	/**
	 * Entrega el locale
	 * @return locale
	 */
	public static function getCurrentLocale() {
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$language = MultilangLanguageQuery::create()->findOneByCode($currentLanguageCode);
		if (is_object($language))
			return $language->getLocale();
		else
			return;
	}

	/**
	 * Indica si el los pedidos de cotizaciones manejan cantidades en el modulo import
	 * @return boolean
	 */
	public static function setCurrentLanguageCode($languageCode) {
		global $system;
		$cookieName = $system["config"]["system"]["parameters"]['siteShortName'] . 'languageCode';
		setcookie($cookieName,$languageCode);

		$_SESSION['languageCode'] = $languageCode;
	}

	/**
	 * Indica si un request proviene de un robot de google.
	 * @return boolean
	 */
	public static function isAGoogleBotRequest() {
		if(stripos($_SERVER['HTTP_REFERER'], '.google.') !== false && preg_match('{^[a-z]+://[^.]*\.google\.}i', $_SERVER['HTTP_USER_AGENT']))
			return true;
		if(stripos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false) {
			$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			if(stripos($host, 'googlebot') !== false)
				return true;

		}
		return false;
	}

	/**
	 * Indica si un request proviene de un robot.
	 * @return boolean
	 */
	public static function isBot() {
		//if no	user agent is	supplied then	assume it's	a	bot
		if($_SERVER['HTTP_USER_AGENT'] ==	"")
			return true;

		//array	of bot strings to	check	for
		$bot_strings = Array(	 "google",		 "bot",
							"yahoo",		 "spider",
							"archiver",		"curl",
							"python",			"nambu",
							"twitt",		 "perl",
							"sphere",			"PEAR",
							"java",			"wordpress",
							"radian",			"crawl",
							"yandex",			"eventbox",
							"monitor",	 "mechanize",
							"facebookexternal"
						);
		foreach($bot_strings as	$bot)
			if(strpos($_SERVER['HTTP_USER_AGENT'],$bot)	!==	false)
				return true;

		return false;
	}

	/**
	* getBrowser
	* Obtiene las especificaciones del Browser
	* @return array con nombre del browser y version
	*/
	public static function getBrowser(){
		require_once("Browser.php");

		$browser = new Browser();
		return $browser;
	}

	/**
	* morphObject
	* Guarda un objeto de una clase a partir de otro de una clase distinta
	* @param object fromObj Objeto de origen
	* @param object toObj Objeto de destino
	* @return boolean si se pudo guardar el objeto de destino
	*/
	public static function morphObject($fromObj,$toObj)	{
		$peer = $fromObj->getPeer();
		$fieldNames = $peer->getFieldNames(BasePeer::TYPE_PHPNAME);
		foreach ($fieldNames as $fieldName) {
			$setMethod = "set".$fieldName;
			$getMethod = "get".$fieldName;
			if (method_exists($fromObj,$getMethod) && method_exists($toObj,$setMethod)) {
				$value = $fromObj->$getMethod();
				if (!empty($value) || $value == "0")
					$toObj->$setMethod($value);
				else
					$toObj->$setMethod(null);
			}
		}
		try {
			$toObj->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* morphObjectValues
	* Asigna los valores comunes de un objeto de una clase a partir de otro de una clase distinta
	* @param object fromObj Objeto de origen
	* @param object toObj Objeto de destino
	* @return object el objecto con los valores comunes copiados
	*/
	public static function morphObjectValues($fromObj,$toObj){
		$peer = $fromObj->getPeer();
		$fieldNames = $peer->getFieldNames(BasePeer::TYPE_PHPNAME);
		foreach ($fieldNames as $fieldName) {
			$setMethod = "set".$fieldName;
			$getMethod = "get".$fieldName;
			if (method_exists($fromObj,$getMethod) && method_exists($toObj,$setMethod)) {
				$value = $fromObj->$getMethod();
				$currentValue = $toObj->$getMethod();
				if ($currentValue != $value) {
					if (!empty($value) || $value == "0")
						$toObj->$setMethod($value);
					else
						$toObj->$setMethod(null);
				}
			}
		}
		return $toObj;
	}

	/**
	* Actualiza timestamp de modificacion y contador de cambios
	*
	* @param object $object Objeto a setear
	* @return true
	*/
	public static function preUpdate($object) {
		//Ya se hace en el setObjectFromParams
		//$object->setUpdated(time());
		//$object->setLastModification(time());
		//$changes = $object->getChanges() + 1;
		//$object->setChanges($changes);
		return true;
	}

	/**
	* Genera objecto de log y lo guarda
	*
	* @param object $object Objeto a setear
	* @return true
	*/
	public static function postUpdate($object) {
		if ($object->hasToLog() && $object->getToLog() != null) {
			$objectLog = $object->getToLog();
			$objectLog->setId(NULL);
			$setMethod = "set".get_class($object)."Id";
			$objectLog->$setMethod($object->getId());
			$objectLog->setUpdated(time());
			try {
				$objectLog->save();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
	}

	/**
	* Setea el objeto a loguear
	* @param object $object Objeto a setear
	* @param array $objectParams Valores
	* @return Object
	*/
	public static function setObjectToLog($object,$objectParams) {
		$logClassName = get_class($object) . 'Log';
		//Solo guardo el log si hasToLog devuelve true, ademas de que existan todo los metodos necesarios de logueo
		if (method_exists($object, 'hasToLog') && $object->hasToLog() && class_exists($logClassName) && method_exists($object, 'setToLog')) {
			//seteo el parametro de cambio menor
			if (method_exists($object, 'setMinorChange'))
				$object->setMinorChange($objectParams['minorChange']);
			$objectLog = new $logClassName;
			Common::morphObjectValues($object, $objectLog);
			$object->setToLog($objectLog);
		}
	}

	/**
	* Setea valores a un objeto a partir de un array de valores de sus atributos
	* @param object $object Objeto a setear
	* @param array $objectParams Valores
	* @return Object
	*/
	public static function setObjectFromParams($object,$objectParams) {
		Common::setObjectToLog($object,$objectParams);

		foreach ($objectParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {
				$getMethod = "get".$key;
				$currentValue = $object->$getMethod();

				if ($currentValue != $value) {
					if (!empty($value) || $value == "0")
						$object->$setMethod($value);
					else
						$object->$setMethod(null);
				}
			}
		}

		if (method_exists($object, 'setUserObjectType') && method_exists($object, 'setUserObjectId')) {
			$user = Common::getCurrentUser();
			if (is_object($user)) {
				$object->setUserObjectType(get_class($user));
				$object->setUserObjectId($user->getId());
			}
		}

		if (method_exists($object, 'setUpdated'))
			$object->setUpdated(time());

		if (method_exists($object, 'setChanges') && !$object->isNew()) {
			$changes = $object->getChanges() + 1;
			$object->setChanges($changes);
		}

		return $object;
	}

	/**
	* Setea valores a un objeto a partir de un array de valores de sus atributos
	*
	* @param object $object Objeto a setear
	* @param array $objectParams Valores
	* @return Object
	*/
	public static function setNestedSetObjectFromParams($object,$objectParams,$parentNode = NULL) {
		if (method_exists($object, 'hasToLog')) {
			if (method_exists($object, 'setMinorChange'))
				$object->setMinorChange($objectParams['minorChange']);
			$logClassName = get_class($object) . 'Log';
			if ($object->hasToLog() && class_exists($logClassName) && method_exists($object, 'setToLog')) {
				$objectLog = new $logClassName;
				Common::morphObjectValues($object, $objectLog);
				$object->setToLog($objectLog);
			}
		}

		foreach ($objectParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($object,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$object->$setMethod($value);
				else
					$object->$setMethod(null);
			}
		}

		if (is_null($parentNode) && $object->isNew()){
			$queryClass = get_class($object) . 'Query';
			$queryInstance = new $queryClass;
			$lastScope = $queryInstance->orderByScope(Criteria::DESC)->findOne();
			if (!empty($lastScope))
				$scope = $lastScope->getScope() + 1;
			else
				$scope = 0;
			$object->setScope($scope);
			$object->makeRoot();
		}
		else if ($object->isNew())
			$object->insertAsLastChildOf($parentNode);

		if (method_exists($object, 'setUserObjectType') && method_exists($object, 'setUserObjectId')) {
			$user = Common::getCurrentUser();
			if (is_object($user)) {
				$object->setUserObjectType(get_class($user));
				$object->setUserObjectId($user->getId());
			}
		}

		if (method_exists($object, 'setUpdated'))
			$object->setUpdated(time());

		if (method_exists($object, 'setChanges') && !$object->isNew()) {
			$changes = $object->getChanges() + 1;
			$object->setChanges($changes);
		}

		return $object;
	}

	/**
	* Genera una nueva contrasena aleatoria.
	*
	* @param int $length [optional] Longitud de la contrasena
	* @return string Contrasena
	*/
	public static function generateRandomPassword($length = 8){
		$password = "";
		$possible = "23456789@bcdefghijkmnopqrstuvwxyz";
		$i = 0;
		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			if (!strstr($password, $char)) {
				$password .= $char;
				$i++;
			}
		}
		return $password;
	}

	/**
	* Determina el tamano maximo de archivo a subir
	* @return int tamano del archivo en MB
	*/
	public static function maxUploadSize() {
		$max_upload_size = min(Common::let_to_num(ini_get('post_max_size')),
		 Common::let_to_num(ini_get('upload_max_filesize')),
		 Common::let_to_num(ConfigModule::get("documents","maxUploadSize")));
		return ($max_upload_size/(1024*1024));
	}

	/**
	* Encripta md5
	* @return string encriptado
	*/
	public static function md5($pass) {
		$crypt = md5($pass."ASD");
		return $crypt;
	}

	/**
	* This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
	*
	* @param int $v string Parametro con valor y unidad
	* @return int longitud del parametro
	*/

	public static function let_to_num($v){ //
			$l = substr($v, -1);
			$ret = substr($v, 0, -1);
			switch(strtoupper($l)){
			case 'P':
					$ret *= 1024;
			case 'T':
					$ret *= 1024;
			case 'G':
					$ret *= 1024;
			case 'M':
					$ret *= 1024;
			case 'K':
					$ret *= 1024;
					break;
			}
			return $ret;
	}

	/**
	 * Hace un explode transformando un string en un array asociativo
	 *
	 * @usage $str="key1=val1&key2=val2&key3=val3";
	 * 		  $array=explode_assoc('=','&',$str);
	 * @return $array
	 * @param $glue1 separador clave/valor.
	 * @param $glue2 separador entre elementos.
	 * @param $input string con la cadena para hacer el explode
	 */
	public static function explode_assoc($glue1, $glue2, $input) {
		$array2 = explode($glue2, $input);
		foreach($array2 as  $val) {
			$pos=strpos($val,$glue1);
			$key=substr($val,0,$pos);
			$array3[$key] = substr($val,$pos+1,strlen($val));
		}
		return $array3;
	}

	/**
	 * Convert a string to camel case, optionally capitalizing the first char and optionally setting which characters are
	 * acceptable.
	 * @param  string  $str              text to convert to camel case.
	 * @param  bool    $capitalizeFirst  optional. whether to capitalize the first chare (e.g. "camelCase" vs. "CamelCase").
	 * @param  string  $allowed          optional. regex of the chars to allow in the final string
	 *
	 * @return string camel cased result
	 *
	 * @author Sean P. O. MacCath-Moran   www.emanaton.com
	 */
	public static function strtocamel($str, $capitalizeFirst = true, $allowed = 'A-Za-z0-9') {
		return preg_replace(
				array(
						'/([A-Z][a-z])/e', // all occurances of caps followed by lowers
						'/([a-zA-Z])([a-zA-Z]*)/e', // all occurances of words w/ first char captured separately
						'/[^'.$allowed.']+/e', // all non allowed chars (non alpha numerics, by default)
						'/^([a-zA-Z])/e' // first alpha char
				),
				array(
						'" ".$1', // add spaces
						'strtoupper("$1").strtolower("$2")', // capitalize first, lower the rest
						'', // delete undesired chars
						'strto'.($capitalizeFirst ? 'upper' : 'lower').'("$1")' // force first char to upper or lower
				),
				$str
		);
	}

	/**
	 * Pluralizes a string.
	 *
	 * @param $string input singular string.
	 * @return pluralized string
	 *
	 * @author Paul Osman
	 */
	public static function pluralize( $string ) {
		$plural = array(
				array( '/(quiz)$/i',               "$1zes"   ),
				array( '/^(ox)$/i',                "$1en"    ),
				array( '/([m|l])ouse$/i',          "$1ice"   ),
				array( '/(matr|vert|ind)ix|ex$/i', "$1ices"  ),
				array( '/(x|ch|ss|sh)$/i',         "$1es"    ),
				array( '/([^aeiouy]|qu)y$/i',      "$1ies"   ),
				array( '/([^aeiouy]|qu)ies$/i',    "$1y"     ),
				array( '/(hive)$/i',               "$1s"     ),
				array( '/(?:([^f])fe|([lr])f)$/i', "$1$2ves" ),
				array( '/sis$/i',                  "ses"     ),
				array( '/([ti])um$/i',             "$1a"     ),
				array( '/(buffal|tomat)o$/i',      "$1oes"   ),
				array( '/(bu)s$/i',                "$1ses"   ),
				array( '/(alias|status)$/i',       "$1es"    ),
				array( '/(octop|vir)us$/i',        "$1i"     ),
				array( '/(ax|test)is$/i',          "$1es"    ),
				array( '/s$/i',                    "s"       ),
				array( '/$/',                      "s"       )
		);

		$irregular = array(
				array( 'move',   'moves'    ),
				array( 'sex',    'sexes'    ),
				array( 'child',  'children' ),
				array( 'man',    'men'      ),
				array( 'person', 'people'   )
		);

		$uncountable = array(
				'sheep',
				'fish',
				'series',
				'species',
				'money',
				'rice',
				'information',
				'equipment'
		);

		// save some time in the case that singular and plural are the same
		if ( in_array( strtolower( $string ), $uncountable ) )
			return $string;

		// check for irregular singular forms
		foreach ( $irregular as $noun ) {
			if ( strtolower( $string ) == $noun[0] )
				return $noun[1];
		}

		// check for matches using regular expressions
		foreach ( $plural as $pattern ) {
			if ( preg_match( $pattern[0], $string ) )
					return preg_replace( $pattern[0], $pattern[1], $string );
		}

		return $string;
	}

	/**
	 * Asigna parametros a smarty
	 * @param $smarty instancia de smarty
	 * @param $params array with parameters with key and value
	 * @param $filters array de filtros
	 * @return smarty con filtros y params asignados
	 */
	public static function assignParamsAndFiltersToSmarty($smarty,$params,$filters) {

		foreach ($params as $key => $value)
			$smarty->assign("$key",$value);

		$smarty->assign("filters",$filters);
		return $smarty;
	}

	/**
	 * Obtiene todos los elementos de un Peer dada su criterio de busqueda
	 * paginados segun los parametros de pagina y elementos por pagina
	 * @param $peer instancia del Peer de elementos a buscar
	 * @param $page int numero de pagina
	 * @param $perPage int cantidad de elementos por pagina
	 * @return pager
	 */
	public static function getAllPaginatedFiltered($peer, $page=1, $perPage=-1) {
		if ($perPage == -1)
			$perPage = 	Common::getRowsPerPage();
		if (empty($page))
			$page = 1;

		$criteria = $peer->getSearchCriteria();
		$pager = $criteria->paginate($page,$perPage);
		return $pager;
	}

	/**
	 * Evalua dos numeros a bit level para comprobar permisos
	 * @param $level int
	 * @param $bitlevel int
	 * @return true o false
	 */
	public static function evaluateBitlevel($level,$bitlevel) {
		if ($level == SecurityModule::LEVEL_ALL)
			return ($bitlevel == $level);
		return ((intval($level) & intval($bitlevel)) > 0);
	}

	/**
	* Genera un array con los parametros de fecha desde hasta
	*
	* @return array dechas max y min
	*/
	public static function getPeriodArray($fromDate = null, $toDate = null, $useTime = true) {
		if (!empty($fromDate))
			$fromDate = Common::convertToMysqlDatetimeFormat($fromDate, $useTime);
		if (!empty($toDate)) {
			$toDate = Common::convertToMysqlDatetimeFormat($toDate, $useTime);
			if ($useTime)
				$toDate = date('Y-m-d H:i:s', strtotime($toDate.' + 1 day - 1 second'));
		}

		$periodArray = array();
		if (!empty($fromDate))
			$periodArray["min"] = $fromDate;
		if (!empty($toDate))
			$periodArray["max"] = $toDate;

		return empty($periodArray) ? null : $periodArray;
	}

	/**
	 * Indica si el usuario es proveedor
	 */
	function isSupplier() {
		if (!isset($_SESSION['loginUser']))
			return false;
		$user = $_SESSION['loginUser'];
		return $user->isSupplier();
	}

	/**
	 * Obtiene el id del proveedor
	 */
	function getSupplierUserId() {
		$user = $_SESSION["loginUser"];
		return $user->getId();
	}

	/**
	 * Indica si el sistema tiene activo el modulo de newsletter.
	 * @return boolean
	 */
	public static function systemHasNewsletter() {
		if ((ConfigModule::get("registration","newsletterSubscription")) && (ModulePeer::hasNewslettersModule()))
			return true;
		else
			return false;
	}

	/**
	 * Devuelve el modo de registracion habilitado en el Modulo de Registracion por
	 * la configuracion.
	 */
	public static function getRegistrationMode() {
		global $system;
		return $system["config"]["registration"]["mode"]["value"];
	}

	/**
	 * Obtiene el formato de fecha expresado como para un DatePicker a partir de la configuración local.
	 */
	public static function getDatePickerDateFormat() {
		global $system;
		$dateFormat = $system['config']['system']['parameters']['dateFormat']['value'];
		return strtolower(str_replace("-", "", $dateFormat));
	}

	/**
	 * Devuelve si la validacion por captcha esta habilitada en la configuracion
	 * del modulo de registracion
	 * @return boolean
	 */
	public static function getRegistrationCaptchaUse() {
		global $system;
		return ($system["config"]["registration"]["useCaptcha"]["value"] == 'YES');

	}

	/**
	 * Devuelve si la validacion por captcha esta habilitada en la configuracion
	 * del modulo de encuestas
	 * @return boolean
	 */
	public static function getSurveysCaptchaUse() {
		global $system;
		return ($system["config"]["surveys"]["useCaptcha"]["value"] == 'YES');
	}

	/**
	 * Indica si el los pedidos de cotizaciones manejan cantidades en el modulo import
	 * @return boolean
	 */
	public static function importQuotesUseQuantities() {
		if (ConfigModule::get("import","quotesUseQuantities"))
			return true;
		else
			return false;
	}

	/**
	 * Returns true if $path has write permissions or false otherwise
	 *
	 * @param string $path
	 * @return boolean
	 */
	public static function isWritable($path) {
		$testfile = $path.'/'.uniqid().'.test';
		file_put_contents($testfile, 'asd');
		$return = file_exists($testfile);
		unlink($testfile);
		return $return;
	}

	/**
	 * Returns true if $path has write permissions or false otherwise
	 *
	 * @param string $path
	 * @return boolean
	 */
	public static function ensureWritable($path) {
		$parts = split('/', $path);
		$dirBefore = '';
		foreach ($parts as $part) {
			$dirAfter = $dirBefore.$part.'/';
			if (!file_exists($dirAfter)) {
				mkdir($dirAfter);
				if (!file_exists($dirAfter)) {
					$msg = "el directorio $path no existe. creacion automatica fallo: no se puede escribir en $dirBefore, verifique permisos";
					throw new Exception($msg);
				}
			}
			$dirBefore = $dirAfter;
		}
		if (!Common::isWritable($dirBefore)) {
			throw new Exception("no se puede escribir en $dirBefore, verifique permisos");
		}

		return;
	}
	
/* Chequeo fallas login y seguridad al solicitar acciones no permitidas */

	/**
	* Obtiene la ip del cliente
	*
	* @return ip
	*/
	public static function getIp() {
		
		$client  = $_SERVER['HTTP_CLIENT_IP'];
		$forward = $_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}
		return $ip;

	}
	/**
	* Guarda una falla al solicitar login
	*
	* @param string $username nombre de usuario
	* @param string $password clave ingresada
	* @return void
	*/
	public static function loginFailure($username, $password, $objectType) {
		
		$queryClass = $objectType . 'Query';
		$user = $queryClass::create()->findOneByUsername($username);

		$remoteIp = Common::getIp();
		$ipBlocked = Common::checkLoginIpFailures($remoteIp);
		$userId = $user->getId();
		$userBlocked = Common::checkLoginUserFailures($objectType, $userId);
		if ($ipBlocked || $userBlocked)
			$blocked = true;

		try {
				$loginFailure = new LoginFailure();
				$loginFailure->setAttemptAt(time());
				$loginFailure->setUsername($username);
				$loginFailure->setPassword($password);
				$loginFailure->setObjectType($objectType);
				$loginFailure->setObjectId($userId);
				$loginFailure->setIp($remoteIp);
				$loginFailure->setBlocked($blocked);
				$loginFailure->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}

	}

	/**
	* Informa si se bloqua una Ip por fallas de login
	*
	* @param string $remoteIp ip de intento fallido de login
	* @return true si bloqueo la ip, false si no la bloqueo
	* Testeada
	*/
	public static function checkLoginIpFailures($remoteIp) {

		$loginFailureThreshold = ConfigModule::get("users","loginFailureThreshold");
		$loginFailureThresholdTime = ConfigModule::get("users","loginFailureThresholdTime");
		$loginFailureBlockedTimeTime = ConfigModule::get("users","loginFailureBlockedTimeTime");

		$loginFailureThresholdTimeArray = array('min' => time() - ($loginFailureThresholdTime * 60));

		$ipLoginFailures = LoginFailureQuery::create()
				->filterByIp($remoteIp)
				->filterByAttemptat($loginFailureThresholdTimeArray)->count();

		if ($ipLoginFailures > $loginFailureThreshold) {
			try {
				$blockedIp = new BlockedIp();
				$blockedIp->setIp($remoteIp);
				$blockedIp->setBlockedAt(time());
				$blockedIp->setUnblocked(false);
				$blockedIp->save();
				return true;
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
		return false;
	}

	/**
	* Informa si se bloqua un usuario por fallas de login
	*
	* @param string $objectType tipo de usuario intento fallido de login
	* @param string $objectId id de usuario fallido de login
	* @return true si bloqueo el usuario, false si no lo bloqueo
	*/
	public static function checkLoginUserFailures($objectType, $objectId) {

		$loginFailureThreshold = ConfigModule::get("users","loginFailureThreshold");
		$loginFailureThresholdTime = ConfigModule::get("users","loginFailureThresholdTime");
		$loginFailureBlockedTimeTime = ConfigModule::get("users","loginFailureBlockedTimeTime");
		
		$loginFailureThresholdTimeArray = array('min' => time() - ($loginFailureThresholdTime * 60));
		
		$userLoginFailures = LoginFailureQuery::create()
				->filterByObjecttype($objectType)->filterByObjectid($objectId)
				->filterByAttemptat($loginFailureThresholdTimeArray)->count();
				
		$remoteIp = Common::getIp();
				
		$ipLoginFailures = LoginFailureQuery::create()
				->filterByIp($remoteIp)
				->filterByAttemptat($loginFailureThresholdTimeArray)->count();
				
		//return $userLoginFailures;

		if ($userLoginFailures > $loginFailureThreshold) {
			try {
				Common::blockUser($objectType, $objectId);
				$blockedUser = new BlockedUser();
				$blockedUser->setObjecttype($objectType);
				$blockedUser->setObjectid($objectId);
				$blockedUser->setUnblocked(false);
				$blockedUser->save();
				return true;
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
		return false;
	}

	/**
	* Guarda una falla al solicitar acciones o permitidas
	*
	* @param object $user usuario solitante de la accion
	* @param string $action  accion solicitada
	* @return void
	*/
	public static function securityFailure($user, $action) {

		$userBlocked = Common::checkSecurityUserFailures($objectType, $objectId);

		try {
			$securityFailure = new SecurityFailure();
			$securityFailure->setObjecttype(get_class($user));
			$securityFailure->setObjectid($user->getId());
			$securityFailure->setAaction($action);
			$securityFailure->setAttemptAt(time());
			$securityFailure->setIp($_SERVER["REMOTE_ADDR"]);
			$securityFailure->setBlocked($userBlocked);
			$securityFailure->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}
	}

	/**
	* Informa si se bloqua un usuario pro solicitar acciones no permitidas
	*
	* @param string $objectType tipo de usuario intento accion no permitida
	* @param string $objectId id de usuario fallido de accion no permitida
	* @return true si bloqueo el usuario, false si no lo bloqueo
	*/
	public static function checkSecurityUserFailures($objectType, $objectId) {

		$securityFailureThreshold = ConfigModule::get("global","securityFailureThreshold");
		$securityFailureThresholdTime = ConfigModule::get("global","securityFailureThresholdTime");
		$securityFailureBlockedTime = ConfigModule::get("global","securityFailureBlockedTime");

		$securityFailureThresholdTimeArray = array('min' => time() - ($securityFailureThresholdTime * 60));

		$securityFailures = SecurityFailureQuery::create()
				->filterByObjecttype($objectType)->filterByObjectid($objectId)
				->filterByAttemptat($securityFailureThresholdTimeArray)->count();

		if ($securityFailures > $securityFailureThreshold) {
			try {
				Common::blockUser($objectType, $objectId);
				$blockedUser = new BlockedUser();
				$blockedUser->setObjecttype($objectType);
				$blockedUser->setObjectid($objectId);
				$blockedUser->save();
				return true;
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
		}
		return false;
	}

	/**
	* Bloqua un usuario
	*
	* @param string $objectType tipo de usuario a bloquar
	* @param string $objectId id de usuario a bloquar
	* @return true si bloqueo el usuario, false si no lo bloqueo
	*/
	public static function blockUser($objectType, $objectId) {

		$queryClass = $objectType . "Query";
		$user = $queryClass::create()->findOneById($objectId);
		try {
			$user->setBlockedat(date("Y-m-d h:i:s"));
			$user->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}
		return false;
	}

	/**
	* Desbloquea un usuario
	*
	* @param string $objectType tipo de usuario a desbloquar
	* @param string $objectId id de usuario a desbloquar
	* @return true si desbloqueo el usuario, false si no lo desbloqueo
	*/
	public static function unblockUser($objectType, $objectId) {

		$queryClass = $objectType . "Query";
		$user = $queryClass::create()->findOneById($objectId);
		try {
			$user->setBlockedat(NULL);
			$user->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
		}
		return false;
	}
	
	public static function isBlockedUser($userName) {
		
		$usernameExists = Common::getByUsername($userName);
		
		if (!empty($usernameExists)) { //Si existe el username
			$objectType = get_class($usernameExists);
			$queryClass = $objectType . "Query";
			$user = $queryClass::create()->findOneByUsername($userName);
			if($user->getBlockedAt())
				return true;
			else
				return false;
		}
	
	}

	/**
	* Devuelve un array con los dias primero y ultimo del mes de una fecha determinada
	*
	* @param string $anyDate fecha de referencia en formato yyyy-mm-dd
	* @return arry valores first y last correspondientes al primer y ultimo dia del mes de la fecha de referencia
	*/
	public static function findFirstAndLastDay($anyDate) {
		//$anyDate        = '2009-08-25';								// date format should be yyyy-mm-dd
		list($yr,$mn,$dt) = split('-',$anyDate);				// separate year, month and date
		$timeStamp        = mktime(0,0,0,$mn,1,$yr);		//Create time stamp of the first day from the give date.
		$firstDay         = date('Y-m-d',$timeStamp);		//get first day of the given month
		list($y,$m,$t)    = split('-',date('Y-m-t',$timeStamp));	//Find the last date of the month and separating it
		$lastDayTimeStamp = mktime(0,0,0,$m,$t,$y);								//create time stamp of the last date of the give month
		$lastDay          = date('Y-m-d',$lastDayTimeStamp);			// Find last day of the month
		$arrDay           = array("first" => $firstDay, "last" => $lastDay);	// return the result in an array format.
		return $arrDay;
	}

} // end of class
