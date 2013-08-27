<?php

class RegionsDoAddNeighborXAction extends BaseAction {

	function RegionsDoEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);
		
		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Regions";
		
		if(isset($_POST['regionId']) && isset($_POST['neighborId'])){
			
			$duplicateReg = RegionNeighborQuery::create()->filterByRegionId($_REQUEST['regionId'])->filterByNeighborId($_REQUEST['neighborId'])->findOne();
			$duplicateNeigh = RegionNeighborQuery::create()->filterByRegionId($_REQUEST['neighborId'])->filterByNeighborId($_REQUEST['regionId'])->findOne();
			
			if(is_object($duplicateReg) || is_object($duplicateNeigh)){
				$smarty->assign('message','duplicate');
				return $mapping->findForwardConfig('success');
			}
			
			$neighbor = new RegionNeighbor();
			$neighbor->setRegionId($_REQUEST['regionId']);
			$neighbor->setNeighborId($_REQUEST['neighborId']);
			$neighbor->save();
			
			$smarty->assign('region',RegionQuery::create()->filterById($_REQUEST['regionId'])->findOne());
			$smarty->assign('newNeighbor',RegionQuery::create()->filterById($_REQUEST['neighborId'])->findOne());
			/*$newNeighbor = RegionQuery::create()->filterById($_REQUEST['regionId'])->findOne();
			print_r()
			echo $newNeighbor->getId();
			die();*/
			
			return $mapping->findForwardConfig('success');
			
		}else{
			
			$smarty->assign('errorNeighborId','neighborMsgField');
			$smarty->assign('message','Puede que alguna de las regiones haya sido eliminada. Refresque la página para asegurarse');
			return $mapping->findForwardConfig('success');
		}

	}

}
