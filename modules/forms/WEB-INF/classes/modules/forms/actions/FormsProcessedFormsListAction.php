<?php

require_once("BaseAction.php");
require_once("FormPeer.php");
require_once("ProcessedFormPeer.php");

class FormsProcessedFormsListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function FormsProcessedFormsListAction() {
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

		$module = "Forms";
		$smarty->assign("module",$module);
		$section = "ProcessedForms";
		$smarty->assign("section",$section);				

		$forms = FormPeer::getAll();
		$smarty->assign("forms",$forms);
		

		$processedFormPeer = new ProcessedFormPeer();

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate'])) {
				$processedFormPeer->setFromDate(Common::convertToMysqlDatetimeFormat($_GET['filters']['fromDate']));
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$processedFormPeer->setToDate(Common::convertToMysqlDatetimeFormat($_GET['filters']['toDate']));
			}
			
			if (!empty($_GET['filters']['formId'])) {
				$form = FormPeer::get($_GET['filters']['formId']);
				$processedFormPeer->setForm($form);			
			}
			
			$smarty->assign('filters',$_GET['filters']);
		}

		$pager = $processedFormPeer->getAllPaginatedFiltered($_GET["page"]);
 
		$smarty->assign("processedforms",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=formsProcessedFormsList";

		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);		
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}

