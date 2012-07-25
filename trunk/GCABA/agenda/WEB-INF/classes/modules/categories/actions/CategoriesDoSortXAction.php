<?php

class CategoriesDoSortXAction extends BaseAction {

	function CategoriesDoSortXAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		if (!empty($_POST['categoriesIds'])) {
			$categoriesIds = $_POST['categoriesIds'];
			$i = count($categoriesIds);
			foreach ($categoriesIds as $categoryId) {
				$category = CategoryQuery::create()->findOneById($categoryId);
				$category->setRank($i--);
				$category->save(); // on exception -> ajax call triggers failure
			}
		} else {
			throw new Exception('invalid params'); // trigger failure
		}
		
		return;
	}

}