<?php


class MediasEditAction extends BaseAction {

	function prepareEdit($smarty, $media) {

		$mediaMarkets = MediaMarketQuery::create()->find();
		$smarty->assign('mediaMarkets',$mediaMarkets);

		$mediaAudiences = MediaAudienceQuery::create()->find();
		$smarty->assign('mediaAudiences',$mediaAudiences);

		$mediaTypes = MediaTypeQuery::create()->find();
		$smarty->assign("mediaTypes",$mediaTypes);
		
		$allAlias = MediaQuery::create()->filterByAliasof($media->getId())->find();
		$smarty->assign('allAlias', $allAlias);
		
		$availableMedias = MediaQuery::create()
			->filterByAliasof(null)
			->filterById($media->getId(), Criteria::NOT_EQUAL)
			->find();
		$smarty->assign('availableMedias', $availableMedias);

	}

	function MediasEditAction() {
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
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if (!empty($_GET["id"])) {
			//voy a editar un objeto
			$media = MediaQuery::create()->findPK($_GET["id"]);
			if (empty($media))
				$smarty->assign("notValidId",true);
			else
				$smarty->assign("media",$media);
		}
		else
			//voy a crear un objeto nuevo
			$media = new Media();

		$smarty->assign("media",$media);

		$smarty->assign("filters",$_GET["filters"]);
		$smarty->assign("page",$_GET["page"]);
		$smarty->assign("message",$_GET["message"]);

		$this->prepareEdit($smarty, $media);

		return $mapping->findForwardConfig('success');
	}

}
