<?php

class BaseDoDeleteAction extends BaseAction {
	
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

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		try {
			$this->preDelete();
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax()) {
				throw $e; // Buscar una mejor forma de que falle AJAX
			} else {
				$this->smarty->assign('message', $e->getMessage());
				return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'failure');
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
					return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success');
				}
			}
			
		}
        
		try {
			$this->entity->delete();
            $this->postDelete();
						return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success');
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}
		
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'failure');

//		try {
//			$this->entity->delete();
//		} catch (Exception $e) {
//			if (ConfigModule::get("global","showPropelExceptions")){
//				print_r($e->__toString());
//            }
//		}
//	
//		$this->postDelete();
//
//		if ($this->entity->isDeleted())
//			return $mapping->findForwardConfig('success');
//		else
//			return $mapping->findForwardConfig('failure');
	}
	
	protected function preDelete() {
		// default: do nothing
	}
	
	protected function postDelete() {
		// default: do nothing
	}
}
