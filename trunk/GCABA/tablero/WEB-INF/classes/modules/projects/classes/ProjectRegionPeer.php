<?php


/**
 * Skeleton subclass for performing query and update operations on the 'projects_region' table.
 *
 * Asociacion entre Barrios y Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.projects.classes
 */
class ProjectRegionPeer extends BaseProjectRegionPeer {

 /**
	* Obtiene una relacion de proyecto y region
	*
	* @param int $projectId id del project
	* @param int $regionId id del region
	*	@return boolean true si se creo la relacion, false sino
	*/
	function get($projectId,$regionId)
	{
		$criteria = new Criteria();
		$criteria->add(ProjectRegionPeer::REGIONID,$regionId);
		$criteria->add(ProjectRegionPeer::PROJECTID,$projectId);
		return ProjectRegionPeer::doSelectOne($criteria);
	}

 /**
	* Crea una relacion de proyecto y region
	*
	* @param int $projectId id del project
	* @param int $regionId id del region
	*	@return boolean true si se creo la relacion, false sino
	*/
	function create($projectId,$regionId)
	{
		$relation = new ProjectRegion();
		$relation->setRegionId($regionId);
		$relation->setProjectId($projectId);
		try {
			$relation->save();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
		return true;
	}

 /**
	* Elimina una relacion de proyecto y region
	*
	* @param int $projectId id del project
	* @param int $regionId id del region
	*	@return boolean true si se elimino la relacion, false sino
	*/
	function delete($projectId,$regionId)
	{
		$relation = ProjectRegionPeer::get($projectId,$regionId);
		try {
			$relation->delete();
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
		return true;
	}

} // ProjectRegionPeer
