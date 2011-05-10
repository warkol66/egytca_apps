<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("NewsMediaPeer.php");

class NewsMediasUploadAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsMediasUploadAction() {
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

		$module = "News";
		$smarty->assign("module",$module);

		if (empty($_POST['newsmedia'])) {
			$status = false;
		}
		else {
			//estoy creando un nuevo newsmedia	
			//tomamos como nombre de archivo el del archivo recibido
			$_POST['newsmedia']['name'] = $_FILES['media']['name'];
			$status = NewsMediaPeer::create($_POST['newsmedia'],$_FILES['media']);
		}
   
		if ($status) {
			echo "Archivo Recibido";
			exit(0);
		}
		else {
			//header("HTTP/1.1 500 Internal Server Error");
			echo "Error al subir el archivo";
			exit(0);
		}	


	}

}