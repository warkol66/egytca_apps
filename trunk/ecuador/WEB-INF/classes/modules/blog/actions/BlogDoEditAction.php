<?php

class BlogDoEditAction extends BaseAction {

	/*function __construct() {
		parent::__construct('BlogEntry');
	}*/
	
	function BlogDoEditAction() {
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

		if ($_POST["action"] == "edit" && $_POST["id"]) {

			if(empty($_POST["blogEntry"]["creationDate"]))
				$_POST["blogEntry"]["creationDate"] = time();

			$blogEntry = BlogEntryQuery::create()->findOneById($_POST["id"]);
			$blogEntry = Common::setObjectFromParams($blogEntry,$_POST["blogEntry"]);
			$blogEntry->save();
		}
		else {

			$_POST["blogEntry"]["published"] = BlogEntryPeer::NOT_PUBLISHED;
			
			if(empty($_POST["blogEntry"]["creationDate"]))
				$_POST["blogEntry"]["creationDate"] = time();

			$blogEntry = new BlogEntry();
			$blogEntry = Common::setObjectFromParams($blogEntry,$_POST["blogEntry"]);
			
			if (!$blogEntry->save() ) {
				$blogEntry = new BlogEntry();
				$blogEntry = Common::setObjectFromParams($blogEntry,$_POST["blogEntry"]);
				$smarty->assign("blogEntry",$blogEntry);

				$smarty->assign("categoryIdValues",BlogCategoryPeer::getAll());
				$smarty->assign("userIdValues",UserPeer::getAll());
				$smarty->assign("action","create");
				$smarty->assign("message","error");
				return $this->addFiltersToForwards($_POST['filters'],$mapping,'failure');
			}
		}

		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}
