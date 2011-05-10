<?php

require 'infocivica/om/BaseSegmentationClusterCondition.php';


/**
 * Skeleton subclass for representing a row from the 'segmentation_clusterCondition' table.
 *
 * Condiciones de clusters de usuarios registrados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class SegmentationClusterCondition extends BaseSegmentationClusterCondition {

	/**
	 * Initializes internal state of SegmentationClusterCondition object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // SegmentationClusterCondition
