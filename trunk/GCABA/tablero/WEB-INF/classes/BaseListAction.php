<?php

class BaseListAction extends BaseAction {
	
	private $entityClassName;
	private $module;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	
	function __construct($entityClassName,$module) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		$this->module = $module;
		$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$this->smarty =& $smarty;

		$smarty->assign("module", $this->module);

		$pager = BaseQuery::create($this->entityClassName)->createPager($filters, $page, $perPage);

		$smarty->assign(lcfirst($this->entityClassName) . "Coll", $pager->getResults());
		$smarty->assign("pager",$pager);
		$smarty->assign("filters", $filters);

		$this->post();

		$url = "Main.php?" . "do=" . lcfirst(str_replace('Action', '', get_class($this)));
		if (isset($_GET['page']))
			$url .= '&page=' . $_GET['page'];
		foreach ($filters as $key => $value)
			$url .= "&filters[$key]=$value";
		$smarty->assign("url",$url);

		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);
		
		return $mapping->findForwardConfig('success');

	}
	
	protected function pre() {
		// default: do nothing
	}
	
	protected function post() {
		// default: do nothing
	}
}
