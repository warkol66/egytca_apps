<?php
/**
* BaseAction
*
* $author Modulos Empresarios / Egytca
* @package phpMVCconfig
* @public
*/

include_once 'Action.php';
include_once("includes/common.inc.php");
include_once("includes/Paginado.class.php");
require_once("SecurityActionPeer.php");
require_once("GroupPeer.php");

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
		// Verifica la existencia de la sesi?n, si no existe rediecciona a Login
	 /* if (!estaLogueado() && $_REQUEST['do']!='login')
		{

			?>
		
			<script>
				window.location.href='Main.php?do=login'
			</script>
			<?
		}
		 */
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$GLOBALS['_NG_LANGUAGE_'] =& $smarty->language;
		if (!empty($GLOBALS['_NG_LANGUAGE_'])) {
			global $system;
			$GLOBALS['_NG_LANGUAGE_']->setCurrentLanguage($system["config"]["mluse"]["language"]);
		}

		header("Content-type: text/html; charset=UTF-8");

		$noCheckLogin = array();
		$noCheckLogin[] = "index";
		$noCheckLogin[] = "usersLogin";
		$noCheckLogin[] = "usersDoLogin";
		$noCheckLogin[] = "noPermission";
		$noCheckLogin[] = "htmlsShow";

		$isUnrestrictedAction = array_search($_REQUEST["do"],$noCheckLogin);

		if ( empty($_SESSION["login_user"]) && $isUnrestrictedAction === false ) {
			header("Location: Main.php?do=usersLogin");
			exit;
		}

		$user = $_SESSION["login_user"];

		//Chequeo de permisos de acceso
/*		if (!empty($user)) {

			$action = SecurityActionPeer::get($_REQUEST["do"]);

			if (empty($action)) {
				header("Location:Main.php?do=noPermission");
				exit();
			}

			$accessAction = $action->getAccess();
			$level = $user->getLevel();

			if ( empty($level) || ($level->getBitLevel() & $accessAction) == 0 ) {
				header("Location:Main.php?do=noPermission");
				exit();
			}
		}
*/

//////////// Verificación de permisos desabilitada

		if (!empty($user)) {
			$level = $user->getLevel();
		}

		$smarty->assign("login_user",$user);
		$smarty->assign("STATUSLOGIN",$login);
		$smarty->assign("LOGIN",$_SESSION['usuario']);
		$smarty->assign("SESION", $_SESSION);
		$smarty->assign('BROWSER',getBrowser());

		$this->template = new SmartyOutputFilter();
		$smarty->register_outputfilter(array($this->template,"smarty_add_template"));

		if (!empty($GLOBALS['_NG_LANGUAGE_']))
			$smarty->register_outputfilter("smarty_outputfilter_i18n");
	}
}
?>
