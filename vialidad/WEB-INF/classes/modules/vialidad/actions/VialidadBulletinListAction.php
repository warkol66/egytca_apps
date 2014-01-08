<?php

class VialidadBulletinListAction extends BaseAction {

	function VialidadBulletinListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$module = 'Vialidad';
		$smarty->assign('module',$module);

		$filters = $_GET["filters"];

    if (!isset($filters["perPage"]))
			$filters["perPage"] = Common::getRowsPerPage();

		$pager = BulletinQuery::create()->orderByNumber('desc')->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$smarty->assign("filters",$filters);
		$smarty->assign('bulletins',$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=vialidadBulletinList";
		foreach ($filters as $key => $value)
			if(is_array($value)) {
				$nKey = $key;
				foreach ($value as $key => $value)
					$url .= "&filters[$nKey][$key]=" . htmlentities(urlencode($value));
			}
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		return $mapping->findForwardConfig('success');
	}
	
}
