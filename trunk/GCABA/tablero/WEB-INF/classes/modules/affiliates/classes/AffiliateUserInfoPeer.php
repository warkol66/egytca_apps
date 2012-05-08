<?php

  // include base peer class
  require_once 'affiliates/classes/om/BaseAffiliateUserInfoPeer.php';

  // include object class
  include_once 'AffiliateUserInfo.php';


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_userInfo' table.
 *
 * Information about users by affiliates
 *
 * @package    affiliates
 */
class AffiliateUserInfoPeer extends BaseAffiliateUserInfoPeer {

	function getFromArray($params) {
		$obj = new AffiliateUserInfo();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}		
		return $obj;
	}

} // AffiliateUserInfoPeer
