<?php

  // include base peer class
  require_once 'affiliates/classes/om/BaseAffiliateInfoPeer.php';
  
  // include object class
  include_once 'AffiliateInfo.php';


/**
 * Skeleton subclass for performing query and update operations on the 'affiliates_affiliateInfo' table.
 *
 * Informacion del afiliado
 *
 * @package affiliates
 */	
class AffiliateInfoPeer extends BaseAffiliateInfoPeer {

	function getFromArray($params) {
		$obj = new AffiliateInfo();
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

  function get($id) {
		$cond = new Criteria();
		$cond->add(AffiliateInfoPeer::AFFILIATEID, $id);
		$affiliateInfo = AffiliateInfoPeer::doSelectOne($cond);
		return $affiliateInfo;
  }

 function update($id,$affiliateId,$holder,$directionBoardContact,$telephone,$extraTelephone,$email,$responsible) {
		$affiliate = AffiliateInfoPeer::retrieveByPK($id);		
		$affiliate->setAffiliateId($affiliateId);		
		$affiliate->setHolder($holder);
		$affiliate->setDirectionBoardContact($directionBoardContact);
		$affiliate->setTelephone($telephone);
		$affiliate->setExtraTelephone($extraTelephone);
		$affiliate->setEmail($email);
		$affiliate->setResponsible($responsible);		
		$affiliate->save();
		return true;
  }

  
	 function add($affiliateId,$holder,$directionBoardContact,$telephone,$extraTelephone,$email,$responsible,$con = null) {
		$affiliate = new AffiliateInfo();		
		$affiliate->setAffiliateId($affiliateId);
		$affiliate->setHolder($holder);
		$affiliate->setDirectionBoardContact($directionBoardContact);
		$affiliate->setTelephone($telephone);
		$affiliate->setExtraTelephone($extraTelephone);
		$affiliate->setEmail($email);
		$affiliate->setResponsible($responsible);		
		try {
			$affiliate->save($con);
		}
		catch(PropelException $exp) {
			return false;
		}
		return true;
  	}
  

} // AffiliateInfoPeer
