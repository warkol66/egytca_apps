<?php
/**
* BaseAction
*
* $author Modulos Empresarios / Egytca
* @package phpMVCconfig
* @public
*/

include_once("Include.inc.php");
include_once("TimezonePeer.php");
include_once("TableroDependencyPeer.php");
include_once("Common.class.php");
include_once("Action.php");
require_once("Smarty_config.inc.php");

/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* $author Modulos Empresarios / Egytca
* @package phpMVCconfig
* @public
*/
class BaseAction extends Action {

	// ----- Constructor ---------------------------------------------------- //

	function BaseAction() {
		;
	}

	function getDependencyId() {
		if (Common::isAffiliatedUser())
			$dependencyId = Common::getAffiliatedId();
		else {
			if (!empty($_GET["dependencyId"]))
				$dependencyId = $_GET["dependencyId"];
			else {
				if (!empty($_GET["objectiveId"])) {
					require_once("TableroObjectivePeer.php");
					$objective = TableroObjectivePeer::get($_GET["objectiveId"]);
					$dependencyId = $objective->getAffiliateId();
				}
				if (!empty($_GET["projectId"])) {
					require_once("TableroProjectPeer.php");
					require_once("TableroObjectivePeer.php");
					$project = TableroProjectPeer::get($_GET["projectId"]);
					$objective = $project->getTableroObjective();
					$dependencyId = $objective->getAffiliateId();
				}
			}
		}
		return $dependencyId;
	}

	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/

