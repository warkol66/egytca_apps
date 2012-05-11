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
		$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$this->smarty =& $smarty;

		$module = "Calendar";
		$smarty->assign("module", $module);

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
		
		if (!empty($_GET["id"])) {
			//voy a editar un objeto
			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($_GET['id']);
			if (is_null($this->entity)) {
				//Elijo la vista basado en si es o no un pedido por AJAX
				if ($this->isAjax()) {
					throw new Exception(); // Buscar una mejor forma de que falle AJAX
				} else {
					$smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
				}
			}
			$smarty->assign("action", "edit");
			
		} else {
			//voy a crear un objeto nuevo
			$entityClassName = $this->entityClassName;
			$this->entity = new $entityClassName();
			$smarty->assign("action", "create");
		}
		
		$this->post();
		$smarty->assign("entity", $this->entity);
		$smarty->assign("filters", $_GET["filters"]);
		$smarty->assign("page", $_GET["page"]);
		$smarty->assign("message", $_GET["message"]);
		
		/*
		 * Elijo la vista basado en si es o no un pedido por AJAX
		 */
		if ($this->isAjax()) {
			$smarty->display($this->ajaxTemplate);
		} else {
			return $mapping->findForwardConfig('success');
		}
	}
	
	protected function pre() {
		// default: do nothing
	}
	
	protected function post() {
		// default: do nothing
	}
}
