<?php
class MediasDoAddMarketXAction extends BaseAction {

	function MediasDoAddMarketXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Medias";
		
		$media = MediaPeer::get($_POST["mediaId"]);
		$market = MediaMarketPeer::get($_POST["marketId"]);
		
		if (!empty($media) && !empty($market)) {
			if (!($media->hasMediaMarket($market))) {
				$media->addMediaMarket($market);
				if (!$media->save()) {
					$smarty->assign('message', 'failure');
					return $mapping->findForwardConfig('success');
				} 
			}
		}
		else {
			$smarty->assign('message', 'failure');
			return $mapping->findForwardConfig('success');
		}

		$smarty->assign('media', $media);
		$smarty->assign('mediaMarkets', MediaMarketQuery::create()->find());
		$smarty->assign('message', 'success');

		return $mapping->findForwardConfig('success');
	}
}
