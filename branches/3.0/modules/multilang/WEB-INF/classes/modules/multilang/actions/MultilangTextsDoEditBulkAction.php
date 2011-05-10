<?php

require_once("BaseAction.php");
require_once("MultilangLanguagePeer.php");

class MultilangTextsDoEditBulkAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function MultilangTextsDoEditBulksAction() {
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

		$modulo = "Multilang";
		
    	$appLanguages = MultilangLanguagePeer::getAll();
		$appLanguagesCount = count($appLanguages);	
		
		$traductions = array();
		$i = 0;
		$j = 0;
		$traduction = array();
		foreach ($_POST["text"] as $item) {
			//los primeros $appLanguagesCount son del div oculto
			if ($i >= $appLanguagesCount) {
				foreach ($item as $languageCode => $text) {	
					$traduction[$languageCode] = $text;
				}
				$j++;
				//Cuando complete todas las traducciones de un texto, debo guardar el conjunto en $traductions
				if ($j == $appLanguagesCount) {
					$traductions[] = $traduction; 
					$traduction = array();
					$j = 0;	
				}
			}
			$i++;
		}
		
		foreach ($traductions as $traduction) {
			$i=0;
			foreach ($traduction as $languageCode => $text) {
				if ($i==0)
					$id = MultilangTextPeer::create($_POST["moduleName"],$languageCode,$text);
				else
	      			MultilangTextPeer::createWithId($id,$_POST["moduleName"],$languageCode,$text);
				$i++;
			}	
		}
		
		/*
		if ( $_POST["action"] == "edit" ) {
			//estoy editando un text existente

			foreach ($_POST["text"] as $languageId => $text)
				MultilangTextPeer::update($_POST["id"],$_POST["moduleName"],$languageId,$text);

		} else {
			//estoy creando un nuevo text
			$i=0;
			foreach ($_POST["text"] as $languageId => $text) {
				if ($i==0)
					$id = MultilangTextPeer::create($_POST["moduleName"],$languageId,$text);
				else
          			MultilangTextPeer::createWithId($id,$_POST["moduleName"],$languageId,$text);
				$i++;
			}
		}
		*/

		header("Location: Main.php?do=multilangTextsList&moduleName=".$_POST["moduleName"]."&page=".$_POST["currentPage"]);
		exit;
		
		return $mapping->findForwardConfig('success');		
	}

}
