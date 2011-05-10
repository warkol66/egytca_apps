<?php


/**
 * Skeleton subclass for performing query and update operations on the 'objectives_region' table.
 *
 * Asociacion entre Barrios y Objetivos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.objectives.classes
 */
class ObjectiveRegionPeer extends BaseObjectiveRegionPeer {

 /**
	* Obtiene una relacion de proyecto y region
	*
	* @param int $objectiveId id del objective
	* @param int $regionId id del region
	*	@return boolean true si se creo la relacion, false sino
	*/
	function get($objectiveId,$regionId)
	{
		$criteria = new Criteria();
		$criteria->add(ObjectiveRegionPeer::REGIONID,$regionId);
		$criteria->add(ObjectiveRegionPeer::OBJECTIVEID,$objectiveId);
		return ObjectiveRegionPeer::doSelectOne($criteria);
	}

 /**
	* Crea una relacion de proyecto y region
	*
	* @param int $objectiveId id del objective
	* @param int $regionId id del region
	*	@return boolean true si se creo la relacion, false sino
	*/
	function create($objectiveId,$regionId)
	{
		$relation = new ObjectiveRegion();
		$relation->setRegionId($regionId);
		$relation->setObjectiveId($objectiveId);
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
	* @param int $objectiveId id del objective
	* @param int $regionId id del region
	*	@return boolean true si se elimino la relacion, false sino
	*/
	function delete($objectiveId,$regionId)
	{
		$relation = ObjectiveRegionPeer::get($objectiveId,$regionId);
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

} // ObjectiveRegionPeer
