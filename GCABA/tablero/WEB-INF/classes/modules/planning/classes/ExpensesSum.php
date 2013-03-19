<?php

class ExpensesSum {
	
	protected $entityName;
	protected $sumByType;
	static protected $budgetFields = array(
		'sanctioned', 'active', 'restricted', 'preventive',
		'definitive', 'accrued', 'available', 'paid'
	);
	
	public function __construct($entityName, $budgetRelations) {
		$this->entityName = $entityName;
		$this->calculateSumByType($budgetRelations);
	}
	
	public function getEntityName() {
		return $this->entityName;
	}
	
	public function __call($name, $arguments) {
		// getXxx() para todos los valores
		$budgetField = strtolower(preg_replace("/^get/", '', $name));
		if (in_array($budgetField, self::$budgetFields))
			return $this->sumByType[$budgetField];
	}
	
	/**
	 * Total of the $expensesSums
	 * @param type $expensesSums
	 * @return type
	 */
	public static function total($expensesSums) {
		$total = array();
		foreach (self::$budgetFields as $budgetField) {
			foreach ($expensesSums as $expensesSum) {
				$getFieldMethod = "get$budgetField";
				$total[$budgetField] += $expensesSum->$getFieldMethod();
			}
		}
		return $total;
	}
	
	private function calculateSumByType($budgetRelations) {
		$this->sumByType = array();
		foreach ($budgetRelations as $budgetRelation) {
			foreach (self::$budgetFields as $budgetField) {
				$getFieldMethod = "get$budgetField";
				$this->sumByType[$budgetField] += $budgetRelation->$getFieldMethod();
			}
		}
	}
	
	
	// DELETEME
	static function createRandomBudgetRelation() {
		$budgetRelation = new BudgetRelation();
		foreach (self::$budgetFields as $budgetField) {
			$setFieldMethod = "set$budgetField";
			$budgetRelation->$setFieldMethod(rand(0, 9));
		}
		return $budgetRelation;
	}
}

class RelativeExpensesSum extends ExpensesSum {
	
	/**
	 * Returns a collection of RelativeExpensesSums created from $absoluteExpensesSums
	 */
	public static function absoluteToRelative($absoluteExpensesSums) {
		$relativeExpensesSums = array();
		$total = self::total($absoluteExpensesSums);
		foreach ($absoluteExpensesSums as $absoluteExpensesSum) {
			$relativeExpensesSum = new RelativeExpensesSum();
			$relativeExpensesSum->entityName = $absoluteExpensesSum->entityName;
			foreach (parent::$budgetFields as $budgetField) {
				if ($total[$budgetField] != 0) { // avoid zero division
					$relativeValue = $absoluteExpensesSum->sumByType[$budgetField] * 100 / $total[$budgetField];
					$relativeExpensesSum->sumByType[$budgetField] = $relativeValue;
				} else {
					$relativeExpensesSum->sumByType[$budgetField] = 0; // if total is 0, all parts are 0
				}
			}
			$relativeExpensesSums[] = $relativeExpensesSum;
		}
		
		return $relativeExpensesSums;
	}
}
