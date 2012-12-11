<?php

/**
 * BaseListAction
 *
 * Accion generica para eliminar un objeto
 *
 */

class BaseDoDeleteAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	protected $filters;
	
	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
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
			// Acciones a ejecutar despues de eliminar el objeto
			// Si el preDelete devuelve false, se retorna failure
			if ($this->preDelete() === false)
				return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping, 'failure');
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax()) {
				throw $e; // Buscar una mejor forma de que falle AJAX
			} else {
				$this->smarty->assign('message', $e->getMessage());
				return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping,'failure');
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
					$this->smarty->assign("notValid",true);
					return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping,'success');
				}
			}
			
		}
        
		try {
			$this->entity->delete();

			// Acciones a ejecutar despues de eliminar el objeto
			$this->postDelete();
			return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping,'success');
		} catch (Exception $e) {
			echo($e->__toString());
			die();
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}

		return $this->addParamsAndFiltersToForwards($params, $this->filters, $mapping,'failure');
	}
	
	/**
	 * preDelete
	 * Acciones a tomar despues de eliminar el objeto
	 */
	protected function preDelete() {

		// Informacion de filtros
		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST['filters'];

	}
	
	/**
	 * postDelete
	 * Acciones a tomar despues de eliminar el objeto
	 */
	protected function postDelete() {
		// default: do nothing
	}
}
