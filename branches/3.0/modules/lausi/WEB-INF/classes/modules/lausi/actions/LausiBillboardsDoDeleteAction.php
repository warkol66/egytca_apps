<?php

class LausiBillboardsDoDeleteAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiBillboardsDoDeleteAction() {
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
		$section = "Billboards";
		$smarty->assign("section",$section);		

		//caso de eliminacion de varias carteleras
		if (isset($_POST['toDelete']) && !empty($_POST['toDelete']) && count($_POST['toDelete'])) {
			BillboardPeer::delete($_POST['toDelete']);
		} else {
			BillboardPeer::delete($_POST["id"]);
		}
		
		if ($this->isAjax()) {
			$smarty->assign('billboardId',$_POST["id"]);
			return $mapping->findForwardConfig('success-ajax');
		}
		
		//caso de redireccionamiento desde opciones de busqueda de addressesList
		if (isset($_POST['listRedirect'])) {
			$queryData = "";
			//armamos la redireccion con los valores necesarios
			foreach ($_POST['listRedirect'] as $key => $value) {
				$queryData .= "&listRedirect[$key]=$value";
			}
		}

		return $this->addParamsToForwards(array('addressId'=>$billboard->getAddressId()), $mapping, 'success');
	}
}
