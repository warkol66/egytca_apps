<?php

class CategoriesDoEditXAction extends BaseAction {

	function CategoriesDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Categories";
		$smarty->assign("module",$module);

		$user = Common::getLoggedUser();

		$categoryParams = $_POST['category'];

		if ($_POST["action"] == "edit") {
			CategoryPeer::update($_POST['id'], $categoryParams);
			return $mapping->findForwardConfig('success');
		}
		else {
			if (empty($categoryParams['name'])) {
				$parentCategories = $user->getParentCategoriesByModule($categoryParams['module']);
				$smarty->assign("parentUserCategories",$parentCategories);
				return $mapping->findForwardConfig('failure');
			}

			$newCategory = CategoryPeer::create($categoryParams);
			$smarty->assign("newCategory",$newCategory);

			$parentCategories = $user->getParentCategoriesByModule($categoryParams['module']);
			$smarty->assign("parentUserCategories",$parentCategories);

			//le asigno permisos a la categoria creada a todos los grupos al cual pertenece el usuario
			//separacion entre caso de usuario dependencia y usuario administrador
			if (isset($user))
				$user->setGroupsToCategory($newCategory->getId());

			return $mapping->findForwardConfig('success');
		}

	}

}