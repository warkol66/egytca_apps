<?php

require_once("BaseAction.php");

class IndicatorsCategoryListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function IndicatorsCategoryListAction() {
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

		$module = "Indicators";
		$smarty->assign("module",$module);
		$section = "Categories";
		$smarty->assign("section",$section);

		$indicatorCategoryPeer = new IndicatorCategoryPeer();

		if (isset($_GET['filters']))
			$this->applyFilters($actorCategoryPeer,$_GET['filters'],$smarty);

		$pager = $indicatorCategoryPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("categories",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=indicatorsCategoryList";

		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";

		$smarty->assign("url",$url);
		$smarty->assign("message",$_GET["message"]);
		return $mapping->findForwardConfig('success');
	}

}


