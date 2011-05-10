<?php

/**
 * PositionsInclude
 *
 * @package positions
 */
class PositionsInclude extends PositionPeer {

	function getHome($options)
	{
		$positionsLatetsVersion = PositionPeer::getLatestVersion();
		$positionPeer = new PositionPeer();
		$positionPeer->setSearchType($options["type"]);
		$positionPeer->setSearchVersion($positionsLatetsVersion);
		$positions = $positionPeer->getAllFiltered();
		return $positions;
	}

} // PositionsInclude
