<?php

class BoardPreviewAction extends BaseAction {

	function BoardPreviewAction() {
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

		if (!empty($_POST['id']))
			$_POST['params']['id'] = $_POST['id'];

		$preview = BoardChallenge::createPreview($_POST['params']);

		//caso de preview en Home
		if ($_POST['mode'] == 'home') {

			$this->template->template = "TemplateBlogHome.tpl";
			$boardChallengeColl = array();
			array_push($boardChallengeColl,$preview);
			$smarty->assign("boardChallengeColl",$boardChallengeColl);

			return $mapping->findForwardConfig('success-home');
		}

		//caso de preview detallado
		if ($_POST['mode'] == 'detailed') {
			$this->template->template = "TemplateBlogPublic.tpl";
			$smarty->assign('boardChallenge',$preview);
			return $mapping->findForwardConfig('success-detailed');

		}

	}

}
