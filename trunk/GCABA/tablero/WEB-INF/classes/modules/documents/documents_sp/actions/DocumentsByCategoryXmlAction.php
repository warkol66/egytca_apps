<?php
/**
* DocumentsByCategoryXmlAction
*
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("DocumentPeer.php");
require_once("CategoryPeer.php");

class DocumentsByCategoryXmlAction extends DocumentsBaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function OrdersExportAction() {
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

		$this->template->template = "TemplateEmpty.tpl";	

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);
		

		global $system;

		$xmlRootCategory = $system['config']['documents']['xmlRootCategory'];
		$smarty->assign("xmlRootCategory",$xmlRootCategory);

		$categoryPeer = new CategoryPeer();
		$category = $categoryPeer->get($xmlRootCategory);
		$partialCategories = $category->getChildrenPublicCategories($xmlRootCategory);
		
		$smarty->assign('category',$category);
		$smarty->assign('partialCategories',$partialCategories);

		header ("content-type: text/xml; charset=utf-8");

		return $mapping->findForwardConfig('success');

	}

}
