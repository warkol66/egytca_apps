<?php

class CategoriesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CategoriesDoEditAction() {
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
    $categoryParams = $_POST['category'];

		if ( $_POST["accion"] == "edicion" ) {
			//estoy editando un category existente
      $category = $categoryPeer->get($_POST['id']);
		}
		else {
		  //estoy creando un nuevo category
      $category = new Category;
		}
    Common::setObjectFromParams($category, $categoryParams);
    if ($category->save())
      $myRedirectConfig = $this->addFiltersToForwards(array('searchModule' => $categoryParams['module']), $mapping, 'success');
    else
      $myRedirectConfig = $this->addFiltersToForwards(array('searchModule' => $categoryParams['module']), $mapping, 'failure');

    //le asigno permisos a la categoria creada a todos los grupos al cual pertenece el usuario
    //separacion entre caso de usuario dependencia y usuario administrador  
    if (isset($user) && $category->isNew()) {
      $user->setGroupsToCategory($category->getId());
    }
    return $myRedirectConfig;
	}
}
