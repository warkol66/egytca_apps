<?php

/**
 * PositionsInclude
 *
 * @package objectives
 */
class ObjectivesInclude extends ObjectivePeer {

	function getHome($options)
	{
		$objectivePeer = new PolicyGuidelinePeer();
		$objectives = $objectivePeer->getAll();
		return $objectives;
	}

} // PositionsInclude
