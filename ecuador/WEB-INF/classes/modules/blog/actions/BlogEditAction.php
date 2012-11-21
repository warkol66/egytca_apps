<?php

class BlogEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

	protected function postEdit() {
		parent::postEdit();
		
		$module = "Blog";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("actualAction", "blogEdit");
		
		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$blogConfig = $moduleConfig["blogEntries"];
		$this->smarty->assign("blogConfig",$moduleConfig["blogEntries"]);
		
		if ($blogConfig['useCategories']['value'] == "YES"){
			$this->smarty->assign("categoryIdValues",BlogCategoryQuery::create()->find());
		}

		//users, statuses y tags
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("blogEntryStatus",BlogEntry::getStatus());
		$this->smarty->assign("tags", BlogTagQuery::create()->find());
	}

	/*function BlogEditAction() {
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
			if(is_object($blogEntry)){
				$smarty->assign("blogEntry",$blogEntry);
				$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("action","edit");
			}
			else{
				$smarty->assign("exists",false);
				return $mapping->findForwardConfig('success');
			}
		}
		else {
			//voy a crear un blogEntry nuevo
			$blogEntry = new BlogEntry();
			$smarty->assign("blogEntry",$blogEntry);
			$smarty->assign("userIdValues",UserQuery::create()->find());
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
	}*/

}
