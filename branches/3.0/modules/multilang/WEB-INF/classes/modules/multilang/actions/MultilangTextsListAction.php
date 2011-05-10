<?php

require_once("BaseAction.php");
require_once("MultilangLanguagePeer.php");

class MultilangTextsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function MultilangTextsListAction() {
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

		$module = "Multilang";
		$smarty->assign('module',$module);

		$smarty->assign('modulePeer',new ModulePeer());		
				
		$textsPerPage = Common::getRowsPerPage();
		
    	$appLanguages = MultilangLanguagePeer::getAll();
    	$smarty->assign("appLanguages",$appLanguages);

		//asigno todo los modulos posibles para que se pueda seleccionar
		$modules = ModulePeer::getAll();
		$smarty->assign('modules',$modules);
		
		$smarty->assign("moduleName",$_GET["moduleName"]);

		$perPage = $textsPerPage*count($appLanguages);

		if (empty($_GET["search"])) {
			$pager = MultilangTextPeer::getAllOrderedPaginated($_GET["moduleName"],$_GET["page"],$perPage);

			$alls = $pager->getResult();

			$allsOrdered = array();
			foreach ($alls as $text) {
				$allsOrdered[$text->getId()][$text->getLanguageCode()] = $text;
			}
			$url = "Main.php?do=multilangTextsList&moduleName=".$_GET["moduleName"];
		}
		else {
			$pager = MultilangTextPeer::searchPaginated($_GET["moduleName"],$_GET["languageCode"],$_GET["search"],$_GET["page"],$perPage);
			$allsOrdered = $pager->getResult();
			
			$smarty->assign("search",$_GET["search"]);
			$url = "Main.php?do=multilangTextsList&moduleName=".$_GET["moduleName"]."&languageCode=".$_GET["languageCode"]."&search=".$_GET["search"];
		}

    $smarty->assign("texts",$allsOrdered);
    $smarty->assign("pager",$pager);
    
    $smarty->assign("url",$url);

	$searchLanguage = MultilangLanguagePeer::getLanguageByCode($_GET["languageCode"]);
	$smarty->assign("searchLanguage",$searchLanguage);

    $smarty->assign("message",$_GET["message"]);

    if (empty($_GET["search"]))
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('search');
	}

}

