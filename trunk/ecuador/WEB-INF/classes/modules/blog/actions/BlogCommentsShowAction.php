<?php

class BlogCommentsShowAction extends BaseAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		
		$this->smarty->assign($comments, BlogEntryQuery::getComments($this->entity->getid()));

		//obtener los comments de la entry
	}

	/*function BlogCommentsShowAction() {
		;
	}

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

		$module = "Blog";
		$smarty->assign("module",$module);

		$this->template->template = "TemplateAjax.tpl";

		$blogCommentPeer = new BlogCommentPeer();
		$comments = $blogCommentPeer->getAllApprovedByEntry($_POST["articleId"]);
		$article = BlogEntryPeer::get($_POST['articleId']);
		$smarty->assign("comments",$comments);
		$smarty->assign("article",$article);

		return $mapping->findForwardConfig('success');
	}*/

}
