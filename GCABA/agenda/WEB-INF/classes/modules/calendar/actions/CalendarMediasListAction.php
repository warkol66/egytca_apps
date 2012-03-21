<?php

class CalendarMediasListAction extends BaseAction {

	function CalendarMediasListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

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