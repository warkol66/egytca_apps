<?php

class PlanningProjectsUpdateTagsXAction extends BaseAction {

	function PlanningProjectsUpdateTagsXAction() {
		;
	}
	
	function arrayHasTag($array, $tag) {
		foreach ($array as $e) {
			if ($e->getId() == $tag->getId())
				return true;
		}
		return false;
	}
	
	function addTag($project, $tag) {
		if (!($project->hasPlanningProjectTag($tag))) {
			$project->addPlanningProjectTag($tag);
			if (!$project->save()) {
				$smarty->assign('message', 'failure');
			} 
		}
	}
	
	function removeTag($project, $tag) {
		
		$project = PlanningProjectQuery::create()->findOneById($_POST["planningProjectId"]);
		$relation = PlanningProjectTagRelationQuery::create()->filterByPlanningProject($project)->filterByPlanningProjectTag($tag)->findOne();
		
		if (!empty($relation))
			try {
				$relation->delete();
			}
			catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
			}
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Planning";

		if (!empty($_POST["planningProjectId"])) {
		
			$project = PlanningProjectQuery::create()->findOneById($_POST["planningProjectId"]);
			$tagsIds = $_POST["selectedIds"];
			$selectedTags = array();
			
			foreach ($tagsIds as $tagId) {
				array_push($selectedTags, PlanningProjectTagQuery::create()->findOneById($tagId));
			}
			$associatedTags = $project->getPlanningProjectTags();
			
			// Quitar los tags que sobren
			foreach ($associatedTags as $e) {
				if (!$this->arrayHasTag($selectedTags, $e))
					$this->removeTag($project, $e);
			}
			
			// Agregar los tags que falten
			foreach ($selectedTags as $e) {
				if (!$this->arrayHasTag($associatedTags, $e))
					$this->addTag($project, $e);
			}
			
		}
		die();
		return $mapping->findForwardConfig('success');
	}

}