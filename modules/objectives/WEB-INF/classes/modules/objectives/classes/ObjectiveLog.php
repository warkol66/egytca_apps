<?php


/**
 * Skeleton subclass for representing a row from the 'objectives_objectiveLog' table.
 *
 * Objective Log
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class ObjectiveLog extends BaseObjectiveLog {

	/**
	 * Devuelve el nombre del Objetivo Estrat�gico
	 *
	 *	@return string
	 */
	public function getStrategicObjective() {
		$strategicObjectiveId = $this->getStrategicObjectiveId();
		if ($strategicObjectiveId > 0)
			$strategicObjective = StrategicObjectiveQuery::create()->findOneById($strategicObjectiveId);
		else
			$strategicObjective = new StrategicObjective();
		return $strategicObjective->getName();
	}
	/**
	 * Devuelve el nombre del Eje de Gesti�n
	 *
	 *	@return string
	 */
	public function getPolicyGuideline() {
		$policyGuidelineId = $this->getPolicyGuidelineId();
		if ($policyGuidelineId > 0)
			$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);
		else {
			$strategicObjectiveId = $this->getStrategicObjectiveId();
			if ($strategicObjectiveId > 0){
				$strategicObjective = StrategicObjectivePeer::get($strategicObjectiveId);
				$policyGuidelineId = $strategicObjective->getPolicyGuidelineId();
				$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);
				if ($policyGuidelineId > 0)
					$policyGuideline = PolicyGuidelineQuery::create()->findOneById($policyGuidelineId);
				else	
					$policyGuideline = new PolicyGuideline();
			}
			else
				$policyGuideline = new PolicyGuideline();
		}
		return $policyGuideline->getName();
	}
} // ObjectiveLog
