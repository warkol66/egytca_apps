<?php

class BaseDoDeleteAction extends BaseAction {
	
	private $entityClassName;
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

		try {
			$this->pre();
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax()) {
				throw $e; // Buscar una mejor forma de que falle AJAX
			} else {
				$smarty->assign('message', $e->getMessage());
				return $mapping->findForwardConfig('failure');
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
					$smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
				}
			}
			
		}

		try {
			$this->entity->delete();
		} catch (Exception $e) {
			if (ConfigModule::get("global","showPropelExceptions")){
				print_r($e->__toString());
			}
		}
		
		if ($this->entity->isDeleted())
			return $mapping->findForwardConfig('success');
		else
			return $mapping->findForwardConfig('failure');

	}
	
	protected function pre() {
		// default: do nothing
	}
	
	protected function post() {
		// default: do nothing
	}
}
