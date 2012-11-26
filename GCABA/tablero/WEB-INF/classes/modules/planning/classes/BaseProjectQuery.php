<?php

class BaseProjectQuery {
	
	private $planningProjectQuery;
	private $planningConstructionQuery;
	
	public function __construct($modelAlias = null, $criteria = null) {
		$this->planningProjectQuery = PlanningProjectQuery::create($modelAlias, $criteria);
		$this->planningConstructionQuery = PlanningConstructionQuery::create($modelAlias, $criteria);
	}
	
	public function __call($name, $params) {
		if (!method_exists($this, $name)) {
			call_user_func_array(array($this->planningProjectQuery, $name), $params);
			call_user_func_array(array($this->planningConstructionQuery, $name), $params);
		}
		return $this;
	}
	
	public static function create($modelAlias = null, $criteria = null) {
		return new self($modelAlias, $criteria);
	}
	
	public function find() {
		$all = new PropelObjectCollection();
		foreach ($this->planningProjectQuery->find() as $e)
			$all->append($e);
		foreach ($this->planningConstructionQuery->find() as $e)
			$all->append($e);
		
		return $all;
	}
	
	public function count() {
		return $this->planningProjectQuery->count()
			+ $this->planningConstructionQuery->count();
	}
}