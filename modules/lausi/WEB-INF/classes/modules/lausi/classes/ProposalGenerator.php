<?php

class ProposalGenerator {
	
	/**
	 * Devuelve la cantidad de carteleras a buscar segun el tipo de motivos 
	 * y la cantidad de afiches pedidos.
	 * 
	 * @param Theme instancia de theme
	 * @param integer cantidad de afiches
	 * @return integer de carteleras
	 */
    public function getQuantityByType($theme,$quantitySheets) {
		//regla de negocio, por cada cartelera doble van dos afiches.
		if ($theme->getType() == ThemePeer::TYPE_DOBLE)
			return ceil($quantitySheets/2);

		return $quantitySheets;
	} 
	
	/**
     * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces o sin limite
	 *
	 * @param $themeId Id de motivo
	 * @param $quantity Cantidad de Motivos por Region
	 * @param $dateFrom fecha desde la publicacion del motivo
	 * @param $duration duracion de la publicacion del motivo
     */
	public function generateProposal($themeId, $dateFrom, $duration, $quantity = null) {
		$theme = ThemePeer::get($themeId);

		if ($quantity != null)
			$quantity = $this->getQuantityByType($theme,$quantity);

		$type = $theme->getType();
		$criteria = new BillboardQuery();
		
		if ($type != null)
   			$criteria->filterByType($type);
		
		if ($quantity != null)
	   		$criteria->limit($quantity);
	
		$result = BillboardPeer::getAllAvailableOrdered($criteria,$dateFrom,$duration,$quantity,$type);
		
		return $result;
	}

	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces en una region
	 *
	 * @param $themeId Id de motivo
	 * @param $quantity Cantidad de Motivos por Region
	 * @param $regionId Id de Region
	 * @param $dateFrom fecha desde la publicacion del motivo
	 * @param $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForRegion($themeId, $regionId, $dateFrom, $duration, $quantity) {
		$theme = ThemePeer::get($themeId);
		$quantity = $this->getQuantityByType($theme,$quantity);		
		$type = $theme->getType();

		$result = BillboardPeer::getAllAvailableByRegion($regionId,$quantity,$dateFrom,$duration,$type,$quantity);
		
		return $result;
	}	

	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces en circuit
	 *
	 * @param $themeId Id de motivo
	 * @param $quantity Cantidad de Motivos por Region
	 * @param $circuitId Id de Circuit
	 * @param $dateFrom fecha desde la publicacion del motivo
	 * @param $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForCircuit($themeId, $circuitId, $dateFrom, $duration, $quantity) {
		$theme = ThemePeer::get($themeId);
		$quantity = $this->getQuantityByType($theme,$quantity);		
		$type = $theme->getType();

		$result = BillboardPeer::getAllAvailableByCircuit($circuitId,$dateFrom,$duration,$quantity,$type);
			
		return $result;
	}	

	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces segun un
	 * determinado rating
	 *
	 * @param integer $themeId Id de motivo
	 * @param integer $quantity Cantidad de Motivos por Region
	 * @param integer $rating Id de Circuit
	 * @param string $dateFrom fecha desde la publicacion del motivo
	 * @param integer $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForRating($themeId, $rating, $dateFrom, $duration, $quantity) {
		$theme = ThemePeer::get($themeId);
		$quantity = $this->getQuantityByType($theme,$quantity);		
		$type = $theme->getType();

		$result = BillboardPeer::getAllAvailableByRating($rating,$dateFrom,$quantity,$duration,$type,$quantity);
		
		return $result;
	}	

	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces segun un
	 * determinada ubicacion geografica
	 *
	 * @param integer $themeId Id de motivo
	 * @param integer $quantity Cantidad de Motivos por Region
	 * @param integer $coordinateX Coordenada X de la ubicacion geografica
	 * @param integer $coordinateY Coordenada Y de la ubicacion geografica
	 * @param integer $radius Radio a tener en cuenta desde la ubicacion geografica
	 * @param string $dateFrom fecha desde la publicacion del motivo
	 * @param integer $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForLocation($themeId, $longitude_0, $latitude_0, $radius, $fromDate, $duration, $quantity) {
		$theme = ThemePeer::get($themeId);
		$quantity = $this->getQuantityByType($theme,$quantity);
		$type = $theme->getType();

		$result = BillboardPeer::getAllAvailableByLocation($quantity,$longitude_0,$latitude_0,$radius,$fromDate,$duration,$type,$quantity);

		if ($quantity == 0) {
			return array();
		}
		
		return $result;
	}	
	
	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces en circuit segun un 
	 * porcentaje de carteleras en un circuito
	 * 
	 * @param $themeId Id de motivo
	 * @param $percentage Porcentaje
	 * @param $circuitId Id de Circuit
	 * @param $dateFrom fecha desde la publicacion del motivo
	 * @param $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForCircuitBillboardPercentage($themeId, $percentage, $circuitId, $dateFrom, $duration) {
		$theme = ThemePeer::get($themeId);
		$type = $theme->getType();

		$total = BillboardPeer::getAllByCircuitCount($circuitId);
//		Descomentar en caso de que se distribuyan avisos y no carteleras		
//		if ($theme->getType() == ThemePeer::TYPE_DOBLE)
//			$total = $total * 2;

		$quantity = floor(($percentage / 100 ) * $total);
		
		if ($quantity == 0) {
			return array();
		}

		$result = BillboardPeer::getAllAvailableByCircuit($circuitId,$dateFrom,$duration,$quantity,$type,$quantity);
		
		return $result;
	}	

	/**
	 * Devuelve un conjunto de direcciones para distribuir un motivo una cantidad de veces en circuit segun un 
	 * porcentaje de carteleras del total de los circuitos
	 * 
	 * @param $themeId Id de motivo
	 * @param $percentage Porcentaje
	 * @param $circuitId Id de Circuit
	 * @param $dateFrom fecha desde la publicacion del motivo
	 * @param $duration duracion de la publicacion del motivo
	 */
	public function generateProposalForCircuitPercentageTotal($themeId, $total, $percentage, $circuitId, $dateFrom, $duration) {
		$theme = ThemePeer::get($themeId);
		$type = $theme->getType();
		
		$quantity = floor(($percentage / 100) * $total);

		if ($quantity == 0) {
			return array();
		}

		$result = BillboardPeer::getAllAvailableByCircuit($circuitId,$dateFrom,$duration,$quantity,$type);
			
		return $result;
	}		
	
}

?>
