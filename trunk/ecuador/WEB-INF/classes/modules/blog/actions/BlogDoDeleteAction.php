<?php

class BlogDoDeleteAction extends BaseAction {

	function BlogDoDeleteAction() {
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

		if(is_object(BlogEntryQuery::create()->findOneById($_POST["id"])))
			BlogEntryPeer::delete($_POST["id"]);
		else
			$smarty->assign("exists",false);

		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');
	}

}
