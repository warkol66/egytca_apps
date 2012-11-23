<?php

class BlogTagsEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('BlogTag');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$section = "Tags";
		$this->smarty->assign("section",$section);
	}

	/*function BlogTagsEditAction() {
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
		$section = "Tags";
		$smarty->assign("section",$section);

		if ( !empty($_GET["id"]) ) {
			$tag = BlogTagPeer::get($_GET["id"]);
			if(is_object($tag))
				$smarty->assign("action","edit");
			else{
				$smarty->assign("exists",false);
				return $mapping->findForwardConfig('success');
			}
		}
		else {
			$tag = new BlogTag();
			$smarty->assign("action","create");
		}

		$smarty->assign("tag",$tag);
		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}*/

}
