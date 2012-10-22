<?php

/**
 * Skeleton subclass for performing query and update operations on the 'MER_relationship' table.
 *
 * 
 *
 * This class was autogenerated by Propel on:
 *
 * Tue Aug  1 15:33:35 2006
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package mer
 */	
class RelationshipPeer extends BaseRelationshipPeer {

	function getAllByActors($actor1ld,$actor2ld) {
		$criteria = new Criteria();
		$criteria->add(RelationshipPeer::ACTOR1ID, $actor1ld->getId());
		$criteria->add(RelationshipPeer::ACTOR2ID, $actor2ld->getId());
    $criteria->add(RelationshipPeer::DIRECTION, 0);
    $relationships = RelationshipPeer::doSelectJoinQuestion($criteria);
    return $relationships;
	}
	
	function get($questionId,$actor1ld,$actor2ld) {
		$criteria = new Criteria();
		$criteria->add(RelationshipPeer::ACTOR1ID, $actor1ld->getId());
		$criteria->add(RelationshipPeer::ACTOR2ID, $actor2ld->getId());
		$criteria->add(RelationshipPeer::QUESTIONID, $questionId);
    $relationships = RelationshipPeer::doSelectJoinQuestion($criteria);
    return $relationships[0];
	}

} // RelationshipPeer