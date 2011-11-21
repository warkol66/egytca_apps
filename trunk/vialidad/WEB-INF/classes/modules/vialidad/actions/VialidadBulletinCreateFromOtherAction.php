<?php

class VialidadBulletinCreateFromOtherAction extends BaseAction {

	function VialidadBulletinCreateFromOtherAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "Bulletin";
		$smarty->assign("section",$section);
		
		$last = BulletinQuery::create()->orderByBulletindate(Criteria::DESC)->findOne();
		$last->setNumber($last->getNumber()+1);
		$date = $last->getBulletindate('%m/%d/%Y');
		$last->setBulletindate(date('d-m-Y',strtotime("$date +1 month")));
		$last->setComments(null);
		$last->setPublished(false);
		
		$new = new Bulletin();
		$last->copyInto($new);
		
		$smarty->assign('lastBulletinId', $last->getId());
		$smarty->assign('bulletin', $new);
		
		return $mapping->findForwardConfig('success');		
	}

}
