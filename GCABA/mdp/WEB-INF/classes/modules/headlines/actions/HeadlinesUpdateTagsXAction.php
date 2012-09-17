<?php

class HeadlinesUpdateTagsXAction extends BaseAction {

	function HeadlinesUpdateTagsXAction() {
		;
	}
	
	function arrayHasTag($array, $tag) {
		foreach ($array as $e) {
			if ($e->getId() == $tag->getId())
				return true;
		}
		return false;
	}
	
	function addTag($headline, $tag) {
		if (!($headline->hasHeadlineTag($tag))) {
			$headline->addHeadlineTag($tag);
			if (!$headline->save()) {
				$smarty->assign('message', 'failure');
			} 
		}
	}
	
	function removeTag($headline, $tag) {
		
		$headline = HeadlineQuery::create()->findOneById($_POST["headlineId"]);
		$relation = HeadlineTagRelationQuery::create()->filterByHeadline($headline)->filterByHeadlineTag($tag)->findOne();
		
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

		$module = "Headlines";

		if (!empty($_POST["headlineId"])) {
		
			$headline = HeadlineQuery::create()->findOneById($_POST["headlineId"]);
			$tagsIds = $_POST["selectedIds"];
			$selectedTags = array();
			
			foreach ($tagsIds as $tagId) {
				array_push($selectedTags, HeadlineTagQuery::create()->findOneById($tagId));
			}
			$associatedTags = $headline->getHeadlineTags();
			
			// Quitar los tags que sobren
			foreach ($associatedTags as $e) {
				if (!$this->arrayHasTag($selectedTags, $e))
					$this->removeTag($headline, $e);
			}
			
			// Agregar los tags que falten
			foreach ($selectedTags as $e) {
				if (!$this->arrayHasTag($associatedTags, $e))
					$this->addTag($headline, $e);
			}
			
		}
		die();
		return $mapping->findForwardConfig('success');
	}

}