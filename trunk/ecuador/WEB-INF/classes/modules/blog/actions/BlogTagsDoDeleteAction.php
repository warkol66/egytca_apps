<?php

class BlogTagsDoDeleteAction extends BaseDoDeleteAction {

	function __construct() {
		parent::__construct('BlogTag');
	}
	
	/*function BlogTagsDoDeleteAction() {
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
		$tag = BlogTagQuery::create()->findPk($_POST["id"]);
		BlogTagPeer::delete($_POST["id"]);
		return $mapping->findForwardConfig('success');
	}*/

}
