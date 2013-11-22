<?php



/**
 * Skeleton subclass for performing query and update operations on the 'common_blockedIp' table.
 *
 * IPs bloqueadas
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class BlockedIpQuery extends BaseBlockedIpQuery{
	
	function selectDistinctIp($distinct){
		if($distinct)
			$this->groupByIp();
			
		return $this;
	}
}
