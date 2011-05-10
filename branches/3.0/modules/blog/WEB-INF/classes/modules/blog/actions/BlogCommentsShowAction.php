<?php

class BlogCommentsShowAction extends BaseAction {

	function BlogCommentsShowAction() {
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
		$comments = $blogCommentPeer->getAllByArticle($_POST["articleId"]);
		$article = BlogEntryPeer::get($_POST['articleId']);
		$smarty->assign("comments",$comments);
		$smarty->assign("article",$article);

		return $mapping->findForwardConfig('success');
	}

}