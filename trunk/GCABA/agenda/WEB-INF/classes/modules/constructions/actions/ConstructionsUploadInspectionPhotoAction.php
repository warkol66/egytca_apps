<?php

class ConstructionsUploadInspectionPhotoAction extends BaseAction {

	function ConstructionsUploadInspectionPhotoAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = 'Constructions';
		$smarty->assign('module', $module);
		
		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}
		
		if (empty($_REQUEST['id'])) {
			$smarty->assign('message', 'missing param: id');
			return $mapping->findForwardConfig('failure');
		} else {
			$smarty->assign('id', $_REQUEST['id']);
			$this->template->template = 'TemplateAjax.tpl';
			return $mapping->findForwardConfig('success');
		}
	}
}

