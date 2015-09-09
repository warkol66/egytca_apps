<?php

/**
 * BasedoDeleteAction
 *
 * Accion generica para eliminar un objeto
 *
 */

class BaseDoDeleteAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	protected $params;
	protected $filters;
	protected $actionLog;
	protected $page;
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

		BaseAction::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		try {
			// Acciones a ejecutar antes de eliminar el objeto
			// Si el preDelete devuelve false, se retorna failure
			if ($this->preDelete() === false)
				return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping, $this->forwardFailureName);
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax()) {
				throw $e; // Buscar una mejor forma de que falle AJAX
			} else {
				$this->smarty->assign('message', $e->getMessage());
				return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping, $this->forwardFailureName);
			}
		}
		
		$id = $request->getParameter("id");
		if (!empty($id)) {
			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($id);
			if (is_null($this->entity)) {
				//Elijo la vista basado en si es o no un pedido por AJAX
				if ($this->isAjax()) {
					throw new Exception(); // Buscar una mejor forma de que falle AJAX
				} else {
					$this->smarty->assign('notValidId', 'true');
					return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping, $this->forwardName);
				}
			}
			
		}
        
		try {

			$this->entity->delete();
			$action = 'delete';
			$logSufix = ', ' . Common::getTranslation('action: '.$action, 'common');
			if ($this->actionLog && method_exists($this->entity, 'getLogData'))
				Common::doLog('success', $this->entity->getLogData() . $logSufix);

			// Acciones a ejecutar despues de eliminar el objeto
			$this->postDelete();
			return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping, $this->forwardName);
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping, $this->forwardFailureName);
	}
	
	/**
	 * preDelete
	 * Acciones a tomar antes de eliminar el objeto
	 */
	protected function preDelete() {

		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST["filters"];
		if (isset($_REQUEST["page"]) && $_REQUEST["page"] > 0)
			$this->params["page"] = $_REQUEST["page"];

	}
	
	/**
	 * postDelete
	 * Acciones a tomar despues de eliminar el objeto
	 */
	protected function postDelete() {
		// default: do nothing
	}

}
