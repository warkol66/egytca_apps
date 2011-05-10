<?php

class BlogEditAction extends BaseAction {

	function BlogEditAction() {
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
		$smarty->assign("actualAction", "blogEdit");

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["blogEntries"];
		$smarty->assign("blogConfig",$blogConfig);

		if ( !empty($_GET["id"]) ) {
			//voy a editar un blogEntry

			$blogEntry = BlogEntryQuery::create()->findOneById($_GET["id"]);
			$smarty->assign("blogEntry",$blogEntry);
			$smarty->assign("userIdValues",UserPeer::getAll());
			$smarty->assign("action","edit");
		}
		else {
			//voy a crear un blogEntry nuevo
			$blogEntry = new BlogEntry();
			$smarty->assign("blogEntry",$blogEntry);
			$smarty->assign("userIdValues",UserPeer::getAll());
			$smarty->assign("action","create");
		}

		$tags = BlogTagPeer::getTagCandidates($blogEntry);
		$smarty->assign("tags",$tags);


		if ($blogConfig['useCategories']['value'] == "YES")
			$smarty->assign("categoryIdValues",BlogCategoryPeer::getAll());

		$smarty->assign("blogEntryStatus",BlogEntryPeer::getStatus());
		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters']))
			$smarty->assign('filters',$_GET['filters']);

		return $mapping->findForwardConfig('success');
	}

}