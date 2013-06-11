<?php

require_once 'ExpensesSum.php';

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
		
		$regionsExpenses = $this->getRegionsExpenses();
		$regionsExpensesTotal = ExpensesSum::total($regionsExpenses);
		$smarty->assign('regionsExpenses', $regionsExpenses);
		$smarty->assign('regionsExpensesTotal', $regionsExpensesTotal);
		
		$ministriesExpenses = $this->getMinistriesExpenses();		
		$ministriesExpensesTotal = ExpensesSum::total($ministriesExpenses);
		$smarty->assign('ministriesExpenses', $ministriesExpenses);
		$smarty->assign('ministriesExpensesTotal', $ministriesExpensesTotal);
		
		$operativeObjectivesExpenses = $this->getOperativeObjectivesExpenses();
		$operativeObjectivesExpensesTotal = ExpensesSum::total($operativeObjectivesExpenses);
		$smarty->assign('operativeObjectivesExpenses', $operativeObjectivesExpenses);
		$smarty->assign('operativeObjectivesExpensesTotal', $operativeObjectivesExpensesTotal);
		
		$impactObjectivesExpenses = $this->getImpactObjectivesExpenses();
		$impactObjectivesExpensesTotal = ExpensesSum::total($impactObjectivesExpenses);
		$smarty->assign('impactObjectivesExpenses', $impactObjectivesExpenses);
		$smarty->assign('impactObjectivesExpensesTotal', $impactObjectivesExpensesTotal);
		
		$ministryObjectivesExpenses = $this->getMinistryObjectivesExpenses();
		$ministryObjectivesExpensesTotal = ExpensesSum::total($ministryObjectivesExpenses);
		$smarty->assign('ministryObjectivesExpenses', $ministryObjectivesExpenses);
		$smarty->assign('ministryObjectivesExpensesTotal', $ministryObjectivesExpensesTotal);
		
		$smarty->assign('updatedSigaf', BudgetRelationQuery::create()->orderByUpdatedsigaf(Criteria::DESC)->findOne()->getUpdatedsigaf());
		
		return $mapping->findForwardConfig('success');
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the Comunes
	 * @return array array of ExpensesSum
	 */
	function getRegionsExpenses() {
		$regions = RegionQuery::create()->filterByType(RegionPeer::COMMUNE)->find();
		return $this->getEntitiesExpenses($regions);
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the Ministries
	 * @return array array of ExpensesSum
	 */
	function getMinistriesExpenses() {
		$ministries = PositionQuery::findMinistries();
		return $this->getEntitiesExpenses($ministries);
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the OperativeObjectives
	 * @return array array of ExpensesSum
	 */
	function getOperativeObjectivesExpenses() {
		$operativeObjectives = OperativeObjectiveQuery::create()->find();
		return $this->getEntitiesExpenses($operativeObjectives);
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the ImpactObjectives
	 * @return array array of ExpensesSum
	 */
	function getImpactObjectivesExpenses() {
		$impactObjectives = ImpactObjectiveQuery::create()->find();
		return $this->getEntitiesExpenses($impactObjectives);
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the MinistryObjectives
	 * @return array array of ExpensesSum
	 */
	function getMinistryObjectivesExpenses() {
		$ministryObjectives = MinistryObjectiveQuery::create()->find();
		return $this->getEntitiesExpenses($ministryObjectives);
	}
	
	/**
	 * Returns a collection with the ExpensesSum of the BudgetRelations asociated to the $entities
	 * @return array array of ExpensesSum
	 */
	function getEntitiesExpenses($entities) {
		
		$yearsRange = array(
			'min' => Common::getStartingYear(),
			'max' => Common::getEndingYear()
		);
		
		$entitiesExpenses = array();
		foreach ($entities as $entity) {
			
			$yearFilteredQuery = BudgetRelationQuery::create()->filterByBudgetyear($yearsRange);
			$budgetRelations = $entity->getBudgetItems($yearFilteredQuery);
//			$budgetRelations = array(ExpensesSum::createRandomBudgetRelation(), ExpensesSum::createRandomBudgetRelation()); // TODO: revisar $budgetRelations y borrar
			
			$entityExpenses = new ExpensesSum($entity->getName(), $budgetRelations);
			$entitiesExpenses[] = $entityExpenses;
		}
		return $entitiesExpenses;
	}
}
