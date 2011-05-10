<?php

class BlogTagsDoEditAction extends BaseAction {

	function BlogTagsDoEditAction() {
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
		$section = "Tags";

		if ($_POST["action"] == "edit") {

			if (BlogTagPeer::update($_POST["id"],$_POST["tagData"]))
				return $mapping->findForwardConfig('success');

		}
		else {

			$blogTag = new BlogTag();
			$blogTag = Common::setObjectFromParams($blogTag,$_POST["tagData"]);

			$existent = BlogTagPeer::getByName($blogTag->getName());
			
			if (empty($existent)){
				if ($blogTag->isModified() && !$blogTag->save()) {
					$smarty->assign("tag",$blogTag);
					$smarty->assign("action","create");
					$smarty->assign("message","error");
					return $mapping->findForwardConfig('failure');
				}
			}
			else{
				$smarty->assign("tag",$blogTag);
				$smarty->assign("action","create");
				$smarty->assign("message","duplicated");
				return $mapping->findForwardConfig('failure');
			}

			return $mapping->findForwardConfig('success');
		}

	}

}
