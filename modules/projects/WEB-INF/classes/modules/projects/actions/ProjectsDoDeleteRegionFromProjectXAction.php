<?php

class ProjectsDoDeleteRegionFromProjectXAction extends BaseAction {

	function ProjectsDoDeleteRegionFromProjectXAction() {
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

		//TODO VERIFICACION USUARIOS
		if ( !empty($_POST["projectId"]) && !(empty($_POST["regionId"])) ) {

			$project = ProjectPeer::get($_POST["projectId"]);
			$region = RegionPeer::get($_POST["regionId"]);

			if (!empty($project) && !empty($region)) {
				$result = ProjectRegionPeer::delete($_POST["projectId"],$_POST["regionId"]);
				if (!$result){
					$smarty->assign('errorTagId','regionMsgField');
					return $mapping->findForwardConfig('failure');
				}
				$smarty->assign('region',$region);

			}
		}

		return $mapping->findForwardConfig('success');
	}

}
