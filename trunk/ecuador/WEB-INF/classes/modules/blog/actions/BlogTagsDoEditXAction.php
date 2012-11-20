<?php

class BlogTagsDoEditXAction extends BaseAction {

	function BlogTagsDoEditXAction() {
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

		$this->template->template = 'TemplateAjax.tpl';

		$blogTag = new BlogTag();
		$blogTag = Common::setObjectFromParams($blogTag,$_POST["tagData"]);
		
		if(is_object($blogTag)){

			$existent = BlogTagPeer::getByName($blogTag->getName());
			
			if (!$existent){
				if ($blogTag->isModified() && !$blogTag->save()) {
					$smarty->assign("blogTag",$blogTag);
					$smarty->assign("action","create");
					$smarty->assign("message","error");
					return $mapping->findForwardConfig('failure');
				}
			}

			$smarty->assign("blogTag",$blogTag);

			$logSufix = ', ' . Common::getTranslation('action: create','common');
			Common::doLog('success', $_POST["tagData"]["name"] . $logSufix);

			return $mapping->findForwardConfig('success');
		}
		else
			return $mapping->findForwardConfig('failure');

	}

}