	function execute($mapping, $form, &$request, &$response) {

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		setlocale(LC_ALL, Common::getCurrentLocale());
		$GLOBALS['_NG_LANGUAGE_'] =& $smarty->language;

		//Tiene Prioriodad si se pasa el lenguage en el request.
		//Analizar si es necesario agregar luego control de GoogleBot
		if (!empty($_REQUEST['lang'])) {
			$GLOBALS['_NG_LANGUAGE_']->setCurrentLanguage($_REQUEST['lang']);
			Common::setCurrentLanguageCode($_REQUEST['lang']);
		}
		else {
			if (!empty($GLOBALS['_NG_LANGUAGE_']))
				$GLOBALS['_NG_LANGUAGE_']->setCurrentLanguage(Common::getCurrentLanguageCode());
		}

		$smarty->assign('configModule', new ConfigModule());
		$smarty->assign('actualAction', $_REQUEST['do']);

		$_SERVER['FULL_URL'] = 'http';
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')
				$_SERVER['FULL_URL'] .=  's';
		$_SERVER['FULL_URL'] .=  '://';
		$serverPort = "";
		if($_SERVER['SERVER_PORT']!='80')
			$serverPort = ":" . $_SERVER['SERVER_PORT'];

		$systemUrl = $_SERVER['FULL_URL'].$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'],0,strrpos($_SERVER['REQUEST_URI'],"/")).$serverPort."/Main.php";
		$smarty->assign("systemUrl",$systemUrl);
		$scriptPath = substr($_SERVER['PHP_SELF'], 0, (strlen($_SERVER['PHP_SELF']) -8 - @strlen($_SERVER['PATH_INFO'])));
		$smarty->assign('scriptPath',$scriptPath);

		if (Common::inMaintenance()) {
			header("Location: Main.php?do=commonMaintenance");
			exit;
		}
		$actionRequested = $request->getAttribute('ACTION_DO_PATH');
		//Se obtienen modulo y accion solicitada
		//$actionRequested = $_REQUEST["do"];

		if (preg_match('/^([a-z]*)[A-Z]/',$actionRequested,$regs))
			$moduleRequested = $regs[1];
		if (empty($moduleRequested) && $actionRequested == "js")
			$moduleRequested = "common";
		
		$smarty->assign("module",$moduleRequested);
		
		if (isset($_SESSION["loginUser"]) && is_object($_SESSION["loginUser"]) && get_class($_SESSION["loginUser"]) == "User")
			$loginUser = $_SESSION["loginUser"];
		if (isset($_SESSION["loginAffiliateUser"]) && is_object($_SESSION["loginAffiliateUser"]) && get_class($_SESSION["loginAffiliateUser"]) == "AffiliateUser")
			$loginUserAffiliate = $_SESSION["loginAffiliateUser"];
		if (isset($_SESSION["loginRegistrationUser"]) && is_object($_SESSION["loginRegistrationUser"]) && get_class($_SESSION["loginRegistrationUser"]) == "RegistrationUser")
			$loginRegistrationUser = $_SESSION["loginRegistrationUser"];

		$securityAction = SecurityActionPeer::getByNameOrPair($actionRequested);
		$securityModule = SecurityModulePeer::get($moduleRequested);

		//Controlo las acciones y modulos que no requieren login
		//Si no se requiere login $noCheckLogin va a ser igual a 1
		$noCheckLogin = 1;
		if (!empty($securityAction))
			$noCheckLogin = $securityAction->getOverallNoCheckLogin();
		else if (!empty($securityModule))
			$noCheckLogin = $securityModule->getNoCheckLogin();
		else
			$noCheckLogin = 0;

		if (ConfigModule::get("global","noCheckLogin"))
			$noCheckLogin = 1;

		header("Content-type: text/html; charset=UTF-8");

		if (!$noCheckLogin) { //Verifica login $noCheckLogin != 1
			if (!empty($loginUser) || !empty($loginUserAffiliate) || !empty($loginRegistrationUser)) {

				if (!ConfigModule::get("global","noSecurity")) {

					if (!empty($loginUser))
						$user = $loginUser;
					else if (!empty($loginUserAffiliate))
						$user = $loginUserAffiliate;
					else if (!empty($loginRegistrationUser))
						$user = $loginRegistrationUser;

					if (!empty($user))
						$userLevel = $user->getLevel();

					if (!empty($securityAction))
						$access = $securityAction->getAccessByUser($user);
					else if (!empty($securityModule))
						$access = $securityModule->getAccessByUser($user);

					if (!empty($securityAction) || !empty($securityModule)) {
					}
				}
				else {//No verifica seguridad
				}
			}
			else { //Si requiere login y no hay sesion va a login
				global $loginPath;
				header("Location:Main.php?do=$loginPath");
				exit();
			}
		}
		else { // No verifica login
		}

		if (!empty($loginUserAffiliate))
			$smarty->assign("affiliateId",$loginUserAffiliate->getAffiliateId());

		if (isset($loginUser))
			$smarty->assign("loginUser",$loginUser);
		if (isset($loginUserAffiliate))
			$smarty->assign("loginAffiliateUser",$loginUserAffiliate);
		if (isset($loginRegistrationUser))
			$smarty->assign("loginRegistrationUser",$loginRegistrationUser);

		$smarty->assign("currentLanguageCode",Common::getCurrentLanguageCode());

		$smarty->assign("browser",Common::getBrowser());
		$smarty->assign("isBot",Common::isBot());

		$smarty->assign("mapping",$mapping);

		$this->template = new SmartyOutputFilter();
		$smarty->register_outputfilter(array($this->template,"smarty_add_template"));
		
		if ($this->isAjax()) {
			$this->template->template = 'TemplateAjax.tpl';
			$smarty->assign("isAjax", true);
		}

		$systemParameters = Common::getModuleConfiguration("system");
		$smarty->assign("parameters",$systemParameters["parameters"]);
		$smarty->assign("SESSION",$_SESSION);

		if (!empty($GLOBALS['_NG_LANGUAGE_']))
			$smarty->register_outputfilter("smarty_outputfilter_i18n");

		$smarty->assign("languagesAvailable",common::getAllLanguages());

	} //End execute

	/**
	 * Agrega parametros al url de un forward
	 * @param $params array with parameters with key and value
	 * @param $mapping
	 * @param $forwardName nombre del forward que se quiere modificar de ese mapping
	 */
	function addParamsToForwards($params,$mapping,$forwardName) {

		$myRedirectConfig = $mapping->findForwardConfig($forwardName);
		$myRedirectPath = $myRedirectConfig->getpath();

		foreach ($params as $key => $value)
			$myRedirectPath .= "&$key=$value";

		return new ForwardConfig($myRedirectPath, True);

	}
	/**
	 * Agrega parametros al url de un forward
	 * @param $params array with parameters with key and value
	 * @param $mapping
	 * @param $forwardName nombre del forward que se quiere modificar de ese mapping
	 */
	function addFiltersToForwards($params,$mapping,$forwardName) {

		$myRedirectConfig = $mapping->findForwardConfig($forwardName);
		$myRedirectPath = $myRedirectConfig->getpath();

		foreach ($params as $key => $value)
			$myRedirectPath .= "&filters[$key]=$value";

		return new ForwardConfig($myRedirectPath, True);

	}

