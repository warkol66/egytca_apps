<?php

class CategoriesListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CategoriesListAction() {
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

		$module = "Categories";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$categoryPeer = new CategoryPeer();
    $smarty->assign("categoryPeer",$categoryPeer);
    
    $this->applyFilters($categoryPeer, $_GET['filters'], $smarty);
		
    $user = $_SESSION["loginUser"];
		
    $categories = $categoryPeer->getAllByUserFiltered($user);
    $smarty->assign("userCategories",$categories);
		$parentCategories = $categoryPeer->getAllParentsByUserFiltered($user);
		$smarty->assign("parentUserCategories",$parentCategories);
	    
		//categoria para select de modulos
		$modules = ModulePeer::getAllWithCategories();
		$smarty->assign('modules',$modules);
		
		$moduleObj = ModulePeer::get($_GET['filters']['searchModule']);
		$smarty->assign('moduleObj',$moduleObj);
	
    $smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}
}
