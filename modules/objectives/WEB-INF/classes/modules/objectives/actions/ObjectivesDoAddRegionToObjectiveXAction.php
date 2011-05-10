<?php

class ObjectivesDoAddRegionToObjectiveXAction extends BaseAction {

	function ObjectivesDoAddRegionToObjectiveXAction() {
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

		$module = "Objectives";

		if ( !empty($_POST["objectiveId"]) && !(empty($_POST["regionId"])) ) {

			$objective = ObjectivePeer::get($_POST["objectiveId"]);
			$region = RegionPeer::get($_POST["regionId"]);

			$smarty->assign('region',$region);
			$smarty->assign('objective',$objective);

			if (!empty($objective) && !empty($region)) {

				$result = ObjectiveRegionPeer::create($_POST["objectiveId"],$_POST["regionId"]);

				if ($result)
					return $mapping->findForwardConfig('success');
				else {
					$smarty->assign('errorTagId','regionMsgField');
					return $mapping->findForwardConfig('failure');
				}

			}

		}

		$smarty->assign('errorTagId','regionMsgField');
		return $mapping->findForwardConfig('failure');
	}

}
