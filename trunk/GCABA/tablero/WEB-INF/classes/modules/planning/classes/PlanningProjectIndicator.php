<?php



/**
 * Skeleton subclass for representing a row from the 'planning_projectIndicator' table.
 *
 * Indicadores de Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class PlanningProjectIndicator extends BasePlanningProjectIndicator
{
	public function update($project, $indicator){
		
		$this->setPlanningprojectid($project)->setIndicatorid($indicator);
		try {
			$this->save();
			return $this;
			//return $this->modifiedColumns;
		}catch(PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
}
