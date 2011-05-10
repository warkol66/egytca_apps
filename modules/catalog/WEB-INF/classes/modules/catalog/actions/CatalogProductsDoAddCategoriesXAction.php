<?php

class CatalogProductsDoAddCategoriesXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CatalogProductsDoAddCategoriesXAction() {
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
		$this->template->template = "TemplateAjax.tpl";
		
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
   	$smarty->assign("module",$module);
    
    $productId = $_POST['productId'];
    $categoryId = $_POST['categoryId'];
      
    $product = ProductPeer::get($productId);
    $category = CategoryPeer::get($categoryId);
    
    if (!empty($product) && !empty($category) && $category->getModule() == 'catalog') {
      $product->addCategory($category);
      $product->save();
      $product->reload(true);  //Necesario para que considere todas las categorias y no solo la agregada recientemente.
      $smarty->assign('message', 'success');
      $smarty->assign('product', $product);
    } else $smarty->assign('message', 'failure');
    
		return $mapping->findForwardConfig('success');
	}
}