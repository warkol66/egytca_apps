<?php
/**
* DocumentsCategoriesList
*
*	Action utilizado para cargar las diversas categorias disponibles que
*	un usuario puede ver. Dichas categorķas contienen documentos.
* 
* @package documents
*/

require_once("DocumentsBaseAction.php");
require_once("CategoryPeer.php");


/**
* DocumentsSelectCategoryAction
*
*  Esta clase hereda la clase BaseAction
* 
*/
class DocumentsCategoriesListAction extends DocumentsBaseAction {

	/**
	* DocumentsSelectCategoryAction
	*
	*  Constructor por defecto
	*
	*/


	function DocumentsCategoriesListAction() {
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


		$categoryPeer = new CategoryPeer();
    
		// se comprueba las categorķas que puede ver el usuario logueado y se las asigna
		$categories = $categoryPeer->getUserCategories($_SESSION["login_user"]);
		$smarty->assign("categories",$categories);



		return $mapping->findForwardConfig('success');

	}

}
