<?php

class HeadlinesProcessMultipleXAction extends BaseAction {

	function HeadlinesProcessMultipleXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->template->template = 'TemplateAjax.tpl';

		$module = "Headlines";
		$smarty->assign("module",$module);
		
		if (!empty($_POST['headlinesIds'])) {
			switch ($_POST['action']) {
				case 'delete':
					HeadlineQuery::create()
						->filterById($_POST['headlinesIds'])
						->delete();
					$smarty->assign('headlinesIds', $_POST['headlinesIds']);
					break;
				default:
					# code...
					break;
			}
			
		} else {
			//return $mapping->findForwardConfig('failure');
		}
		
		return $mapping->findForwardConfig('success');
	}
}
