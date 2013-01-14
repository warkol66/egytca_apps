<?php

class NewsMediasUploadAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('NewsMedia');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		
	}
	
	protected function postSave() {
		parent::postSave();
		
		$destPath = NewsMedia::getSavePath($this->entity->getMediaType());
		$destPath .= $this->entity->getId();

		//si el tipo es imagen
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_IMAGE && !empty($file['tmp_name']))
		NewsMedia::createImages($this->entity,$file,$this->entity->getId()); 
		//si el tipo es video
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_VIDEO && !empty($file['tmp_name']))
		NewsMedia::createVideo($this->entity,$file,$this->entity->getId().".flv"); 
		//si el tipo es audio
		if ($params["mediaType"] == NewsMedia::NEWSMEDIA_SOUND && !empty($file['tmp_name']))
		NewsMedia::createSound($this->entity,$file,$this->entity->getId().".mp3"); 

		
		/* Ver esto
		global $system;
  
		$saveOriginalFiles = $system["config"]["news"]["medias"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
		  return copy($file["tmp_name"],$destPath);
		}*/

	}

/*
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
	*
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


	}*/

}