	/**
	 * Agrega parametros al url de un forward
	 * @param $params array with parameters with key and value
	 * @param $mapping
	 * @param $forwardName nombre del forward que se quiere modificar de ese mapping
	 */
	function addParamsAndFiltersToForwards($params,$filters,$mapping,$forwardName) {

		$myRedirectConfig = $mapping->findForwardConfig($forwardName);
		$myRedirectPath = $myRedirectConfig->getpath();

		foreach ($params as $key => $value)
			$myRedirectPath .= "&$key=$value";

		foreach ($filters as $key => $value)
			$myRedirectPath .= "&filters[$key]=$value";

		return new ForwardConfig($myRedirectPath, True);

	}

	/**
	 * Realiza el procesamiento de filtros sobre una clase Peer de Propel
	 * @param Class $peer instancia de clase peer de propel
	 * @param array $filterValuer valores de filtro a verificar, los metodos de set en la clase peer deben tener antepuesto a estos nombres, 'set'
	 * @param $smarty instancia de smarty sobre la cual se esta trabajando (tener en cuenta que al trabajar con una referencia a smarty, no hay problema de pasaje por parametro)
	 */
	function applyFilters($peer,$filters,$smarty = '') {
		if (!empty($smarty))
			$smarty->assign('filters',$filters);
		foreach(array_keys($peer->filterConditions) as $filterKey)
			if (isset($filters[$filterKey])) {
				$filterMethod = $peer->filterConditions[$filterKey];
				$peer->$filterMethod($filters[$filterKey]);
			}

		return $peer;
	}
	
	/**
	 * Consulta la base de datos y obtiene la información básica que generalmente es requerida por una vista de formulario
	 * sencilla de una entidad. Tener en cuenta que la entidad propiamente dicha debe ser asignada por separado.
	 * 
	 * En la vista quedan accesibles las instancias de entidades relacionadas con sus respectivos nombres pluralizados.
	 * Además se asigna el nombre tentativo del formulario que contiene la vista a incluir si se trata de un formulario embutido.
	 * 
	 * @param $objectClassName nombre de la clase php de la entidad.
	 * @param $smarty instancia de smarty sobre la cual se esta trabajando (tener en cuenta que al trabajar con una referencia a smarty, no hay problema de pasaje por parametro)
	 */
	function prepareEmbeddedForm($objectClassName, $smarty) {
		$objectPeerName = $objectClassName . 'Peer';
		if (class_exists($objectPeerName)) {
			$tableMap = call_user_func(array($objectPeerName, 'getTableMap'));
			$objectPackageName = $tableMap->getPackage();
			$objectModuleName = ucwords(preg_replace('/.classes$/', '', $objectPackageName));
			$pluralizedObjectClassName = Common::pluralize($tableMap->getClassName());
			if ($objectModuleName != $pluralizedObjectClassName) {
				$formTemplateName = $objectModuleName . $pluralizedObjectClassName . 'Form.tpl';
			} else {
				$formTemplateName = $pluralizedObjectClassName . 'Form.tpl';
			}
			$smarty->assign('formTemplateName', $formTemplateName);
			$relations = $tableMap->getRelations();
			foreach ($relations as $relation) {
				if ($relation->getType() == RelationMap::MANY_TO_ONE) {
					$foreignTable = $relation->getForeignTable();
					$foreignEntityName = $foreignTable->getClassName();
					$foreignPeerClassName = $foreignTable->getPeerClassName();
					if (method_exists($foreignPeerClassName, 'getAll')) {
						$foreignEntities = call_user_func(array($foreignPeerClassName, 'getAll'));
					}
					$pluralizedEntityName = Common::pluralize(Common::strtocamel($foreignEntityName, false));
					$smarty->assign($pluralizedEntityName, $foreignEntities);
				}
			}
		}
	}

	public function isAjax() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
	}
}

