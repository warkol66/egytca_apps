<?php



require_once("BaseAction.php");
require_once("mer/SecurityActionPeer.php");


class	SecurityActionDoSaveAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityActionDoSaveAction() {
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

		$module = "Security";
		$section = "action list";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		// contiene todos los actions
		$actions=$_POST["actions"];

		//Obtengo el nivel base del action que debe tener en base al nivel del usuario logueado
		$loginUser=$_SESSION['login_user'];
		$userLevel=$loginUser->getLevelid();
		$baseLevel = 1;
		while ($userLevel > 1) {
			$baseLevel += $userLevel;
			$userLevel = $userLevel / 2;
		}

		//por cada action voy seteando en $baseLevel los accesos
		//Cabe destacar que igualmente los nuevos accesos vienen en $_POST["activeaction"];
		foreach($actions as $act) {
			SecurityActionPeer::clearAccess($act,$baseLevel);
		}

		//contiene todos los actions que fueron seteados para que cualquiera tenga permiso
		$levelmin=$_POST["all"];

		//contiene todos los actions que fueron checkeados en la vista
		$action=$_POST["activeaction"];

		/**
		* Divido una matriz en cada parte para poder luego enviar a la base de datos lo que necesito
		* Me fijo mediante checkboxes enviados, el nivel de permiso que tendrá un determinado action y
		* lo actualizo en la base de datos.
		* $level va sumando los niveles de permiso que tendrá ese action
		* $key contendrá el nombre del action que almacena la matriz
		*/
		foreach ($action as  $key=> $activeaction) {
			$level=0;
			foreach($activeaction as $activeactionlevel) {
				$level+=$activeactionlevel;
  		}
			$level += $baseLevel;
			SecurityActionPeer::setNewAccess($key,$level);
		}

		/*
		* me fijo si el action lo podrá acceder cualquier grupo de usuario
		* si es asi, seteo el acceso a ese action como 2¨30-1
		* actualmente el sistema permite cargar no más de 30 grupos de usuarios o de lo contrario este metodo no funciona
		*/
		$levelAll=1073741823;
		foreach($levelmin as $levelaction) {
			foreach ($actions as $act) {
				if (strcmp($levelaction,$act)==0)	{
					SecurityActionPeer::setNewAccess($act,$levelAll);
				}
			}
		}

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');
	}

}
?>
