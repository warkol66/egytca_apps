<?php

/**
 * BaseEditAction
 *
 * Accion generica para obtener un objeto
 *
 */

class BaseEditAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	protected $filters;
	protected $forwardName = "success";
	protected $forwardFailureName = "failure";
	
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
			// Acciones a ejecutar antes de obtener el objeto
			// Si el preEdit devuelve false, se retorna $mapping->findForwardConfig('failure')
			if ($this->preEdit() === false)
				return $mapping->findForwardConfig('failure');
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax())
				throw $e; // Buscar una mejor forma de que falle AJAX
			else {
				$this->smarty->assign('message', $e->getMessage());
				return $mapping->findForwardConfig($this->forwardFailureName);
			}
		}
		
		$id = $request->getParameter("id");
		if (isset($id)) {

			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($id);
			if (is_null($this->entity)) {
				//Elijo la vista basado en si es o no un pedido por AJAX
				if ($this->isAjax()) {
					$this->smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig($this->forwardName);
				}
				else {
					$this->smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig($this->forwardName);
				}
			}
			
		}
		else {
			$entityClassName = $this->entityClassName;
			$this->entity = new $entityClassName();
		}
		
		// Acciones a ejecutar despues de obtener el objeto
		$this->postEdit();

		// Asigno al template el objeto obtenido
		$this->smarty->assign(lcfirst(get_class($this->entity)), $this->entity);
		
		// Elijo la vista basado en si es o no un pedido por AJAX
		if ($this->isAjax() && isset($this->ajaxTemplate))
			$this->smarty->display($this->ajaxTemplate);
		else
			return $mapping->findForwardConfig($this->forwardName);

	}
	
	/**
	 * preEdit
	 * Acciones a tomar antres de obtener el objeto
	 */
	protected function preEdit() {

		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST["filters"];
		if (isset($_REQUEST["page"]) && $_REQUEST["page"] > 0)
			$this->params["page"] = $_REQUEST["page"];

	}
	
	/**
	 * postEdit
	 * Acciones a tomar despues de obtener el objeto
	 */
	protected function postEdit() {

		// Informacion para armar los links de paginador
		$url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
		foreach ($this->filters as $key => $value)
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$this->smarty->assign("url",$url);
		// Envio al template parametros de busqueda, mensajes, etc.
		$this->smarty->assign("filters", $_GET["filters"]);
		$this->smarty->assign("page", $_GET["page"]);
		$this->smarty->assign("message", $_GET["message"]);
	}

}
