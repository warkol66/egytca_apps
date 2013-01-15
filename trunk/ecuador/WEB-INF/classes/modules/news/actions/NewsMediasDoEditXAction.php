<?php

class NewsMediasDoEditXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('NewsMedia');
	}
	
	protected function postUpdate() {
		parent::postUpdate();
		
		$this->smarty->assign("module","News");
		$section = "Media";
		$this->smarty->assign("section",$section);
		
		//si el tipo es imagen
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_IMAGE && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createImages($this->entity,$_FILES['document_file'],$this->entity->getId());
		//si el tipo es video
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_VIDEO && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createVideo($this->entity,$_FILES['document_file'],$this->entity->getId() . ".flv"); 
		//si el tipo es audio
		if ($_POST["params"]["mediaType"] == NewsMedia::NEWSMEDIA_SOUND && !empty($_FILES["document_file"]['tmp_name']))
			NewsMedia::createSound($_FILES['document_file'],$this->entity->getId() . ".mp3"); 

		
		/* Ver esto*/
		global $system;
  
		$saveOriginalFiles = $system["config"]["news"]["medias"]["saveOriginalFiles"]["value"];

		if ($saveOriginalFiles == "YES")
		  copy($file["tmp_name"],$destPath);
		
	}

/*
	// ----- Constructor ---------------------------------------------------- //

	function NewsMediasDoEditXAction() {
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
		$section = "Media";
		$smarty->assign("section",$section);				

		//por ser un action ajax
		$this->template->template = 'TemplateAjax.tpl';
		
		//obtenemos las variables del request
		list($code,$id) = explode('_',$_POST['editorId']);
		$value = $_POST['value'];
		
		
		$newsMedia = NewsMediaPeer::get($id);
		
		if ($code == 'descriptionEdit') {
			//estamos editando la descripcion
			try {
				$newsMedia->setDescription($value);
				$newsMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}

		if ($code == 'titleEdit') {
			//estamos editando el titulo
			try {
				$newsMedia->setTitle($value);
				$newsMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}
	
		//seteamos la respuesta de smarty
		$smarty->assign('value',$value);
	
		return $mapping->findForwardConfig('success');
	}*/

}
