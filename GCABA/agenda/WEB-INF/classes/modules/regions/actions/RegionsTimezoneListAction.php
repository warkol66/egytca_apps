<?php

class RegionsTimezoneListAction extends BaseAction {

	function RegionsTimezoneListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "RegionsTimezone";
		$smarty->assign("module",$module);

		$RegionTimezonePeer = new RegionTimezonePeer();

		$regionTypes = $RegionTimezonePeer->getRegionTypesTranslated();
		$smarty->assign("regionTypes",$regionTypes);

		if (isset($_GET['filters'])) {

			$filters = $_GET['filters'];
			$smarty->assign('filters',$filters);

			foreach(array_keys($RegionTimezonePeer->filterConditions) as $filterKey) {

				if (isset($filters[$filterKey])) {
					//obtengo el metodo de la condicion de filtrado a ejecutar
					$filterMethod = $RegionTimezonePeer->filterConditions[$filterKey];
					//ejecuto el metodo que agrega la condicion
					$RegionTimezonePeer->$filterMethod($filters[$filterKey]);

				}
			}
		}


		$pager = $RegionTimezonePeer->getAllPaginatedFiltered($_GET["page"]);
		$smarty->assign("regionstimezone",$pager->getResult());
		$smarty->assign("pager",$pager);
		$url = "Main.php?do=regionsTimezoneList";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);

		return $mapping->findForwardConfig('success');
	}

}


