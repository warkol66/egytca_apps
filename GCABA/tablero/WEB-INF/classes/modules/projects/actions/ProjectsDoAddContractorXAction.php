<?php
class ProjectsDoAddContractorXAction extends BaseAction {

	function ProjectsDoAddContractorXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Projects";
		
		$project = ProjectPeer::get($_POST['projectId']);
		$contractorIds = $_POST['contractor']['id'];
		$contractors = ContractorQuery::create()->findPks($contractorIds);;
		$type = $_POST['type'];
		$smarty->assign('type', $type);
		$actualyAddedContractors = array(); // es posible que algunos ya existan
											// por eso no todos van a ser agregados
		
		foreach ($contractors as $contractor) {
			if (!empty($project) && !empty($contractor)) {
				if (!$project->hasContractor($contractor, $type)) {
					$project->addContractor($contractor, $type);
					if (!$project->save()) {
						$smarty->assign('message', 'failure');
						return $mapping->findForwardConfig('success');
					} else {
						$actualyAddedContractors[] = $contractor;
					}
				}
			} else {
				$smarty->assign('message', 'failure');
				return $mapping->findForwardConfig('success');
			}
		}
		$smarty->assign('contractors', $actualyAddedContractors);
		$smarty->assign('message', 'success');
		return $mapping->findForwardConfig('success');
	}
}
