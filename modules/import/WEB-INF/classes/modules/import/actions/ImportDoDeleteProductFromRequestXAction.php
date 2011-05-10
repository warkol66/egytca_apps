<?php

require_once("BaseAction.php");
require_once("RequestPeer.php");
require_once("ProductPeer.php");
require_once("ProductRequestPeer.php");

class ImportDoDeleteProductFromRequestXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportDoDeleteProductFromRequestXAction() {
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
		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";
		
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Import";
		$smarty->assign('module',$module);
		
		if (empty($_GET['productReqId'])) {
			//error de validacion
			return $mapping->findForwardConfig('failure');
		}
		

		if (!productRequestPeer::delete($_GET['productReqId']))  {
			//no se pudo eliminar					
			return $mapping->findForwardConfig('failure');
		}
		
		//asignamos el id eliminado para quitarlo de la vista		
		$smarty->assign('productReqId',$_GET['productReqId']);
		$smarty->assign('message',"deleted");
		return $mapping->findForwardConfig('success');

	}

}
?>
