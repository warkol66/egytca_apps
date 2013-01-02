<?php
/**
* DocumentsListAction
*
*  Action administrativo utilizado para mostrar los documentos existentes
*
* @package documents
*/

class DocumentsListAction extends BaseListAction {
	
	public function __construct() {
		parent::__construct('Document');
	}
	
	protected function postList() {
		parent::postList();
		$this->smarty->assign('module', 'Documents');
		
		//obtencion de documentos por categoria.
		if (isset($_GET['categoryId'])) {

			if ($_GET['categoryId'] > 0) {

				//se ha elegido una categoria
				$selectedCategory = BaseQuery::create('Category')->findOneById($_GET['categoryId']);
				$moduleName = $selectedCategory->getModule();
				$selectedModule = BaseQuery::create('Module')->findOneByName($moduleName);
				$documents = BaseQuery::create('Document')->filterByCategory($selectedCategory)->findOne();
				
				$this->smarty->assign('selectedModule', $selectedModule);
				$this->smarty->assign('selectedCategory', $selectedCategory);
				$this->smarty->assign('documents', $documents);
			}
			else {
				//se han pedido documentos sin categoria
				$documents = BaseQuery::create('Document')->findByCategoryId(0);
				$this->smarty->assign('documents', $documents);
			}
		}
		
		$this->smarty->assign('categoryId', $_GET['categoryId']);
		
		$user = Common::getAdminLogged();
		$this->smarty->assign('user', $user);
		if (!empty($user)) {
			$generalParentCategories = $user->getDocumentsGeneralParentCategories();
			$parentCategories = $user->getDocumentsParentCategories();
		}
		$this->smarty->assign('generalParentCategories', $generalParentCategories);
		$this->smarty->assign('parentCategories', $parentCategories);

		$modules = ModuleQuery::findAllWithDocuments();
		$this->smarty->assign('modules', $modules);

		$documentsWithoutCategoryCount = BaseQuery::create('Document')->filterByNoCategory()->count();
		$this->smarty->assign('documentsWithoutCategoryCount', $documentsWithoutCategoryCount);
	}

}
