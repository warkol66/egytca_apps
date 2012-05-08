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

		//filtros de busqueda.
		if (!empty($_GET['filters'])) {

			if (!empty($_GET['filters']['textSearch']))
				$documentPeer->setTextSearch($_GET['filters']['textSearch']);

			if (!empty($_GET['filters']['filename']))
				$documentPeer->setFilename($_GET['filters']['filename']);

			if (!empty($_GET['filters']['description']))
				$documentPeer->setDescription($_GET['filters']['description']);

			if (!empty($_GET['filters']['startDate']))
				$documentPeer->setStartDate($_GET['filters']['startDate']);

			if (!empty($_GET['filters']['endDate']))
				$documentPeer->setEndDate($_GET['filters']['endDate']);

			if (!empty($_GET['filters']['title']))
				$documentPeer->setTitle($_GET['filters']['title']);

			if (!empty($_GET['filters']['author']))
				$documentPeer->setAuthor($_GET['filters']['author']);

			if (!empty($_GET['filters']['keyWords']))
				$documentPeer->setKeyWords($_GET['filters']['keyWords']);

			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$documentPeer->setCategory($category);
			}

			if (!empty($_GET['filters']['selectedModule'])) {
				$selectedModule = ModulePeer::get($_GET['filters']['selectedModule']);
				$documentPeer->setModule($selectedModule);
			}

			$smarty->assign('filters',$_GET['filters']);

			//realizamos la busqueda por filtros.
			$documents = $documentPeer->getAllFilteredPaginated($selectedCategory);
			$smarty->assign('documents',$documents);

		}
		else
			if (empty($_GET['categoryId']))
				$_GET['categoryId'] = 0;

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

		////////////
		// $msg=0 --> no se muestra mensaje
		// $msg=1 --> se muestra mensaje de error
		// $msg=2 --> se muestra mensaje satisfactorio
		if(empty($_GET["errormessage"]))
			$msg="noError";
		else
			$msg=$_GET["errormessage"];

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
