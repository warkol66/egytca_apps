<?php

/**
 * BaseListAction
 *
 * Accion generica para obtener un listado de objetos
 *
 */

class BaseListAction extends BaseAction {

	private $entityClassName;
	protected $smarty;
	protected $ajaxTemplate;
	protected $filters;
	protected $query;
	protected $results;
	protected $pager;
	protected $page;
	protected $perPage;
	protected $forwardName = "success";
	protected $forwardFailureName = "failure";

	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)) . 'X.tpl';
		else
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)) . '.tpl';
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		// Verificamos la existencia de la clase de la que se obtendra la coleccion
		if (class_exists($this->entityClassName)) {

			$this->query = BaseQuery::create($this->entityClassName);

			// Acciones a ejecutar antes de obtener la coleccion de objetos
			// Si el preList devuelve false, se retorna $mapping->findForwardConfig('failure')
			if ($this->preList() === false)
				return $mapping->findForwardConfig('failure');

			if (!$this->notPaginated) {
				$this->smarty->assign("moduleConfig", Common::getModuleConfiguration($this->module));

				if (!isset($this->perPage) || $this->perPage < 1)
					$this->perPage = Common::getRowsPerPage($this->module);

				$this->page = $request->getParameter("page");
				$this->pager = $this->query->createPager($this->filters, $this->page, $this->perPage);
				$this->results = $this->pager->getResults();
				$this->smarty->assign("pager",$this->pager);
			}
			else
				$this->results = $this->query->setFormatter(ModelCriteria::FORMAT_ON_DEMAND)->addFilters($this->filters)->find();

			// Acciones a ejecutar despues de obtener la coleccion de objetos
			$this->postList();

			$this->smarty->assign(lcfirst($this->entityClassName) . "Coll", $this->results);
			return $mapping->findForwardConfig($this->forwardName);
		}
		else
			return $mapping->findForwardConfig($this->forwardFailureName);

	}


	/**
	 * preList
	 * Acciones a ejecutar antes de obtener la coleccion de objetos
	 */
	protected function preList() {

		// Informacion de filtros
		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST["filters"];
		if (isset($_REQUEST["page"]) && $_REQUEST["page"] > 0)
			$this->params["page"] = $_REQUEST["page"];

	}

	/**
	 * postList
	 * Acciones a ejecutar despues de obtener la coleccion de objetos
	 */
	protected function postList() {

		// Informacion para armar los links de paginador
		$url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
		foreach ($this->filters as $key => $value)
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$this->smarty->assign("url",$url);
		$this->smarty->assign("filters", $this->filters);
		$this->smarty->assign("page", $this->page);
		$this->smarty->assign("message", $_GET["message"]);
	}

}
