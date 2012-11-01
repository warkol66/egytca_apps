<?php

class BlogCommentsChangeStatusesAction extends BaseAction {

	function BlogCommentsChangeStatusesAction() {
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

		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {

			foreach ($_POST['selected'] as $id) {
				$blogComment['id'] = $id;
				$blogComment['status'] = $_POST['status'];
				BlogCommentPeer::update($id,$blogComment);
			}

			$smarty->assign('selected',$_POST['selected']);
			$smarty->assign('status',$_POST['status']);
		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
		if ($_POST['page'])
			$queryData = '&page='.$_POST["page"];
		$myRedirectPath .= $queryData;
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;

	}

}