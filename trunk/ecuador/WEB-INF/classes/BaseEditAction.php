<?php

class BaseEditAction extends BaseAction {
	
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

		try {
			if ($this->preEdit() === false)
				return $mapping->findForwardConfig('failure');
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
		if (isset($id)) {
			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($id);
			if (is_null($this->entity)) {
				//Elijo la vista basado en si es o no un pedido por AJAX
				if ($this->isAjax()) {
					$smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
//					throw new Exception(); // Buscar una mejor forma de que falle AJAX
				} else {
					$smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
				}
			}
			
		}
		else {
			$entityClassName = $this->entityClassName;
			$this->entity = new $entityClassName();
		}
		
		$this->postEdit();
		$smarty->assign(lcfirst(get_class($this->entity)), $this->entity);
		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);
		
		/*
		 * Elijo la vista basado en si es o no un pedido por AJAX
		 */
		if ($this->isAjax() && isset($this->ajaxTemplate)) {
			$smarty->display($this->ajaxTemplate);
		} else {
			return $mapping->findForwardConfig('success');
		}
	}
	
	protected function preEdit() {
		// default: do nothing
	}
	
	protected function postEdit() {
		// default: do nothing
	}
}
