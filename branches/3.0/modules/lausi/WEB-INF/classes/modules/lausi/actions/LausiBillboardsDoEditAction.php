<?php

class LausiBillboardsDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiBillboardsDoEditAction() {
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
		
		$params = $_POST['billboard'];	

		if ( !empty($_POST["id"]) ) {
			//estoy editando un billboard existente
			$billboard = BillboardPeer::get($_POST["id"]);
			
			$redirectParams = array();
      		//caso de redireccionamiento desde opciones de busqueda de addressesList
			if (isset($_POST['listRedirect'])) {
				$redirectParams = $_POST['listRedirect'];
			}	
			$redirectParams['addressId'] = $params["addressId"];		
      		
			$myRedirectConfig = $this->addParamsToForwards($redirectParams, $mapping, 'success');
		} else {
			//estoy creando un nuevo billboard
			$billboard = new Billboard;
			$myRedirectConfig = $mapping->findForwardConfig('success');
		}

		Common::setObjectFromParams($billboard, $params);
		
		if (!$billboard->save()) {
			$smarty->assign("addressIdValues",AddressPeer::getAll());
			$smarty->assign("billboard",$billboard);	
			$smarty->assign("action","create");
			$smarty->assign("message","error");
			
			//caso especial desde creacion desde address
			if ($this->isAjax())
				return $mapping->findForwardConfig('failure-ajax');
					
			return $mapping->findForwardConfig('failure');
		}
		
		//caso especial desde creacion desde address
		if ($this->isAjax()) {
			$smarty->assign('billboard',$billboard);
			return $mapping->findForwardConfig('success-ajax');
		}

		return $myRedirectConfig;

	}
}
