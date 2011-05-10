<?php



require_once("BaseAction.php");
require_once("SecurityActionPeer.php");
require_once("LevelPeer.php");

require_once("ModulePeer.php");

/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class SecurityActionListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityActionListAction() {
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

    BaseAction::execute($mapping, $form, $request, $response);
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
		
		//asigno modulo y seccion
		$modulo = "Security";
		$section = "";

		$smarty->assign("modulo",$modulo);
		$smarty->assign("section",$section);

		$modules=ModulePeer::getAll();
		
		
		//////////
		// nuevo metodo para obtener la clase de usuario y su nivel
		$userLevel=SecurityActionPeer::userInfoToSecurity();

		if(isset($_GET["module"])) {
			if($_GET["module"]!='todos'){
				$actions = SecurityActionPeer::getAllByModuleAndBitLevel($_GET["module"],$userLevel['levelId']);
				$moduleView=$_GET["module"];
			}
			else {
				//obtengo todos los actions de la base de datos y los envio al smarty
				$actions = SecurityActionPeer::getAllByBitLevel($userLevel['levelId']);
				$moduleView=$_GET["module"];
			}
		}	
		else {
			//obtengo todos los actions de la base de datos y los envio al smarty
			$actions = SecurityActionPeer::getAllByBitLevel($userLevel['levelId']);
			$moduleView='todos';
		}

		//obtengo todos los niveles con bitlevel mayor al del usuario logueado
    $levels = LevelPeer::getAllWithBitLevelGreaterThan($userLevel['levelId']);

		//contiene un nivel a comparar, equivalente a 2¨30 -1
		$levelSave=1073741823;


		$smarty->assign("actions",$actions);
		$smarty->assign("levelsave",$levelSave);
		$smarty->assign("modulesName",$modules);
		$smarty->assign("moduleView",$moduleView);
		$smarty->assign("levels",$levels);
		$smarty->assign("userLevel",$userLevel['levelId']);

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');



	}

}
?>
