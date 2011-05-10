<?php

class CategoriesDoEditXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CategoriesDoEditXAction() {
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
      
    $categoryPeer = new CategoryPeer;
      
		if (Common::isAffiliatedUser())
			$user = Common::getAffiliatedLogged();
		
		if (Common::isAdmin())
			$user = Common::getAdminLogged();				

    $categoryParams = $_POST['category'];
    
		if ( $_POST["action"] == "edit" ) {
			//estoy editando un category existente
			$category = $categoryPeer->get($_POST['id']);
      Common::setObjectFromParams($category, $categoryParams);
      if ($category->save())
        return $mapping->findForwardConfig('success');
      else
        return $mapping->findForwardConfig('failure');
		}
		else {  //estoy creando un nuevo category
		  $this->applyFilters($categoryPeer, $_POST['filters'], $smarty);
			if (empty($categoryParams['name'])) {
			  $parentCategories = $categoryPeer->getAllParentsByUserFiltered($user);
        $smarty->assign("parentUserCategories",$parentCategories);
				return $mapping->findForwardConfig('failure');
			}
      
			$category = new Category;
      Common::setObjectFromParams($category, $categoryParams);
      if (!$category->save())
        return $mapping->findForwardConfig('failure');
        
      $parentCategories = $categoryPeer->getAllParentsByUserFiltered($user);
      $smarty->assign("parentUserCategories",$parentCategories);
      
      if (empty($category))
        return $mapping->findForwardConfig('failure');
        
			$smarty->assign("category",$category);

			//le asigno permisos a la categoria creada a todos los grupos al cual pertenece el usuario
			//separacion entre caso de usuario dependencia y usuario administrador	
			if (isset($user)) {
				$user->setGroupsToCategory($category->getId());
			}
			return $mapping->findForwardConfig('success');
		}

	}
}