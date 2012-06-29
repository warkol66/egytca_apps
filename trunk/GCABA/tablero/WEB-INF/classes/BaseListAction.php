<?php

class BaseListAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	
	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
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

		$this->preList();

		if (class_exists($this->entityClassName)) {

			$smarty->assign("moduleConfig", Common::getModuleConfiguration($this->module));

			$perPage = Common::getRowsPerPage($this->module);

			$pager = BaseQuery::create($this->entityClassName)->createPager($filters, $_GET["page"], $perPage);
	
			$smarty->assign(lcfirst($this->entityClassName) . "Coll", $pager->getResults());
			$smarty->assign("pager",$pager);
			$smarty->assign("filters", $filters);
			$url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
			foreach ($filters as $key => $value)
				$url .= "&filters[$key]=$value";
			$smarty->assign("url",$url);
	
			$smarty->assign("filters", $_GET["filters"]);
			$smarty->assign("page", $_GET["page"]);
			$smarty->assign("message", $_GET["message"]);
			
			$this->postList();
	
			return $mapping->findForwardConfig('success');
		}

	}
	
	protected function preList() {
		// default: do nothing
	}
	
	protected function postList() {
		// default: do nothing
	}
}
