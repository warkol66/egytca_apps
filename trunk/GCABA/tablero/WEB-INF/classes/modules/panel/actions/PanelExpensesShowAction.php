<?php

class PanelExpensesShowAction extends BaseAction {
	
	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Panel";
		$section = "Strategic Vision";

		$smarty->assign("module",$module);
		$smarty->assign("section",$section);
		
		
		/* ***************** regionsExpenses ****************** */
		$regionsExpenses = array();
		$regions = RegionQuery::create()->filterByType(RegionPeer::COMMUNE)->find();
		foreach ($regions as $region) {
			
			//----------------------------------------------------------------
			/* las regiones tienen planningConstructions, pero las planningConstructions para conseguir
			 * las budgetRelations filtran por el planningProject asociado a la planningConstruction.
			 * No se repiten?
			 */
			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation(), ExpensesSum::createRandomBudgetRelation()); // TODO: conseguir budgetRelations para la region
			//----------------------------------------------------------------
			
			$regionExpenses = new ExpensesSum($region->getName(), $budgetRelations);
			$regionsExpenses[] = $regionExpenses;
		}
		
		$regionsExpensesTotal = ExpensesSum::total($regionsExpenses);
		
		$smarty->assign('regionsExpenses', $regionsExpenses);
		$smarty->assign('regionsExpensesTotal', $regionsExpensesTotal);
		/* ************** fin regionsExpenses ***************** */
		
		
		/* **************** ministriesExpenses **************** */
		$ministriesExpenses = array();
		$ministries = PositionQuery::findMinistries();
		foreach ($ministries as $ministry) {
			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation()); // TODO: conseguir budgetRelations para la region
			
			$ministryExpenses = new ExpensesSum($ministry->getName(), $budgetRelations);
			$ministriesExpenses[] = $ministryExpenses;
		}
		
		$ministriesExpensesTotal = ExpensesSum::total($ministriesExpenses);
		
		$smarty->assign('ministriesExpenses', $ministriesExpenses);
		$smarty->assign('ministriesExpensesTotal', $ministriesExpensesTotal);
		/* ************* fin ministriesExpenses *************** */
		
		
		/* **************** operativeObjectives *************** */
		$operativeObjectivesExpenses = array();
		$operativeObjectives = OperativeObjectiveQuery::create()->find();
		foreach ($operativeObjectives as $operativeObjective) {
			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation()); // TODO: conseguir budgetRelations para la region
			
			$operativeObjectiveExpenses = new ExpensesSum($operativeObjective->getName(), $budgetRelations);
			$operativeObjectivesExpenses[] = $operativeObjectiveExpenses;
		}
		
		$operativeObjectivesExpensesTotal = ExpensesSum::total($operativeObjectivesExpenses);
		
		$smarty->assign('operativeObjectivesExpenses', $operativeObjectivesExpenses);
		$smarty->assign('operativeObjectivesExpensesTotal', $operativeObjectivesExpensesTotal);
		/* ************* fin operativeobjectives ************** */
		
		
		/* ***************** impactObjectives ***************** */
		$impactObjectivesExpenses = array();
		$impactObjectives = ImpactObjectiveQuery::create()->find();
		foreach ($impactObjectives as $impactObjective) {
			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation()); // TODO: conseguir budgetRelations para la region
			
			$impactObjectiveExpenses = new ExpensesSum($impactObjective->getName(), $budgetRelations);
			$impactObjectivesExpenses[] = $impactObjectiveExpenses;
		}
		
		$impactObjectivesExpensesTotal = ExpensesSum::total($impactObjectivesExpenses);
		
		$smarty->assign('impactObjectivesExpenses', $impactObjectivesExpenses);
		$smarty->assign('impactObjectivesExpensesTotal', $impactObjectivesExpensesTotal);
		/* ************** fin impactObjectives **************** */
		
		
		/* **************** ministryObjectives **************** */
		$ministryObjectivesExpenses = array();
		$ministryObjectives = MinistryObjectiveQuery::create()->find();
		foreach ($ministryObjectives as $ministryObjective) {
			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation()); // TODO: conseguir budgetRelations para la region
			
			$ministryObjectiveExpenses = new ExpensesSum($ministryObjective->getName(), $budgetRelations);
			$ministryObjectivesExpenses[] = $ministryObjectiveExpenses;
		}
		
		$ministryObjectivesExpensesTotal = ExpensesSum::total($ministryObjectivesExpenses);
		
		$smarty->assign('ministryObjectivesExpenses', $ministryObjectivesExpenses);
		$smarty->assign('ministryObjectivesExpensesTotal', $ministryObjectivesExpensesTotal);
		/* ************* fin ministryObjectives *************** */
		
		
		return $mapping->findForwardConfig('success');
	}
}

// TODO: mover
class ExpensesSum {
	
	private $entityName;
	private $sumByType;
	static private $budgetFields = array(
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
