<?php

class BoardCommentsChangeStatusesAction extends BaseAction {

	function BoardCommentsChangeStatusesAction() {
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

		$module = "Board";
		$smarty->assign("module",$module);

		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			
			BoardCommentQuery::create()->filterById($_POST['selected'], Criteria::IN)->update(array('Status' => $_POST['status']));

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
