<?php

require_once('AdvertisementPeer.php');

class CampaignPeer {


	/*
	 * Obtiene todos los avisos pertenecientes a una campaña.
	 *
	 * @param integer $themeId id del motivo
	 * @return array instanacia de advertisement
	 */
	public function	getCampaign($themeId,$circuitId=null) {

			$criteria = new Criteria();

			$criteria->addJoin(AdvertisementPeer::BILLBOARDID,BillboardPeer::ID,Criteria::INNER_JOIN);
			$criteria->addJoin(AdvertisementPeer::THEMEID,ThemePeer::ID,Criteria::INNER_JOIN);
			$criteria->addJoin(BillboardPeer::ADDRESSID,AddressPeer::ID,Criteria::INNER_JOIN);
		
			if ($circuitId != null)
				$criteria->add(AddressPeer::CIRCUITID, $circuitId);
			
			$criteria->add(AdvertisementPeer::THEMEID, $themeId);
			$criteria->add(ThemePeer::ACTIVE, 1);
			
			$result = AdvertisementPeer::doSelect($criteria);
			
			return $result;

		
	}
	
	public function getCampaignGroupedByAddress($themeId,$circuitId) {
	
		$campaign = CampaignPeer::getCampaign($themeId,$circuitId);
		$result = array();
		foreach ($campaign as $advert) {
			
			$billboard = $advert->getBillboard();
			$address = $billboard->getAddress();
			
			if (!isset($result[$address->getId()])) {
				$result[$address->getId()]['address'] = $address;
				$result[$address->getId()]['billboards'] = array();
			}
			
			if (!isset($result[$address->getId()]['billboards'][$billboard->getId()])) {
				$result[$address->getId()]['billboards'][$billboard->getId()]['billboard'] = $billboard;
				$result[$address->getId()]['billboards'][$billboard->getId()]['adverts'] = array();
			}
			
			$result[$address->getId()]['billboards'][$billboard->getId()]['adverts'][$advert->getId()] = $advert;
			
		}

		return $result;
		
		
	}
	
}

?>
