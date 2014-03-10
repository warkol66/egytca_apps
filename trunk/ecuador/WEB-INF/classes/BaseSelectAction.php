<?php
/**
 * Meta clase de obtencion de un objeto de la base de datos
 *
 * @author Modulos Empresarios / Egytca
 * @package phpMVC
 */

/**
 * BaseSelectAction
 *
 * Accion generica para obtener un objeto
 */
class BaseSelectAction extends BaseAction {
	
	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $ajaxTemplate;
	protected $filters;
	
	/**
	 * Constructor
	 *
	 * @param string $entityClassName Nombre de la clase que representa la entidad que se va a seleccionar
	 */
	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
		else
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)) . '.tpl';
	}

	/**
	 * Execute
	 * @see BaseAction::execute()
	 */
	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		try {
			// Acciones a ejecutar antes de obtener el objeto
			// Si el preSelect devuelve false, se retorna $mapping->findForwardConfig('failure')
			if ($this->preSelect() === false)
				return $mapping->findForwardConfig('failure');
		} catch (Exception $e) {
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax())
				throw $e; // Buscar una mejor forma de que falle AJAX
			else {
				$this->smarty->assign('message', $e->getMessage());
				return $mapping->findForwardConfig('failure');
			}
		}
		
		$id = $request->getParameter("id");
		if (isset($id)) {

			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($id);
			if (is_null($this->entity)) {
				//Elijo la vista basado en si es o no un pedido por AJAX
				if ($this->isAjax()) {
					$this->smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
				}
				else {
					$this->smarty->assign('notValidId', 'true');
					return $mapping->findForwardConfig('success');
				}
			}
			
		}
		else {
			$entityClassName = $this->entityClassName;
			$this->entity = new $entityClassName();
		}
		
		// Acciones a ejecutar despues de obtener el objeto
		$this->postSelect();

		// Asigno al template el objeto obtenido
		$this->smarty->assign(lcfirst(get_class($this->entity)), $this->entity);
		
		// Elijo la vista basado en si es o no un pedido por AJAX
		if ($this->isAjax() && isset($this->ajaxTemplate))
			$this->smarty->display($this->ajaxTemplate);
		else
			return $mapping->findForwardConfig('success');

	}
	
	/**
	 * Acciones a ejecutar antes de obtener el objeto
	 */
	protected function preSelect() {
		// default: do nothing
	}
	
	/**
	 * Acciones a ejecutar despues de obtener el objeto
	 */
	protected function postSelect() {
		// Envio al template parametros de busqueda, mensajes, etc.
		$this->smarty->assign("filters", $_GET["filters"]);
		$this->smarty->assign("page", $_GET["page"]);
		$this->smarty->assign("message", $_GET["message"]);
	}

}
