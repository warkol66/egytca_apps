<?php

require_once("BaseAction.php");
require_once("CalendarEventPeer.php");
require_once("CalendarMediaPeer.php");

class CalendarMediasListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarMediasListAction() {
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

		$module = "CalendarMedias";
		$smarty->assign("module",$module);
		
		//seteamos lo necesario para crear la interfaz de filtros
		$user = Common::getAdminLogged();
		//$categories = $user->getCategoriesByModule('news');
		$categories = $user->getCategories();
		$smarty->assign("categories",$categories);
		$smarty->assign("mediaTypes",CalendarMediaPeer::getMediaTypes());
		
		$calendarMediaPeer = new CalendarMediaPeer();
		
		//filtros
		if (isset($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$calendarMediaPeer->setCategory($category);			
			}			
				
		}					
 
		$pager = $calendarMediaPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("calendarMedias",$pager->getResult());
		$smarty->assign("pager",$pager);
		
		$url = "Main.php?do=calendarMediasList";
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$smarty->assign("url",$url);		
   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}