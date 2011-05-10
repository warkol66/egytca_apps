<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("CategoryPeer.php");

class NewsArticlesListAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesListAction() {
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

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$newsArticlesConfig = $moduleConfig["newsAticles"];
		$smarty->assign("newsArticlesConfig",$newsArticlesConfig);
		
		$newsArticlePeer = new NewsArticlePeer();
		$newsArticlePeer->setOrderByUpdateDate();

 		if (!empty($_GET['filters'])) {
			
			if (!empty($_GET['filters']['fromDate'])) {
				$newsArticlePeer->setFromDate(Common::convertToMysqlDateFormat($_GET['filters']['fromDate']));
			}
			
			if (!empty($_GET['filters']['toDate'])) {
				$newsArticlePeer->setToDate(Common::convertToMysqlDateFormat($_GET['filters']['toDate']));
			}
			
			if (!empty($_GET['filters']['categoryId'])) {
				$category = CategoryPeer::get($_GET['filters']['categoryId']);
				$newsArticlePeer->setCategory($category);			
			}
			
			$smarty->assign('filters',$_GET['filters']);
		}


		if ($_GET["export"] == "xls") {
			$newsarticles = $newsArticlePeer->getAllFiltered();

			$smarty->assign("newsarticles",$newsarticles);
			$forwardConfig = $mapping->findForwardConfig('xml');

			$this->template->template = "TemplatePlain.tpl";

			$xml = $smarty->fetch($forwardConfig->getPath());

			require_once("ExcelManagement.php");
			$excel = new ExcelManagement();			
			$excel->sendXlsFromXml($xml);
			die;
		}
		
		$pager = $newsArticlePeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("newsarticles",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=newsArticlesList";
		
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		
		//aplicacion de filtro a url
		foreach ($_GET['filters'] as $key => $value)
			$url .= "&filters[$key]=$value";
		
		$smarty->assign("url",$url);		

		$user = Common::getAdminLogged();
		$categories = $user->getCategoriesByModule('news');
		$smarty->assign("categories",$categories);
		$smarty->assign("newsArticleStatus",NewsArticlePeer::getStatus());   
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}