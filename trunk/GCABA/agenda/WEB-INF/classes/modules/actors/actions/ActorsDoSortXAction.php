<?php

class ActorsDoSortXAction extends BaseAction {

	function ActorsDoSortXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Actors";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		if (!empty($_POST['actorsIds'])) {
			$actorsIds = $_POST['actorsIds'];
			$i = count($actorsIds);
			foreach ($actorsIds as $actorId) {
				$actor = ActorQuery::create()->findOneById($actorId);
				$actor->setRank($i--);
				$actor->save(); // on exception -> ajax call triggers failure
			}
		} else {
			throw new Exception('invalid params'); // trigger failure
		}
		
		return;
	}

}