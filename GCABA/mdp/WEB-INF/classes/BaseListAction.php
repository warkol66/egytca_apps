<?php

class BaseListAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $ajaxTemplate;
	protected $query;
	protected $results;
	protected $pager;
	
	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$this->smarty =& $smarty;
		
		$this->query = BaseQuery::create($this->entityClassName);
		$this->preList();

		if (class_exists($this->entityClassName)) {

			if (!$this->notPaginated) {
	
				$smarty->assign("moduleConfig", Common::getModuleConfiguration($this->module));
	
				$perPage = Common::getRowsPerPage($this->module);
				$page = $request->getParameter("page");
				
				$this->pager = $this->query->createPager($this->filters, $page, $perPage);
				$this->results = $this->pager->getResults();
				
				$smarty->assign("pager",$this->pager);
			}
			else {
				$this->results = $this->query->addFilters($this->filters)->find();
			}

			$url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
			foreach ($this->filters as $key => $value)
				$url .= "&filters[$key]=$value";
			$smarty->assign("url",$url);
	
			$smarty->assign("filters", $this->filters);
			$smarty->assign("page", $page);
			$smarty->assign("message", $_GET["message"]);
			
			$this->postList();
			
			$smarty->assign(lcfirst($this->entityClassName) . "Coll", $this->results);
	
			return $mapping->findForwardConfig('success');
		}

	}
	
	protected function preList() {
		$this->filters = $_GET['filters'];
	}
	
	protected function postList() {
		// default: do nothing
	}
}
