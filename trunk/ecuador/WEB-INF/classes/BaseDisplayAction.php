<?php
/**
 * Meta clase de muestra de informacion
 *
 * @author Modulos Empresarios / Egytca
 * @package phpMVC
 */

/**
 * BaseDisplayAction
 *
 * Accion generica para mostrar un template
 */
class BaseDisplayAction extends BaseAction {
	
	protected $smarty;
	protected $ajaxTemplate;
	protected $module;
	protected $filters;
	protected $forwardName = "success";
	protected $forwardFailureName = "failure";
	
	/**
	 * Constructor
	 */
	function __construct() {
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

		$this->mapping = $mapping;

		$plugInKey = 'SMARTY_PLUGIN';
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL)
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";

		try {
			// Acciones a ejecutar antes de generar el output
			// Si el preDisplay devuelve false, se retorna $mapping->findForwardConfig('failure')
			if ($this->preDisplay() === false)
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
		
		// Acciones a ejecutar despues de generar el diplay
		$this->postDisplay();

		// Elijo la vista basado en si es o no un pedido por AJAX
		if ($this->isAjax() && isset($this->ajaxTemplate))
			$this->smarty->display($this->ajaxTemplate);
		else
			return $mapping->findForwardConfig($this->forwardName);

	}
	
	/**
	 * Acciones a ejecutar antes generar el display
	 */
	protected function preDisplay() {
		$this->smarty->assign("module", $this->module);

		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST["filters"];
		if (isset($_REQUEST["page"]) && $_REQUEST["page"] > 0)
			$this->params["page"] = $_REQUEST["page"];

	}
	
	/**
	 * Acciones a ejecutar despues de generar el diplay
	 */
	protected function postDisplay() {

		// Informacion para armar los links de paginador
		$url = "Main.php?" . "do=" . lcfirst(substr_replace(get_class($this),'', strrpos(get_class($this), 'Action'), 6));
		foreach ($this->filters as $key => $value)
			$url .= "&filters[$key]=" . htmlentities(urlencode($value));
		$this->smarty->assign("url",$url);

		$this->smarty->assign("filters", $_GET["filters"]);
		$this->smarty->assign("page", $_GET["page"]);
		$this->smarty->assign("message", $_GET["message"]);
	}

}
