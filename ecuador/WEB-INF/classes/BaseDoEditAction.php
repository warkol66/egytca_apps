<?php

/**
 * BaseListAction
 *
 * Accion generica para guardar un objeto
 *
 */

class BaseDoEditAction extends BaseAction {

	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $entityParams;
	protected $ajaxTemplate;
	protected $params;
	protected $filters;
	protected $actionLog;
	protected $createEntityLog;
	protected $forwardName = "success";
	protected $forwardFailureName = "failure-edit";

	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
		else
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)) . '.tpl';
	}

	public function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$this->entityParams = Common::addUserInfoToParams($_POST["params"]);

		$entityClassName = $this->entityClassName;
		$id = $request->getParameter("id");

		if (!empty($id)) {
			$this->entity = BaseQuery::create($entityClassName)->findOneById($id);
			if (empty($this->entity))
				return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping,'failure-list');
		}
		else
			$this->entity = new $entityClassName();

		try {
			// Acciones a ejecutar antes de actualizar el objeto
			// Si el preUpdate devuelve false, se retorna $this->returnFailure (del BaseAction)
			if ($this->preUpdate() === false)
				return $this->returnFailure($mapping, $this->smarty, $this->entity, $this->forwardFailureName);
			
			$this->entity->fromArray($this->entityParams,BasePeer::TYPE_FIELDNAME);

			// Acciones a ejecutar antes de actualizar el objeto
			$this->postUpdate();

			// Acciones a ejecutar antes de guardar el objeto
			$this->preSave();
			$action = $this->entity->isNew() ? 'create' : 'edit';
			$this->entity->save();

			$logSufix = ', ' . Common::getTranslation('action: '.$action, 'common');
			if ($this->actionLog && method_exists($this->entity, 'getLogData'))
				Common::doLog('success', $this->entity->getLogData() . $logSufix);

			$entityLogClassName = $this->entityClassName.'Log';
			$setEntityId = 'set'.$this->entityClassName.'id';
			if ($this->createEntityLog && class_exists($entityLogClassName)) {
				if (!$this->entity->isNew()) {
					$entityLog = new $entityLogClassName();
					$entityLog->fromJSON($this->entity->toJSON());
					$entityLog->setId(NULL);
					$entityLog->$setEntityId($id);
					$entityLog->save();
				}
			}

			// Acciones a ejecutar luego de guardar el objeto
			$this->postSave();
		} catch (Exception $e) {

			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax())
				return $this->returnAjaxFailure($e->getMessage());
			else {
				$this->onFailure($e);
				return $this->returnFailure($mapping, $this->smarty, $this->entity, $this->forwardFailureName);
			}
		}

		// Se agrega el Id del objeto guardado a los parametros de retorno
		$this->params["id"] = $this->entity->getId();

		// Elijo la vista basado en si es o no un pedido por AJAX
		if ($this->isAjax())
			$this->smarty->display($this->ajaxTemplate);
		else
			return $this->addParamsAndFiltersToForwards($this->params, $this->filters, $mapping, $this->forwardName);

	}

	/**
	 * Acciones a tomar despues de updatear el objeto pero antes de guardarlo
	 *
	 * $this->entity->updateRegions()
	 * // si updateRegions() lanza una excepcion se cancela el DoEdit con su mensaje de error
	 */
	protected function preSave() {

		if (!empty($_REQUEST["filters"]))
			$this->filters = $_REQUEST["filters"];
		if (isset($_REQUEST["page"]) && $_REQUEST["page"] > 0)
			$this->params["page"] = $_REQUEST["page"];

	}

	/**
	 * Acciones a tomar despues de guardar el objeto
	 */
	protected function postSave() {
		// default: do nothing
	}

	/**
	 * Chequeos previos al update del objeto (update de datos sin guardarlos)
	 * Example:
	 *
	 * if (!checkOk())
	 *	throw new Exception('error XXX');
	 */
	protected function preUpdate() {
		// default: do nothing
	}

	/**
	 * Acciones a tomar despues de guardar el objeto
	 */
	protected function postUpdate() {
		// default: do nothing
	}

	/**
	 * onFailure
	 * Asigna al smarty el objeto con errores y los errores para su edicion
	 */
	protected function onFailure($e) {
		$this->entity->fromArray($this->entityParams,BasePeer::TYPE_FIELDNAME);
		$this->smarty->assign('entity', $this->entity);
		$this->smarty->assign('errorMessage', $e->getMessage());
	}
	
}
