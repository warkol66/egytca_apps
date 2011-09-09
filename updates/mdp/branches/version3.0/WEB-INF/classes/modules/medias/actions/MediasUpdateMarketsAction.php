<?php

class MediasUpdateMarketsAction extends BaseAction {

	function MediasUpdateMarketsAction() {
		;
	}
	
	function arrayHasMarket($array, $market) {
		foreach ($array as $e) {
			if ($e->getId() == $market->getId())
				return true;
		}
		return false;
	}
	
	function addMarket($media, $market) {
		if (!($media->hasMediaMarket($market))) {
			$media->addMediaMarket($market);
			if (!$media->save()) {
				$smarty->assign('message', 'failure');
			} 
		}
	}
	
	function removeMarket($media, $market) {
		
		$media = MediaPeer::get($_POST["mediaId"]);
		$relation = MediaMarketsQuery::create()->filterByMedia($media)->filterByMediaMarket($market)->findOne();
		
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

		if (!empty($_POST["mediaId"]) && !(empty($_POST["marketsIds"]))) {
		
			$media = MediaPeer::get($_POST["mediaId"]);
			$marketsIds = $_POST["marketsIds"];
			$selectedMarkets = array();
			
			foreach ($marketsIds as $marketId) {
				array_push($selectedMarkets, MediaMarketPeer::get($marketId));
			}
			$associatedMarkets = $media->getMediaMarkets();
			
			// Quitar los markets que sobren
			foreach ($associatedMarkets as $e) {
				if (!$this->arrayHasMarket($selectedMarkets, $e))
					$this->removeMarket($media, $e);
			}
			
			// Agregar los markets que falten
			foreach ($selectedMarkets as $e) {
				if (!$this->arrayHasMarket($associatedMarkets, $e))
					$this->addMarket($media, $e);
			}
			
			/*$media = MediaPeer::get($_POST["mediaId"]);
			$smarty->assign('media', $media);
			$smarty->assign('mediaMarkets', MediaMarketQuery::create()->find());*/
		}

		return $mapping->findForwardConfig('success');
	}

}