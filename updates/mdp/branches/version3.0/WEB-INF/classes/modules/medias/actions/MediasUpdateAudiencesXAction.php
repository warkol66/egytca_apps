<?php

class MediasUpdateAudiencesXAction extends BaseAction {

	function MediasUpdateAudiencesXAction() {
		;
	}
	
	function arrayHasAudience($array, $audience) {
		foreach ($array as $e) {
			if ($e->getId() == $audience->getId())
				return true;
		}
		return false;
	}
	
	function addAudience($media, $audience) {
		if (!($media->hasMediaAudience($audience))) {
			$media->addMediaAudience($audience);
			if (!$media->save()) {
				$smarty->assign('message', 'failure');
			} 
		}
	}
	
	function removeAudience($media, $audience) {
		
		$media = MediaPeer::get($_POST["mediaId"]);
		$relation = MediaAudienceRelationQuery::create()->filterByMedia($media)->filterByMediaAudience($audience)->findOne();
		
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

		$module = "Medias";

		if (!empty($_POST["mediaId"])) {
		
			$media = MediaPeer::get($_POST["mediaId"]);
			$audiencesIds = $_POST["selectedIds"];
			$selectedAudiences = array();
			
			foreach ($audiencesIds as $audienceId) {
				array_push($selectedAudiences, MediaAudiencePeer::get($audienceId));
			}
			$associatedAudiences = $media->getMediaAudiences();
			
			// Quitar las audiences que sobren
			foreach ($associatedAudiences as $e) {
				if (!$this->arrayHasAudience($selectedAudiences, $e))
					$this->removeAudience ($media, $e);
			}
			
			// Agregar los audiences que falten
			foreach ($selectedAudiences as $e) {
				if (!$this->arrayHasAudience($associatedAudiences, $e))
					$this->addAudience($media, $e);
			}
			
		}

		return null;
	}

}