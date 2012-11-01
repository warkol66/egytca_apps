<?php

require_once("BaseAction.php");
require_once("CategoryPeer.php");
require_once("ModulePeer.php");

class CategoriesEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CategoriesEditAction() {
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

    if ( !empty($_GET["id"]) ) {
			//voy a editar un category

			$category = $categoryPeer->get($_GET["id"]);

			if (Common::isAffiliatedUser()) {			
				$user = Common::getAffiliatedLogged();
			}
			
			if (Common::isAdmin()) {
					$user = Common::getAdminLogged();
			}

			$parentCategories = $categoryPeer->getAllParentsByUserAndModule($user,$category->getModule());
			$smarty->assign("parentUserCategories",$parentCategories);

			//categorias para select de categorias padre
			$categories = $user->getCategoriesByModule($category->getModule());
			$smarty->assign('categories',$categories);

			//categoria para select de modulos
			$modules = ModulePeer::getAll();
			$smarty->assign('modules',$modules);

			$smarty->assign("category",$category);

	    $smarty->assign("accion","edicion");
		}
		else {
			//voy a crear un category nuevo
												
			$smarty->assign("accion","creacion");
		}

		return $mapping->findForwardConfig('success');
	}

}
?>
