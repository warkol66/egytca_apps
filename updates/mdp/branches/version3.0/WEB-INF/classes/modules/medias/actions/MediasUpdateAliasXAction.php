<?php

class MediasUpdateAliasXAction extends BaseAction {

	function MediasUpdateAliasXAction() {
		;
	}
	
	function arrayHasAlias($array, $alias) {
		foreach ($array as $e) {
			if ($e->getId() == $alias->getId())
				return true;
		}
		return false;
	}
	
	function addAlias($media, $alias) {
		if (!($media->hasAlias($alias))) {
			$alias->setAliasof($media->getId()); // add alias
			if (!$alias->save()) {
				throw new Exception("couldn't save changes");
			} 
		}
	}
	
	function removeAlias($alias) {
		$alias->setAliasof(null);
		if (!$alias->save()) {
			throw new Exception("couldn't save changes");
		}
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Medias";

		if (!empty($_POST["mediaId"])) {
		
			$media = MediaQuery::create()->findOneById($_POST["mediaId"]);
			$aliasIds = $_POST["selectedIds"];
			$selectedAlias = array();
			
			foreach ($aliasIds as $aliasId) {
				$alias = MediaQuery::create()->findOneById($aliasId);
				array_push($selectedAlias, $alias);
			}
			$associatedAlias = MediaQuery::create()->filterByAliasof($media->getId())->find();
			
			// Quitar los alias que sobren
			foreach ($associatedAlias as $e) {
				if (!$this->arrayHasAlias($selectedAlias, $e))
					$this->removeAlias($e);
			}
			
			// Agregar los alias que falten
			foreach ($selectedAlias as $e) {
				if (!$this->arrayHasAlias($associatedAlias, $e))
					$this->addAlias($media, $e);
			}
			
		}

		return;
	}

}