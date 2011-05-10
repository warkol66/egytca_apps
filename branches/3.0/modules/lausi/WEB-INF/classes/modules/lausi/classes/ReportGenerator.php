<?php

	/**
	* Generador de Reportes
	*/
	class ReportGenerator {
		
		private $workforceId = null;
		private $themeId = null;
		
		function __construct() {
			;
		}
		
		public function setWorkforceId($workforceId) {
			$this->workforceId = $workforceId;
		}
		
		public function setThemeId($themeId) {
			$this->themeId = $themeId;
		}
		
		public function getRouteSheetReport($date) {
			$adverts = AdvertisementQuery::create()
				->filterAdvertisementsForRouteSheetReport($date, $this->workforceId, $this->themeId)
			->find();
			
			foreach ($adverts as $advert) {
				$theme = $advert->getTheme();
					
				if (!isset($results[$theme->getId()])) {
					$results[$theme->getId()]['theme'] = $theme;
					$results[$theme->getId()]['adverts'] = array();
				}
					
				array_push($results[$theme->getId()]['adverts'],$advert);		
			}
			
			foreach ($results as $key => $result) {
				$adverts = new PropelObjectCollection;
				$adverts->setModel('Advertisement'); 
				$adverts->setData($result['adverts']);
				
				$addresses = AddressQuery::create()->filterByAdvertisement($adverts)->find();
				$results[$key]['addresses'] = array();
				
				foreach ($addresses as $address) {
					$results[$key]['addresses'][$address->getId()] = array('address'=>$address);
				}
			}
			
			$results = $this->orderResults($results);
			return $results;
		}
	
		public function getSheetsLocationReport($date,$type,$circuitId=null) {

				//casos de afiches dobles (dos por cartelera) y sextuples (1 por cartelera)
				$multiplier = 1;
				if ($type == BillboardPeer::TYPE_DOBLE)
					$multiplier = 2;			

				$adverts = AdvertisementQuery::create()
					->filterAdvertisementsForSheetsLocationReport($date,$type,$circuitId)
				->find();

				$results = array();
				
				foreach ($adverts as $advert) {
					
					$theme = $advert->getTheme();
					$billboard = $advert->getBillboard();
					$address = $billboard->getAddress();
					$circuit = $address->getCircuit();
					
					if (!isset($results[$circuit->getId()])) {
						$results[$circuit->getId()]['circuit'] = $circuit;
						$results[$circuit->getId()]['addresses'] = array();
						$results[$circuit->getId()]['total'] = 0;
						$results[$circuit->getId()]['totals'] = array();
					}

					if (!isset($results[$circuit->getId()]['addresses'][$address->getId()])) {
						$results[$circuit->getId()]['addresses'][$address->getId()]['adverts'] = array();
						$results[$circuit->getId()]['addresses'][$address->getId()]['total'] = 0;
					}
					
					if (!isset($results[$circuit->getId()]['addresses'][$address->getId()])) {
						$results[$circuit->getId()]['addresses'][$address->getId()]['adverts'] = array();
						$results[$circuit->getId()]['addresses'][$address->getId()]['totals'] = array();
					}

					if (!isset($results[$circuit->getId()]['addresses'][$address->getId()]['adverts'][$theme->getId()])) {
						$results[$circuit->getId()]['addresses'][$address->getId()]['adverts'][$theme->getId()] = 0; 
					}					
					
					if (!isset($results[$circuit->getId()]['totals'][$theme->getId()]))
						$results[$circuit->getId()]['totals'][$theme->getId()] = 0;
					
					$results[$circuit->getId()]['addresses'][$address->getId()]['address'] = $address;
					$results[$circuit->getId()]['totals'][$theme->getId()] = $results[$circuit->getId()]['totals'][$theme->getId()] + (1 * $multiplier);
					$results[$circuit->getId()]['addresses'][$address->getId()]['adverts'][$theme->getId()] += (1 * $multiplier);
					
					
					$results[$circuit->getId()]['total'] = $results[$circuit->getId()]['total'] + (1 * $multiplier);
				}

				$results = $this->orderResults($results);
				return $results;
		}
		
		public function getThemesReport($type=null,$circuitId=null) {
			
			$criteria = new ThemeQuery;
			
			$criteria->join('Advertisement', Criteria::INNER_JOIN);
			$criteria->distinct();
			//el result set tendra registros con id de circuitm nombre de circuit, cuenta y tipo
			$criteria->selectFieldsForThemesReport();
			$criteria->groupBy('Advertisement.Themeid');
			$criteria->groupBy('Advertisement.Publishdate');
			$criteria->groupBy('Advertisement.Duration');
			
			if ($type != null)
				$criteria->filterByType($type);
			
			$circuit = CircuitPeer::get($circuitId);	
			if (!empty($circuit)) {
				$criteria->useQuery('Advertisement')
							->filterByCircuit($circuit)
						 ->endUse();
			}
			
			try {
				$resultSet = $criteria->find();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
				return false;
			}

			$result = array();
			foreach($resultSet as $row) {
				$result = array();
				$result['id'] = $row['ThemeId'];
				$result['total'] = $row['TotalAdvertisements'];
				$result['endDate'] = $row['EndDate'];
				$result['name'] = $row['ThemeName'];

				$today = strtotime(date("Y-m-d"));
				$expiration = strtotime($result['endDate']);

				if ($today >= $expiration)
					$result['expired'] = true;
				else
					$result['expired'] = false;
				
				$results[] = $result;
			}
			
			return $results;
		}
		
		public function getAvailableBillboardsReport() {
			
			global $system;
			
			$iterations = $system['config']['lausi']['availableBillboardsDays'];
			$result = array();
			$circuits = CircuitPeer::getAll();
			
			$types = array(
				BillboardPeer::TYPE_DOBLE => 'numberDoble',
				BillboardPeer::TYPE_SEXTUPLE => 'numberSextuple'
			);

			for ($i=0; $i<$iterations ; $i++) {
				
				$fromDate = date("Y-m-d",mktime(0,0,0,date("m"),date('d')+$i,date("Y")));

				$duration = 1;

				$criteria = new BillboardQuery();
			
				$criteria->join('Billboard.Address',Criteria::INNER_JOIN);
				$criteria->join('Address.Circuit',Criteria::INNER_JOIN);
				
				$criteria->filterByAvailable($fromDate, $duration);				

				$criteria->groupBy('Billboard.Type');
				$criteria->groupBy('Address.Circuitid');
				
				//el result set tendra registros con id de circuitm nombre de circuit, cuenta y tipo
				$criteria->selectFieldsForAvailableBillboardsReport();
				
				try {
					$resultSet = $criteria->find();
				} catch (PropelException $exp) {
					if (ConfigModule::get("global","showPropelExceptions"))
						print_r($exp->getMessage());
					return false;
				}
				
				if (empty($result['total']['dates'][$fromDate]['numberDoble'])) {
					$result['total']['dates'][$fromDate]['numberDoble'] = 0;
				}

				if (empty($result['total']['dates'][$fromDate]['numberSextuple'])) {
					$result['total']['dates'][$fromDate]['numberSextuple'] = 0;
				}
				
				foreach ($circuits as $circuit) {
					$index = $circuit->getId();
					$result['circuit'][$index]['dates'][$fromDate]['numberDoble'] = 0;
					$result['circuit'][$index]['dates'][$fromDate]['numberSextuple'] = 0;
					$result['circuit'][$index]['name'] = $circuit->getName();
				}			

				foreach ($resultSet as $row) { //Acá decía $resultSet->next() pero tiraba error
					//we obtain the result from the second column of the record
					$index = $row['CircuitId'];	
					$type = $types[$row['BillboardType']];
					$result['total']['dates'][$fromDate][$type] += $row['Count'];
					$result['circuit'][$index]['dates'][$fromDate][$type] = $row['Count'];
				}
			}
			return $result;
		}
		
		public function getThemeByCircuitReport($theme) {
			$criteria = new BillboardQuery;
			$criteria->join('Advertisement',Criteria::INNER_JOIN);
			$criteria->useQuery('Advertisement')
						->filterByCurrent()
						->filterByTheme($theme)
					 ->endUse();
			
			try {
				$billboards = $criteria->find();
			} catch (PropelException $exp) {
				if (ConfigModule::get("global","showPropelExceptions"))
					print_r($exp->getMessage());
				return false;
			}

			$results = array();
			foreach ($billboards as $billboard) {
				$address = $billboard->getAddress();
				$circuit = $address->getCircuit();
				
				if (empty($results[$circuit->getId()])) {
					$results[$circuit->getId()]['circuit'] = $circuit;
					$results[$circuit->getId()]['addresses'] = array();
				}
				
				if (empty($results[$circuit->getId()]['addresses'][$address->getId()])) {
					$results[$circuit->getId()]['addresses'][$address->getId()]['address'] = $address;
					$results[$circuit->getId()]['addresses'][$address->getId()]['count'] = 0;
				}

				$results[$circuit->getId()]['addresses'][$address->getId()]['count'] = $results[$circuit->getId()]['addresses'][$address->getId()]['count'] + 1;
			}
			return $results;
		}

		/**
		 * Devuelve una arreglo conteniendo todos los resultados pero ordenados en forma aproximada
		 * por proximidad.
		 */
		public static function orderResults($results) {
			$orderedResults = $results;
			
			foreach ($results as $key => $result) {
				$addresses = $result['addresses'];
				$orderedResults[$key]['addresses'] = ReportGenerator::orderAddresses($addresses);
			}
			return $orderedResults;
		}
		
		/**
		 * Devuelve una arreglo conteniendo todas las direcciones pero ordenadas en forma aproximada
		 * por proximidad.
		 */		
		public static function orderAddresses($addresses) {
			$orderedAddresses = array();
			
			//Primero tomamos un punto de partida al azar.
			$idx = 0; //rand(0, count($addresses)); Me parece que no está bueno tan al azar
			//el arreglo no esta indexado en forma continua
			$keys = array_keys($addresses);
			$idx = $keys[$idx];
			$orderedAddresses[$idx] = $addresses[$idx];
			unset($addresses[$idx]);
			
			//elemento que usamos como fijo para obtener el más cercano.
			$pivot = $orderedAddresses[$idx];
			
			//Mientras queden elementos por ordenar.
			while (count($addresses) > 0) {
				$idx = ReportGenerator::getIndexOfClosestTo($pivot, $addresses);
				$orderedAddresses[$idx] = $addresses[$idx];
				$pivot = $addresses[$idx];
				unset($addresses[$idx]);
			}
			
			return $orderedAddresses;
		}
		
		/**
		 * Devuelve el indice del elemento de $results que se encuentra más cerca de $pivot.
		 * 
		 * $results es pasado por referencia por una cuestion de performance, pero no va a ser modificado.
		 */
		protected static function getIndexOfClosestTo($pivot, &$addresses) {
			$minIdx = 0;
			$minDistance = -1;
			
			foreach($addresses as $i => $address) {
				$distance = $pivot['address']->getDistanceTo($address['address']);
				if ($distance < $minDistance || $minDistance == -1) {
					$minIdx = $i;
					$minDistance = $distance;
				}
			}
			return $minIdx;
		}
		
		/**
		 * Reordena las addresses de un result basandose en un orden de ids dadas.
		 * 
		 * @param array $result, un elemento de los que componen los reuslts devueltos en otros métodos
		 * de esta misma clase.
		 * 
		 * @param array $addressesIds, ids de las addresses en el orden en que se quieren obtener.
		 */
		public static function reorderAddresses($result, $addressesIds) {
			$auxAddresses = array();
			foreach ($addressesIds as $key => $addressId) {
				if (isset($result['addresses'][$addressId]))
					$auxAddresses[$addressId] = $result['addresses'][$addressId];
			}
			$result['addresses'] = $auxAddresses;
			return $result;
		}
	}
?>