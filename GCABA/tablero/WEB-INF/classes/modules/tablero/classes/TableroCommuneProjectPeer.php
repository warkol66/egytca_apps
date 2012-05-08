<?php


// include object class
include_once 'tablero/classes/TableroCommuneProject.php';

/**
 * Skeleton subclass for performing query and update operations on the 'tablero_communeProject' table.
 *
 * Asociacion entre Comunas y Proyectos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    tablero.classes
 */
class TableroCommuneProjectPeer extends BaseTableroCommuneProjectPeer {

	/**
	 * Elimina una relacion entre comuna y proyecto
	 * @param $projectId id del proyecto
	 * @param $communeId id de la comuna
	 */
	function delete($projectId,$communeId) {
		$cond = new Criteria();
		$cond->add(TableroCommuneProjectPeer::PROJECTID,$projectId);
		$cond->add(TableroCommuneProjectPeer::COMMUNEID,$communeId);
		
		$relation = TableroCommuneProjectPeer::doSelectOne($cond);
		
		try {
			$relation->delete();
		}
		catch (PropelException $exp) {
			return false;
		}
		
		return true;
	}

} // TableroCommuneProjectPeer
