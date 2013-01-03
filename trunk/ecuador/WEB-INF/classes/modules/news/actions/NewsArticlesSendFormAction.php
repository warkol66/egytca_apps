<?php

class NewsArticlesSendFormAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('NewsArticle');
		
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$module = "News";
		$this->smarty->assign("module",$module);

		$this->template->template = "TemplateAjax.tpl";
		
	}

/*
	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesSendFormAction() {
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
	*
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

		$this->template->template = "TemplateAjax.tpl";
						
 		$newsArticlePeer = new NewsArticlePeer();
		$article = $newsArticlePeer->get($_POST['id']);
		
		$smarty->assign('article',$article);
		
		return $mapping->findForwardConfig('success');
	}*/

}
