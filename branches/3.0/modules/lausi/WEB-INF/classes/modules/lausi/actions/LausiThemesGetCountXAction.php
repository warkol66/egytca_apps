<?php

class LausiThemesGetCountXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiThemesGetCountXAction() {
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
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Themes";
		$smarty->assign("section",$section);		

    	$theme = ThemePeer::get($_POST["themeId"]);
		$count = $theme->getSheetsDistributed();
		$pendingCount = $theme->getSheetsToBeDistributed();
		
		//asignamos el theme para customizar la interfaz segun sextuple o doble.
		$smarty->assign('theme',$theme);
		
		$smarty->assign('count',$count);
		$smarty->assign('pendingCount',$pendingCount);
		
		if ($_POST['circuit']) {
			//obtengo los totales por circuito 
			$circuits = CircuitPeer::getAll();
			$result = array();
			foreach ($circuits as $circuit) {
				$result[$circuit->getId()]['sheetsDistributed'] = $circuit->getSheetsDistributed($_POST['themeId']);
				$result[$circuit->getId()]['billboardsAvailable'] = $circuit->getAvailableTodayCount($theme);
			}
			
		}
		
		
		if ($_POST['region']) {
			//obtengo los totales por circuito 
			$regions = RegionPeer::getAll();
			$result = array();
			foreach ($regions as $region) {
				$result[$region->getId()]['sheetsDistributed'] = $region->getSheetsDistributed($_POST['themeId']);
				$result[$region->getId()]['billboardsAvailable'] = $region->getAvailableTodayCount($theme);
			}
		}
		
		if (isset($result))
			$smarty->assign('result',$result);

		return $mapping->findForwardConfig('success');

	}

}