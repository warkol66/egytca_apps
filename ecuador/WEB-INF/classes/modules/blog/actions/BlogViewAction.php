<?php

class BlogViewAction extends BaseAction {

	function BlogViewAction() {
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
		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["params"];
		$smarty->assign("blogConfig",$blogConfig);

		/**
		* Use a different template
		*/
		$this->template->template = "TemplateBlogPublic.tpl";

		if (!empty($_GET["id"]) || !empty($_GET["url"])) {

			if (!empty($_GET["id"]))
				$blogEntry = BlogEntryPeer::get($_GET["id"]);
			else
				$blogEntry = BlogEntryPeer::getByUrl($_GET["url"]);
				
			if (!empty($blogEntry)) {
				$blogEntry->increaseViews();
				$smarty->assign('blogEntry',$blogEntry);
			

				if ($moduleConfig['comments']['useComments']['value'] == "YES") {
					//si se la configuracion pide que se muestren los comentarios de forma directa
					if ($moduleConfig['comments']['displayComments']['value'] == 'YES') {
						$blogCommentPeer = new BlogCommentPeer();
						$comments = $blogCommentPeer->getAllApprovedByEntry($_GET["id"]);
						$smarty->assign("comments",$comments);
					}
				}
			}
			else {
				$smarty->assign('message','entryNotFound');
				return $mapping->findForwardConfig('success');
			}
		}
		else {
			$smarty->assign('message','noEntryIdRequested');
			return $mapping->findForwardConfig('success');
		}
		return $mapping->findForwardConfig('success');
	}

}
