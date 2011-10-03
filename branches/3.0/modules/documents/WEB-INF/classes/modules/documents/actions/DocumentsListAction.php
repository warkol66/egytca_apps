<?php
/**
* DocumentsListAction
*
*  Action administrativo utilizado para mostrar los documentos existentes
*
* @package documents
*/

class DocumentsListAction extends BaseAction {

	function DocumentsListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);

		$documentPeer = new DocumentPeer();

		if (!empty($_GET["page"])){
			$page = $_GET["page"];
			$smarty->assign("page",$page);
		}
		if (!empty($_GET['filters'])){
			$filters = $_GET['filters'];
			$this->applyFilters($documentPeer,$filters,$smarty);
		}


		$documents = $documentPeer->getAllFilteredPaginated($selectedCategory);
		$smarty->assign('documents',$documents);

		$pager = $documentPeer->getAllPaginatedFiltered($page);

		$smarty->assign("documents",$pager->getResult());
		$smarty->assign("pager",$pager);

		//obtencion de documentos por categoria.
		if (isset($_GET['categoryId'])) {

			if ($_GET['categoryId'] > 0) {

				//se ha elegido una categoria
				$selectedCategory = CategoryPeer::get($_GET['categoryId']);
				$documentPeer->setCategory($selectedCategory);

				$moduleName = $selectedCategory->getModule();
				$selectedModule = ModulePeer::get($moduleName);
				$smarty->assign('selectedModule',$selectedModule);
				$smarty->assign('selectedCategory',$selectedCategory);

				//obtengo los documentos para la categoria
				$documents = $documentPeer->getAllFiltered($selectedCategory);
				$smarty->assign('documents',$documents);

			}
			else {
				//se han pedido documentos sin categoria
				$documents = $documentPeer->getAllWithoutCategory();
				$smarty->assign('documents',$documents);
			}
		}

		$smarty->assign('categoryId',$_GET['categoryId']);

		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);
		if (!empty($user))
			$generalParentCategories = $user->getDocumentsGeneralParentCategories();

		$smarty->assign('generalParentCategories',$generalParentCategories);

		$modules = $documentPeer->getModulesWithDocuments();
		$smarty->assign('modules',$modules);

		if (!empty($user))
			$parentCategories = $user->getDocumentsParentCategories();

		$smarty->assign('parentCategories',$parentCategories);

		$documentsWithoutCategoryCount = $documentPeer->getDocumentsWithoutCategoryCount();
		$smarty->assign('documentsWithoutCategoryCount',$documentsWithoutCategoryCount);

		////////////
		// se asignan las variables trabajadas
		$smarty->assign("message",$msg);
		$smarty->assign("results",$docs);

		return $mapping->findForwardConfig('success');

	}

}
