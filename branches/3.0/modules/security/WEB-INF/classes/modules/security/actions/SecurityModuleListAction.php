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
class SecurityModuleListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityModuleListAction() {
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

		//////////
		// linea de test por ahora, sacar luego		
		//SecurityActionPeer::checkAccess(SecurityActionPeer::userInfoToSecurity(),'modulesList');


		//obtengo todos los niveles con bitlevel mayor al del usuario logueado
		$levels = LevelPeer::getAllWithBitLevelGreaterThan($userLevel['levelId']);

		//contiene un nivel a comparar, equivalente a 2¨30 -1
		$levelSave=1073741823;


		$smarty->assign("levelsave",$levelSave);
		$smarty->assign("modules",$modules);
		$smarty->assign("levels",$levels);
		$smarty->assign("userLevel",$userLevel['levelId']);


		//////////
		// array de tipos de usuarios
		$userTypes= array();
		$userTypes[1]['type']='Users';
		$userTypes[1]['bitUser']=1;
		$userTypes[2]['type']='Users By Affiliate';
		$userTypes[2]['bitUser']=2;
		$userTypes[3]['type']='Users By Registration';
		$userTypes[3]['bitUser']=4;


		$smarty->assign("userTypes",$userTypes);

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');



	}

}
