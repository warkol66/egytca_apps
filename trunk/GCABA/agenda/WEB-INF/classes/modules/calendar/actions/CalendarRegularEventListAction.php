<?php

class CalendarRegularEventListAction extends BaseAction {

	function CalendarRegularEventListAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {
		
		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		
		$filters = $_GET["filters"];
		$pager = BaseQuery::create('CalendarRegularEvent')->createPager($filters, $_GET["page"], $filters["perPage"]);
		
		$smarty->assign("filters",$filters);
		$smarty->assign('entities',$pager->getResults());
		$smarty->assign("pager",$pager);

		$url = "Main.php?do=calendarRegularEventList";
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("message",$_GET["message"]);
		
		$today = new DateTime();
		$uninstantiatedThisYear = CalendarRegularEvent::getUninstantiated($today->format('Y'));
		$holidayCreationYear = !empty($uninstantiatedThisYear) ? $today->format('Y') : $today->format('Y')+1;
		$smarty->assign('holidayCreationYear', $holidayCreationYear);
		
		$this->template->template = 'TemplateJQuery.tpl';
		return $mapping->findForwardConfig('success');
	}

}