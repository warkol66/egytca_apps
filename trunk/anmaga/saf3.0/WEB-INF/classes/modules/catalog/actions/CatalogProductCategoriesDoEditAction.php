<?php

class CatalogProductCategoriesDoEditAction extends BaseAction {

	function CatalogProductCategoriesDoEditAction() {
		;
	}

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

		$module = "Catalog";
    $smarty->assign("module",$module);

		$moduleSection = "ProductCategories";
    $smarty->assign("moduleSection",$section);
    
    $categoryParams = $_POST['category'];
    $categoryParams['image'] = $_FILES['image'];

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un productcategory existente

			ProductCategoryPeer::update($_POST["id"], $categoryParams);
      return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo productcategory

      if ( !ProductCategoryPeer::create($categoryParams) ) {
				$smarty->assign("id",$_POST["id"]);
				$smarty->assign("description",$_POST["description"]);
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $mapping->findForwardConfig('failure');
      }

			return $mapping->findForwardConfig('success');
		}

	}

}
