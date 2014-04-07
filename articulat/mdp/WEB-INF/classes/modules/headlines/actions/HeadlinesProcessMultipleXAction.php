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
		$smarty->assign("action",$_POST['action']);

		$headlines = $_POST['headlinesIds'];
		
		if (!empty($headlines)) {
			switch ($_POST['action']) {
				case 'delete':
					HeadlineQuery::create()
						->filterById($_POST['headlinesIds'])
						->delete();
					$smarty->assign('headlinesIds', $_POST['headlinesIds']);
					break;
				case 'tags':
					$not_saved = Headline::addTagsToMultiple($headlines, $_POST["selectedIds"]);
					break;
				case 'issues':
					$not_saved = Headline::addIssuesToMultiple($headlines, $_POST["selectedIds"]);
					break;
				default:
					break;
			}

			if(!empty($not_saved))
				$smarty->assign('notSaved', $not_saved);
			
		} else {
			$smarty->assign('noHeadlines', true);
		}
		
		return $mapping->findForwardConfig('success');
	}
}
