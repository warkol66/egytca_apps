<?php



/**
 * Skeleton subclass for performing query and update operations on the 'requirements_requirement' table.
 *
 * Requerimientos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.requirements.classes
 */
class RequirementQuery extends BaseRequirementQuery{
	
	function addDevelopmentToRequirement($requirementId,$developmentId) {
		try {
			$dev = DevelopmentQuery::create()->findOneById($developmentId);
			
			if(!empty($dev)){
				$req = RequirementQuery::create()->findOneById($requirementId);
				$req->setDevelopmentId($developmentId);
				$req->save();
				return true;
			}
			return false;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
}
