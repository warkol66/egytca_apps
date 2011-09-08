<?php

class MediasDoRemoveMarketXAction extends BaseAction {

	function MediasDoRemoveMarketXAction() {
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

		if (!empty($_POST["mediaId"]) && !(empty($_POST["marketId"]))) {
		
			$media = MediaPeer::get($_POST["mediaId"]);
			$market = MediaMarketPeer::get($_POST["marketId"]);
			
			if (!empty($media) && !empty($market)) {

				$relation = MediaMarketsQuery::create()->filterByMedia($media)->filterByMediaMarket($market)->findOne();
				if (!empty($relation))
					try {
						$relation->delete();
						$smarty->assign('media',$media);
						$smarty->assign('mediaMarkets', MediaMarketQuery::create()->find());
						return $mapping->findForwardConfig('success');
					}
					catch (PropelException $exp) {
						if (ConfigModule::get("global","showPropelExceptions"))
							print_r($exp->getMessage());
				}
			}
		}

		$smarty->assign('errorTagId','categoryMsgField');
		return $mapping->findForwardConfig('failure');
	}

}

