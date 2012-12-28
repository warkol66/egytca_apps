<?php

/**
 * Skeleton subclass for representing a row from the 'banners_zone' table.
 *
 * Zonas donde se muestran los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerZone extends BaseBannerZone {

	//Frecuencia de reseteo de impresiones
	const ROTATION_RANDOM = 0;
	const ROTATION_WEIGHTED = 1;
	const ROTATION_ORDERED = 2;

	private $rotationTypes = array(
		BannerZone::ROTATION_RANDOM => 'Aleatoria',
		BannerZone::ROTATION_WEIGHTED => 'Ponderada por pesos',
		BannerZone::ROTATION_ORDERED => 'Ordenada'
	);

	/**
	* Obtiene los tipos de frecuencia válidos
	*
	* @return arry Frecuencias
	*/
	public function getRotationTypes()
	{
		return $this->rotationTypes;
	}

	private $mode;

	public function setMode($mode)
	{
		$this->mode = $mode;
	}

	private function getRandomBanners($amount)
	{
		$banners = BannerQuery::getRandom($this->getId(), $amount);
		return $banners;
	}

	private function getOrderedBanners($amount)
	{
		$banners = BannerQuery::getOrdered($this->getId(), $amount);
		return $banners;
	}

	private function getWeightedBanners($amount) {

		$zoneId = $this->getId();

		// array para ir almacenando los banners a desplegar, dado que se determinan uno por uno
				$banners = array();
				//print "<pre>";
				for ($ii = 1; $ii <= $amount; $ii++) {
					// de 1 a la cantidad de banners requeridos para la zona

					// todos los banerZone de la zona no incluidos los banners ya elegidos
					foreach($banners as $banner) {
							$notIn[] = $banner->getId();
					}
					$bzs = BannerQuery::getByZoneForDisplay($zoneId, $notIn);

					// calculo el peso total de los banerZone seleccionados
					$totalWeight = 0;
					foreach($bzs as $bz)
						$totalWeight += $bz->getWeight();

					// random en decimal.
					$rand = rand(0, 1000000)/1000000;
					$start = 0;
					$end = 0;
					//print "______R:$rand TW:$totalWeight ________\n";
					foreach($bzs as $bz){
						// para cada uno de los banerZone

						// obtengo el peso del bannerZone
						$weight = $bz->getWeight();

						// el comiendo del rango de prueba es igual al fin del anterior
						$start = $end;

						// el fin del rango es igual al inicio más el peso ponderado por el peso total
						$end = $start + $weight/$totalWeight;

						//print "B:" .$bz->getBanner()->getId() . " S:$start : E:$end : W:$weight";
						if ( $start<=$rand && $rand<$end ) {
								// el valor aleatorio se encuentra dentro del rango start-end

								$banners[] = $bz->getBanner();
								//print "(*)";
								break;
						}
						//print "\n";
					}

				}
				return $banners;
		}

	function getBannersInRowsAndCols()
	{
		$rows = $this->getRows();
		$cols = $this->getColumns();
		$amount = $rows * $cols;

		if ($this->getRotationType() == BannerZone::ROTATION_RANDOM) {
			// aleatoria
			$banners = $this->getRandomBanners($amount);

//			$content = $banners[0]->getBannerContent();
		} elseif ($this->getRotationType() == BannerZone::ROTATION_WEIGHTED) {
			// ponderada
			$banners = $this->getWeightedBanners($amount);
			// desordeno porque los de mas peso siempre aparecen primero
			shuffle($banners);
		} elseif ($this->getRotationType() == BannerZone::ROTATION_ORDERED) {
			// ordenada
			$banners = $this->getOrderedBanners($amount);
		}

		if (empty($this->mode) or $this->mode !== 'preview' ) {
			// si no está en modo vista previa

			// decrementa el contador de impresiones restantes
			foreach( $banners as $banner) {
				if (! $banner == null) {
					$banner->decresePrintsLeft();
					$banner->save();
				}
			}
		}
		$banners = $banners->getArrayCopy();
		// acomoda los banners en un array bidimensional de filas y columnas.
		$arrengedBanners = array();
		for ($rowNumber = 0; $rowNumber < $rows; $rowNumber++) {
			for ($colNumber = 0; $colNumber < $cols; $colNumber++) {
				$banner = array_shift($banners);
				if (is_a($banner, "Banner"))
					$arrengedBanners[$rowNumber][$colNumber] = $banner;
			}
		}
		return $arrengedBanners;
	}

} // Zone
