<?php

class BlogCommentsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogComment');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);

		$this->smarty->assign("statusOptions",BlogComment::getStatusOptions());
		$this->smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
	}
	/*function BlogCommentsEditAction() {
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

		if ( !empty($_GET["id"]) ) {
			//voy a editar un blogComment
			$blogComment = BlogCommentPeer::get($_GET["id"]);

			$smarty->assign("blogComment",$blogComment);
			$smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un blogComment nuevo
			$blogComment = new BlogComment();
			$smarty->assign("blogComment",$blogComment);
			$smarty->assign("entryIdValues",BlogEntryQuery::create()->find());
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","create");
		}

		$smarty->assign("message",$_GET["message"]);
		$smarty->assign("statusOptions",BlogCommentPeer::getStatusOptions());

		//redireccionamientos
		if (isset($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);
		if (isset($_GET['articleId']))
			$smarty->assign('articleId',$_GET['articleId']);

		return $mapping->findForwardConfig('success');
	}*/

}
