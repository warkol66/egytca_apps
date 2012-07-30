<?php

class BaseDoEditAction extends BaseAction {

	private $entityClassName;
	protected $smarty;
	protected $entity;
	protected $entityParams;
	protected $ajaxTemplate;

	function __construct($entityClassName) {
		if (empty($entityClassName))
			throw new Exception('$entityClassName must be set');
		$this->entityClassName = $entityClassName;
		if (substr(get_class($this), -7, 1) != "X")
			$this->ajaxTemplate = str_replace('Action', '', get_class($this)).'X.tpl';
	}

	public function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$this->smarty =& $smarty;

		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$this->entityParams = Common::addUserInfoToParams($_POST["params"]);

		$entityClassName = $this->entityClassName;
		$id = $request->getParameter("id");
	
		if (!empty($id)) {
			$this->entity = BaseQuery::create($entityClassName)->findOneById($id);
			if (empty($this->entity))
				return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'failure-list');
		}
		else
			$this->entity = new $entityClassName();

		try {
			$this->preUpdate();
			$this->entity->fromArray($this->entityParams,BasePeer::TYPE_FIELDNAME);
			$this->preSave();
			$this->entity->save();
			$action = empty($id) ? 'create' : 'edit';
			$logSufix = ', ' . Common::getTranslation('action: '.$action, 'common');
			Common::doLog('success', $this->entity . $logSufix); // use primary string
			$this->postSave();
		} catch (Exception $e) {
			
			//Elijo la vista basado en si es o no un pedido por AJAX
			if ($this->isAjax()) {
				return $this->returnAjaxFailure($e->getMessage());
			} else {
				$this->onFailure($e);
				return $this->returnFailure($mapping, $smarty, $this->entity, 'failure-edit');
			}
		}

		$params["id"] = $this->entity->getId();
		$this->postUpdate();

		/*
		 * Elijo la vista basado en si es o no un pedido por AJAX
		 */
		if ($this->isAjax()) {
			$smarty->display($this->ajaxTemplate);
		} else {
			return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');
		}
	}

	/**
	 * Acciones a tomar despues de updatear el objeto pero antes de guardarlo
	 * 
	 * $this->entity->updateRegions()
	 * // si updateRegions() lanza una excepcion se cancela el DoEdit con su mensaje de error
	 */
	protected function preSave() {
		// default: do nothing
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

	protected function onFailure($e) {
		$this->entity->fromArray($this->entityParams,BasePeer::TYPE_FIELDNAME);
		$this->smarty->assign('entity', $this->entity);
		$this->smarty->assign('errorMessage', $e->getMessage());
	}
}