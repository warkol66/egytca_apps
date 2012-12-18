<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("NewsMediaPeer.php");

class NewsMediasListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsMediasListAction() {
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

		$module = "News";
		$smarty->assign("module",$module);
		
		//seteamos lo necesario para crear la interfaz de filtros
		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$smarty->assign("categories",$categories);
		$smarty->assign("mediaTypes",NewsMediaPeer::getMediaTypes());
		
		
		$newsMediaPeer = new NewsMediaPeer();
		
		//filtros
		if (isset($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
			
			if (isset($_GET['filters']['mediaType'])) {
				$newsMediaPeer->setMediaType($_GET['filters']['mediaType']);
			}
				
			if (!empty($_GET['filters']['fromDate'])) {
				$newsMediaPeer->setFromDate($_GET['filters']['fromDate']);
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$newsMediaPeer->setToDate($_GET['filters']['toDate']);
			}
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$newsMediaPeer->setCategory($category);			
			}			
				
		}
						
 
		$pager = $newsMediaPeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("newsmedias",$pager->getResult());
		$smarty->assign("pager",$pager);
		
		$url = "Main.php?do=newsMediasList";
		
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