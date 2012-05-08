<?php
/**
* DocumentsListAction
*
*  Action utilizado para mostrar los documentos existentes dentro de una categoría
* 
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("DocumentPeer.php");
require_once("CategoryPeer.php");

/**
* DocumentsListAction
*
*  Esta clase hereda la clase BaseAction
* 
*/
class DocumentsListAction extends DocumentsBaseAction {

	/**
	* DocumentsListAction
	*
	*  Constructor por defecto
	*
	*/

	function DocumentsListAction() {
		;
	}

	/**
	* execute
	*
	* Procesa la solicitud HTTP solicitada, y crea su respectiva respuesta HTTP o
	* bien lo manda hacia otra web en donde aqui la crea. Devuelve un 
	* "ActionForward" describiendo donde y como se debe mandar la solicitud o
	* NULL si la respuesta ha sido completada. 
	* 
	* 
	* //@param ActionConfig		El ActionConfig (mapping) usado para seleccionar los sucesos
	* //@param ActionForm			El opcional ActionForm con los contenidos de las peticiones
	* //@param HttpRequestBase	El HTTP request de lo que se esta  procesando
	* //@param HttpRequestBase	La respuesta HTTP de lo que estan creando
	* //@public
	* 
	* 
	* @param string $mapping una variable que muestra los sucesos
	* @param array $form con todo el contenido a ejecutar
	* @param pointer &$request puntero a un string de lo que se esta solicitando
	* @param pointer &$response puntero a un string de la respuesta que ha dado el servidor
	* @return ActionForward string $mapping con la cadena "sucess" o "failure"
	*
	*/
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
			
			if (!empty($_GET['filters']['filename']))
				$documentPeer->setFilename($_GET['filters']['filename']);
				
			if (!empty($_GET['filters']['description']))
				$documentPeer->setDescription($_GET['filters']['description']);
			
			if (!empty($_GET['filters']['startDate']))
				$documentPeer->setStartDate(Common::convertToMysqlDateFormat($_GET['filters']['startDate']));
			
			if (!empty($_GET['filters']['endDate']))
				$documentPeer->setEndDate(Common::convertToMysqlDateFormat($_GET['filters']['endDate']));

			if (!empty($_GET['filters']['title']))
				$documentPeer->setTitle($_GET['filters']['title']);

			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$documentPeer->setCategory($category);
			}

			if (!empty($_GET['filters']['module'])) {
				$modulePeer = new ModulePeer();
				$aModule = $modulePeer->get($_GET['filters']['module']);
				$documentPeer->setModule($aModule);
			}
		
			$smarty->assign('filters',$_GET['filters']);
			
			//realizamos la busqueda por filtros.
			$documents = $documentPeer->getAllFiltered($selectedCategory);
			$smarty->assign('documents',$documents);
			
		}
		else {
			if (empty($_GET['categoryId'])) {
				$_GET['categoryId'] = 0;
			}
		}

		//obtencion de documentos por categoria.
		if (isset($_GET['categoryId'])) {
			
			if ($_GET['categoryId'] > 0) {

				//se ha elegido una categoria
				$categoryPeer = new CategoryPeer();
				$selectedCategory = $categoryPeer->get($_GET['categoryId']);
				$documentPeer->setCategory($selectedCategory);
				
				$moduleName = $selectedCategory->getModule();
				require_once("ModulePeer.php");
				$modulePeer = new ModulePeer();
				$selectedModule = $modulePeer->get($moduleName);
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
		if(empty($_GET["errormessage"])){
			$msg="noError";
		}
		else $msg=$_GET["errormessage"];

		$user = Common::getAdminLogged();
		$smarty->assign('user',$user);
		
		$generalParentCategories = $user->getDocumentsGeneralParentCategories();

		$smarty->assign('generalParentCategories',$generalParentCategories);

		$modules = $documentPeer->getModulesWithDocuments();

		$smarty->assign('modules',$modules);
		
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
