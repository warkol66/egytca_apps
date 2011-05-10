<?php

require 'infocivica/om/BaseSegmentationCluster.php';


/**
 * Skeleton subclass for representing a row from the 'segmentation_cluster' table.
 *
 * Clusters de usuarios registrados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class SegmentationCluster extends BaseSegmentationCluster {

	/**
	 * Initializes internal state of SegmentationCluster object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	function getUsers($criteria = null) {
		require_once("RegistrationUserPeer.php");
		require_once("SegmentationClusterConditionPeer.php");

		if (empty($criteria))
			$criteria = new Criteria();

		$criteria->add(RegistrationUserPeer::ACTIVE,1);
		$criteria->addAscendingOrderByColumn(RegistrationUserPeer::ID);

		global $system;
		$includeNoVerifiedUsers = $system["config"]["segmentation"]["includeNoVerifiedUsers"]["value"];

		if ($includeNoVerifiedUsers == "NO")
			$criteria->add(RegistrationUserPeer::VERIFIED,1);	
		
		$criteria->addJoin(RegistrationUserPeer::ID,RegistrationUserInfoPeer::USERID);
		$conditions = array();
		foreach ($this->getSegmentationClusterConditions() as $condition) {
			$conditions[$condition->getField()][] = $condition;			
		}

		foreach ($conditions as $field => $fieldConditions) {
				$init = true;
				foreach ($fieldConditions as $condition) {
					if ($init) {
						$criterion = $criteria->getNewCriterion($condition->getField(),$condition->getValue(),$condition->getCondition());
						$init = false;
					} else {
						$criterion->addAnd($criteria->getNewCriterion($condition->getField(),$condition->getValue(),$condition->getCondition()));
					}				
				}
				$criteria->add($criterion);
		}		
		
		$users = RegistrationUserPeer::doSelect($criteria);
		return $users;
	}
	
	/**
	 * Obtiene el contenido del cluster a partir de un cierto usuario del mismo
	 * @param RegistrationUser $lastUser usuario a partir del que se quieren obtener los usuarios
	 * @return Array de instancias de RegistrationUser
	 */
	public function getUsersAfterUser($lastUser) {
		
		$criteria = New Criteria();
		$criteria->add(RegistrationUserPeer::ID,$lastUser->getId(),Criteria::GREATER_THAN);
		
		return $this->getUsers($criteria);
		
	}
	
	function getConditionsByField($field) {
		require_once("SegmentationClusterConditionPeer.php");		
		$criteria = new Criteria();
		$criteria->add(SegmentationClusterConditionPeer::FIELD,$field);
		return $this->getSegmentationClusterConditions($criteria);		
	}

} // SegmentationCluster
