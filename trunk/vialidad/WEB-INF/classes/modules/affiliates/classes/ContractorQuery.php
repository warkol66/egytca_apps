<?php



/**
 * Skeleton subclass for representing a query for one of the subclasses of the 'affiliates_affiliate' table.
 *
 * Afiliados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.affiliates.classes
 */
class ContractorQuery extends BaseContractorQuery {

		/**
		 * Permite agregar un filtro personalizado a la Query, que puede ser
		 * traducido al campo correspondiente.
		 *
		 * @param   type $filterName
		 * @param   type $filterValue
		 * @return  AffiliateQuery
		 */
		public function addFilter($filterName, $filterValue) {

			switch ($filterName) {
				case 'searchString':
						$this->filterByName("%$filterValue%", Criteria::LIKE);
						break;

				default:
						if (in_array(ucfirst($filterName), AffiliatePeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
								$this->filterBy(ucfirst($filterName), $filterValue);
						else { //Log - campo inexistente.
						}
						break;
			}
			return $this;
		}

		/**
		 * Permite agregar un filtro personalizado a la Query, que puede ser
		 * traducido al campo correspondiente.
		 *
		 * @param   type $filterName
		 * @param   type $filterValue
		 * @return  AffiliateQuery
		 */
		public function addFilters($filters) {

			foreach(array_keys($filters) as $filterKey) {
				if (isset($filters[$filterKey])) {
					switch ($filterKey) {
						case 'searchString':
								$this->filterByName("%$filters[$filterKey]%", Criteria::LIKE);
								break;
						case 'perPage':
								$this->limit($filters[$filterKey]);
								break;
						default:
								if (in_array(ucfirst($filterName), AffiliatePeer::getFieldNames(BasePeer::TYPE_PHPNAME)))
										$this->filterBy(ucfirst($filterName), $filterValue);
								else { //Log - campo inexistente.
								}
								break;
					}
					return $this;
				}
			}
		}

		/**
		 * Agrega el limite a la consulta, si existe.
		 *
		 * @param   int $limit
		 * @return  AffiliateQuery
		 */
		public function limitIfExists($limit = null) {

				if (!empty($limit)) {
						$this->limit($limit);
				}
				return $this;
		}

} // ContractorQuery
