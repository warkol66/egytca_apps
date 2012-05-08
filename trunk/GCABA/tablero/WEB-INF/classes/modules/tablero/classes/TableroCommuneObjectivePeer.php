<?php

// include object class
include_once 'tablero/TableroCommuneObjective.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tablero_communeObjective' table.
 *
 * Asociacion entre Comunas y Objetivos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroCommuneObjectivePeer extends BaseTableroCommuneObjectivePeer {

	/**
	 * Elimina una relacion entre comuna y proyecto
	 * @param $objectiveId id del proyecto
	 * @param $communeId id de la comuna
	 */
	function delete($objectiveId,$communeId) {
		$cond = new Criteria();
		$cond->add(TableroCommuneObjectivePeer::OBJECTIVEID,$objectiveId);
		$cond->add(TableroCommuneObjectivePeer::COMMUNEID,$communeId);
		
		$relation = TableroCommuneObjectivePeer::doSelectOne($cond);

		try {
			$relation->delete();
		}
		catch (PropelException $exp) {
			return false;
		}
		
		return true;
	}

} // TableroCommuneObjectivePeer
