<?php

class CategoriesDoEditAction extends BaseAction {

	function CategoriesDoEditAction() {
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
		$section = "Configure";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);

		$categoryPeer = new CategoryPeer();

		if ( $_POST["accion"] == "edicion" ) {
			if ( $categoryPeer->update($_POST["id"],$_POST["name"],$_POST["hierarchyActors"]) )
				return $mapping->findForwardConfig('success');
			else
				return $mapping->findForwardConfig('success');

		}
		else {
			$categoryId = $categoryPeer->create($_POST["name"]);
			//le asigno permisos a la categoria creada a todos los grupos al cual pertenece el usuario
			$user = $_SESSION["login_user"];
			foreach ($user->getGroups() as $group) {
				$groupCategory = new GroupCategory();
				$groupCategory->setGroupId($group->getGroupId());
				$groupCategory->setCategoryId($categoryId);
				$groupCategory->save();
			}
			return $mapping->findForwardConfig('success');
		}

	}

}
