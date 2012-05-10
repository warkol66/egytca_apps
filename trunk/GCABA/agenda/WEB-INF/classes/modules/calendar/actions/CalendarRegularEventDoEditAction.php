<?php

class BaseDoEditAction extends BaseAction {
	
	private $entityClassName;
	protected $entity;
	protected $entityParams;
	
	function __construct($entityClassName) {
		$this->entityClassName = $entityClassName;
	}
	
	public function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if ($_POST["page"] > 0)
			$params["page"] = $_POST["page"];

		if (!empty($_POST["filters"]))
			$filters = $_POST["filters"];

		$userParams = Common::userInfoToDoLog();
		$this->entityParams = array_merge_recursive($_POST["params"], $userParams);

		if (!empty($_POST["id"])) { // Existing entity

			$this->entity = BaseQuery::create($this->entityClassName)->findOneById($_POST['id']);
			$this->preUpdate();
			$this->entity = Common::setObjectFromParams($this->entity, $this->entityParams);
			
			if ($this->entity->isModified() && !$this->entity->save()) 
				return $this->returnFailure($mapping, $smarty, $this->entity,'failure');

		} else { // New entity
			$entityClassName = $this->entityClassName;
			$this->entity = new $entityClassName();
			$this->preUpdate();
			$this->entity = Common::setObjectFromParams($this->entity, $this->entityParams);
			
			if (!$this->entity->save())
				return $this->returnFailure($mapping, $smarty, $this->entity);
		}
		
		$params["id"] = $this->entity->getId();
		
		$this->postUpdate();
		
		return $this->addParamsAndFiltersToForwards($params, $filters, $mapping,'success-edit');
	}
	
	protected function preUpdate() {
		// default: do nothing
	}
	
	protected function postUpdate() {
		// default: do nothing
	}
}

class CalendarRegularEventDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('CalendarRegularEvent');
	}
	
	protected function preUpdate() {
		parent::preUpdate();
		$this->entityParams['date'] = Datetime::createFromFormat('d/m', $this->entityParams['date'])->format('m/d');
	}
}
