<?php



require_once("BaseAction.php");
require_once("SecurityActionPeer.php");
require_once("SecurityModulePeer.php");

class	SecurityModuleDoSaveAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityModuleDoSaveAction() {
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
		$section = "";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		// contiene todos los modulos
		$modules=$_POST["modules"];


		//Cabe destacar que igualmente los nuevos accesos vienen en $_POST["activeaction"];
		foreach($modules as $module)
			SecurityModulePeer::clearAccess($module,$baseLevel);


		//contiene todos los actions que fueron seteados para que cualquiera tenga permiso
		$levelmin=$_POST["all"];

		//contiene todos los actions que fueron checkeados en la vista
		$modules=$_POST["activeModule"];

		/**
		* Divido una matriz en cada parte para poder luego enviar a la base de datos lo que necesito
		* Me fijo mediante checkboxes enviados, el nivel de permiso que tendrá un determinado action y
		* lo actualizo en la base de datos.
		* $level va sumando los niveles de permiso que tendrá ese action
		* $key contendrá el nombre del action que almacena la matriz
		*/
		foreach ($modules as  $key=> $activeModules) {
			$level=0;
			foreach($activeModules as $activeModule) {
				$level+=$activeModule;
  		}
			SecurityModulePeer::setNewAccess($key,$level);
		}

		/*
		* me fijo si el action lo podrá acceder cualquier grupo de usuario
		* si es asi, seteo el acceso a ese action como 2¨30-1
		* actualmente el sistema permite cargar no más de 30 grupos de usuarios o de lo contrario este metodo no funciona
		*/
		$levelAll=1073741823;

		foreach($levelmin as $levelModule) {
			foreach ($modules as $moduleName => $moduleInfo) {
				if (strcmp($levelModule,$moduleName)==0)	{
					//echo "module es $moduleName y el otro es $levelModule";
					SecurityModulePeer::setNewAccess($moduleName,$levelAll);
				}
			}
		}

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');
	}

}
?>
