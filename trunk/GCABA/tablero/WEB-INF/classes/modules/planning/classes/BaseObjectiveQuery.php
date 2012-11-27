<?php

class BaseObjectiveQuery {
	
	private $impactObjectiveQuery;
	private $ministryObjectiveQuery;
	private $operativeObjectiveQuery;
	
	public function __construct($modelAlias = null, $criteria = null) {
		$this->impactObjectiveQuery = ImpactObjectiveQuery::create($modelAlias, $criteria);
		$this->ministryObjectiveQuery = MinistryObjectiveQuery::create($modelAlias, $criteria);
		$this->operativeObjectiveQuery = OperativeObjectiveQuery::create($modelAlias, $criteria);
	}
	
	public function __call($name, $params) {
		if (!method_exists($this, $name)) {
			call_user_func_array(array($this->impactObjectiveQuery, $name), $params);
			call_user_func_array(array($this->ministryObjectiveQuery, $name), $params);
			call_user_func_array(array($this->operativeObjectiveQuery, $name), $params);
		}
		return $this;
	}
	
	public static function create($modelAlias = null, $criteria = null) {
		return new self($modelAlias, $criteria);
	}
	
	public function find() {
		$all = new PropelObjectCollection();
		foreach ($this->impactObjectiveQuery->find() as $e)
			$all->append($e);
		foreach ($this->ministryObjectiveQuery->find() as $e)
			$all->append($e);
		foreach ($this->operativeObjectiveQuery->find() as $e)
			$all->append($e);
		
		return $all;
	}
	
	public function findOne() {
		if ($this->impactObjectiveQuery->count())
			return $this->impactObjectiveQuery->findOne();
		elseif ($this->ministryObjectiveQuery->count())
			return $this->ministryObjectiveQuery->findOne();
		else
			return $this->operativeObjectiveQuery->findOne();
	}
	
	public function count() {
		return $this->impactObjectiveQuery->count()
			+ $this->ministryObjectiveQuery->count()
			+ $this->operativeObjectiveQuery->count();
	}
}