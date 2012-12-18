<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");

class NewsArticlesShowAction extends BaseAction {

	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesShowAction() {
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

   	// Use a different template
		$this->template->template = "TemplateNewsHome.tpl";
						
 		$newsArticlePeer = new NewsArticlePeer();
		$newsArticlePeer->setOrderByCreationDate();
		//modo archivo
		if (isset($_GET['archive'])) {
			$smarty->assign('archive',$_GET['archive']);
			$newsArticlePeer->setArchiveMode();
		}
		else
			$newsArticlePeer->setPublishedMode();

		$moduleConfig = Common::getModuleConfiguration($module);
    $newsInHome = $moduleConfig["newsInHome"];
    $newsPerPage = $moduleConfig["newsPerPage"];

		if (isset($_GET["page"]))
			$pager = $newsArticlePeer->getAllPaginatedFilteredForShow($_GET["page"],$newsPerPage);
		elseif (isset($_REQUEST["rss"]))
			$pager = $newsArticlePeer->getAllPaginatedFiltered(1);
		else
			$pager = $newsArticlePeer->getAllPaginatedFilteredForHome($newsInHome);

		//Hack para cálculo de páginas si se quiere tener primera página diferente, implica uso de paginador especial
		$totalPages = ceil(($pager->getTotalRecordCount() - $newsInHome ) / $newsPerPage);
		$smarty->assign("totalPages",$totalPages);

		$smarty->assign("newsarticles",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=newsArticlesShow";
		if (isset($_GET['archive'])) 
			$url .= "&archive=1";
		$smarty->assign("url",$url);				
		
		if (isset($_REQUEST["rss"])) {
			$this->template->template = "TemplatePlain.tpl";
			header("content-Type:application/rss+xml; charset=utf-8"); 
			return $mapping->findForwardConfig('rss');
		}
   
		return $mapping->findForwardConfig('success');
	}

}