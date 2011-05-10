<?php

require_once("BaseAction.php");
require_once("CircuitPeer.php");require_once("ThemePeer.php");
require_once("ClientPeer.php");

class LausiDistributeByCircuitPercentageAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiDistributeByCircuitPercentageAction() {
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

		if ($_POST['actionType'] == 'ajax') {
			//por ser una action ajax.		
			$this->template->template = "template_ajax.tpl";
			$smarty->assign('ajax',true);			
		}

		$module = "Lausi";
		$smarty->assign("module",$module);
				
		//obtenemos todas las regiones y motivos
		$themes = ThemePeer::getAllActive();
		$circuits = CircuitPeer::getAll();
		
		$smarty->assign('themes',$themes);		
		$smarty->assign('circuits',$circuits);
		$smarty->assign('clients',ClientPeer::getAll());

		if (isset($_POST['themeId']))
			$smarty->assign('themeId',$_POST['themeId']);

		return $mapping->findForwardConfig('success');
	}

}
