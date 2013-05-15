<?php
/**
* DocumentsShowAction
*
*  Action p�o utilizado para mostrar los documentos existentes
*
* @package documents
*/

class DocumentsShowAction extends BaseAction {

	function DocumentsShowAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Use a different template
		$this->template->template = "TemplatePublic.tpl";

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Documents";
		$smarty->assign("module",$module);

		$documentPeer = new DocumentPeer();
		$searchStringParams = '';
		if (empty($_GET['page']))
			$_GET['page'] = 1;
		//filtros de busqueda.

		if ($_GET['filters']['contentCategoryId'] && !$_GET['filters']['categoryId'])
			$_GET['filters']['categoryId'] = $_GET['filters']['contentCategoryId'];

		//obtencion de documentos por categoria.
		if (isset($_GET['categoryId'])) {

			if ($_GET['categoryId'] > 0) {

				//se ha elegido una categoria
				$selectedCategory = CategoryPeer::get($_GET['categoryId']);
				$documentPeer->setCategory($selectedCategory);
				$searchStringParams = $searchStringParams."&categoryId=".$_GET['categoryId'];

				$moduleName = $selectedCategory->getModule();
				require_once('ModulePeer.php');
				$selectedModule = ModulePeer::get($moduleName);
				$smarty->assign('selectedModule',$selectedModule);
				$smarty->assign('selectedCategory',$selectedCategory);

				//obtengo los documentos para la categoria
				$documents = $documentPeer->getAllFiltered($selectedCategory);
				$smarty->assign('documents',$documents);

				$parentId = $selectedCategory->getParentId();
				$navChain = Array();
				if ($parentId != 0)
					while ($parentId != 0) {
						$category = CategoryPeer::get($parentId);
						$parentCategory[name] = $category->getName();
						$parentId = $category->getParentId($parentId);
						array_push($navChain, $parentCategory);
				}
				else{
					$parentCategory[name] = $selectedCategory->getName();
					array_push($navChain, $parentCategory);
				}
				$smarty->assign('navChain',$navChain);
			}
			else {
				//se han pedido documentos sin categoria
				$documents = $documentPeer->getAllWithoutCategory();
				$smarty->assign('documents',$documents);
			}

			$smarty->assign('categoryId',$_GET['categoryId']);
			$pager = $documentPeer->getAllPaginatedFilteredForShow($_GET['page']);
			$smarty->assign('documents',$pager->getResult());
			$smarty->assign('pager',$pager);
			$url = "Main.php?do=documentsShow" . $searchStringParams;
			$smarty->assign("url",$url);

		}
		else {
			if (!empty($_GET['filters'])) {

			if (!empty($_GET['filters']['textSearch'])) {
				$documentPeer->setTextSearch($_GET['filters']['textSearch']);
				$searchStringParams = $searchStringParams."&filters%5BtextSearch%5D=".$_GET['filters']['textSearch'];
			}
			if (!empty($_GET['filters']['filename'])) {
				$documentPeer->setFilename($_GET['filters']['filename']);
				$searchStringParams = $searchStringParams."&filters%5Bfilename%5D=".$_GET['filters']['filename'];
			}
			if (!empty($_GET['filters']['description'])) {
				$documentPeer->setDescription($_GET['filters']['description']);
				$searchStringParams = $searchStringParams."&filters%5Bdescription%5D=".$_GET['filters']['description'];
			}
			if (!empty($_GET['filters']['startDate'])) {
				$documentPeer->setStartDate($_GET['filters']['startDate']);
				$searchStringParams = $searchStringParams."&filters%5BstartDate%5D=".$_GET['filters']['startDate'];
			}
			if (!empty($_GET['filters']['endDate'])) {
				$documentPeer->setEndDate($_GET['filters']['endDate']);
				$searchStringParams = $searchStringParams."&filters%5BendDate%5D=".$_GET['filters']['endDate'];
			}
			if (!empty($_GET['filters']['publishedYear'])) {
				$documentPeer->setPublishedYear($_GET['filters']['publishedYear']);
				$searchStringParams = $searchStringParams."&filters%5BpublishedYear%5D=".$_GET['filters']['publishedYear'];
			}
			if (!empty($_GET['filters']['title'])) {
				$documentPeer->setTitle($_GET['filters']['title']);
				$searchStringParams = $searchStringParams."&filters%5Btitle%5D=".$_GET['filters']['title'];
			}
			if (!empty($_GET['filters']['author'])) {
				$documentPeer->setAuthor($_GET['filters']['author']);
				$searchStringParams = $searchStringParams."&filters%5Bauthor%5D=".$_GET['filters']['author'];
			}
			if (!empty($_GET['filters']['keyWords'])) {
				$documentPeer->setKeyWords($_GET['filters']['keyWords']);
				$searchStringParams = $searchStringParams."&filters%5BkeyWords%5D=".$_GET['filters']['keyWords'];
			}
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$searchStringParams = $searchStringParams."&filters%5BcategoryId%5D=".$_GET['filters']['categoryId'];
				$documentPeer->setCategory($category);

				$parentId = $category->getParentId();
				$navChain = Array();
				if ($parentId != 0)
					while ($parentId != 0) {
						$categoryParent = CategoryPeer::get($parentId);
						$parentCategory[name] = $categoryParent->getName();
						$parentId = $categoryParent->getParentId($parentId);
						array_push($navChain, $parentCategory);
				}
				$parentCategory[name] = $category->getName();
				array_push($navChain, $parentCategory);
				$smarty->assign('navChain',$navChain);
			}

			if (!empty($_GET['filters']['selectedModule'])) {
				$selectedModule = ModulePeer::get($_GET['filters']['selectedModule']);
				$documentPeer->setModule($selectedModule);
			}

			$smarty->assign('filters',$_GET['filters']);

			//realizamos la busqueda por filtros.
//			$documents = $documentPeer->getAllFilteredPaginated($selectedCategory);
			$pager = $documentPeer->getAllPaginatedFilteredForShow($_GET['page']);
			$smarty->assign('documents',$pager->getResult());
			$smarty->assign('pager',$pager);
			$url = "Main.php?do=documentsShow" . $searchStringParams;
			$smarty->assign("url",$url);

		}
		else {
			$pager = $documentPeer->getAllPaginatedFilteredForShow($_GET['page']);
			$smarty->assign('documents',$pager->getResult());
			$smarty->assign('pager',$pager);
			$url = "Main.php?do=documentsShow" . $searchStringParams;
			$smarty->assign("url",$url);

				$newest = $documentPeer->getNewest();
				$smarty->assign('newest',$newest);
			}
		}

		$userPublic = UserPeer::getByUsername('system');
		$smarty->assign('user',$userPublic);

		$publicationYears = DocumentPeer::getPublicationYears();
		$smarty->assign('publicationYears',$publicationYears);

		$generalParentCategories = $userPublic->getDocumentsGeneralParentCategories();

		$smarty->assign('generalParentCategories',$generalParentCategories);

		$modules = $documentPeer->getModulesWithDocuments();
		$smarty->assign('modules',$modules);

		$parentCategories = $userPublic->getDocumentsParentCategories();

		//Si se selecciona una categoria por contenido no paso las categorias, paso solo esa categoria
		if ($_GET['filters']['fromContent']) {

			require_once("Content.class.php");
			$content = new Content();
			$contentData = $content->get($_GET['filters']['fromContent']);
			$contentData['content'] = $_GET['filters']['fromContent'];
	
			$parentCategories = $userPublic->getDocumentsParentCategories($_GET['filters']['contentCategoryId']);

			$this->template->template = "TemplateContent.tpl";
			$smarty->assign('contentData',$contentData);
			$smarty->assign('fromContent',$_GET["fromContent"]);
			$smarty->assign('categorySelected',CategoryPeer::get($_GET['filters']['contentCategoryId']));
			$url = "Main.php?do=documentsShow&filters[fromContent]=" . $_GET['filters']['fromContent'] . "&filters[contentCategoryId]=" . $_GET['filters']['contentCategoryId'] .  $searchStringParams;
			$smarty->assign("url",$url);				

		}
		$smarty->assign('parentCategories',$parentCategories);

		$documentsWithoutCategoryCount = $documentPeer->getDocumentsWithoutCategoryCount();
		$smarty->assign('documentsWithoutCategoryCount',$documentsWithoutCategoryCount);

		////////////
		// se asignan las variables trabajadas
		$smarty->assign("message",$msg);
		$smarty->assign("results",$docs);
		
		if ($_REQUEST["rss"]=="1") {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			return $mapping->findForwardConfig('rss');
		}			


		return $mapping->findForwardConfig('success');

	}

}
