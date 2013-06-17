<?php



/**
 * Skeleton subclass for performing query and update operations on the 'vialidad_certificate' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class CertificateQuery extends BaseCertificateQuery {
	
	public function __construct($dbName = 'application', $modelName = 'Certificate', $modelAlias = null) {
		parent::__construct($dbName, $modelName, $modelAlias);
		$user = Common::getLoggedUser();
		if (get_class($user) == "AffiliateUser")
			$this->useMeasurementRecordQuery()->useConstructionQuery()->useContractQuery()
				->filterByAffiliate($user->getAffiliate())->endUse()->endUse()->endUse();
	}
	
	/**
	 * filtra la Query por searchString
	 */
	public function filterBySearchString($value, $comparison = Criteria::LIKE) {
		
		return $this->useMeasurementRecordQuery()
			->useConstructionQuery()
				->filterByName("%$value%", $comparison)
			->endUse()
		->endUse();
	}
	
	/**
	 * Filters all objects associated to a CertificateInvoice
	 */
	public function filterByHasNoCertificateInvoice() {
		
		$existentCertificateInvoices = CertificateInvoiceQuery::create()->find();
		foreach ($existentCertificateInvoices as $existentCertificateInvoice)
			$this->filterByInvoice($existentCertificateInvoice, Criteria::NOT_EQUAL);
		
		return $this;
	}
	
	/**
	 * Permite agregar un filtro personalizado a la Query, que puede ser
	 * traducido al campo correspondiente.
	 *
	 * @param   type $filterName
	 * @param   type $filterValue
	 * @return  ModelCriteria
	 */
	public function addFilter($filterName, $filterValue) {

		$filterName = ucfirst($filterName);
		
		// empty() no sirve porque algunos filtros admiten 0 como valor
		if (!isset($filterValue) || $filterValue == null)
			return $this;
		if (is_array($filterValue)) {
			foreach ($filterValue as $value) {
				if (!isset($value) || $value == null)
					return $this;
			}
		}

		switch ($filterName) {
			case 'SearchString':
				$this->filterByName("%$filterValue%", Criteria::LIKE);
				break;
			case 'Date':
				$this->useMeasurementRecordQuery()->filterByMeasurementdate($filterValue, Criteria::IN)->endUse();
				break;
			case 'Constructionid':
				$this->useMeasurementRecordQuery()->filterByConstructionid($filterValue)->endUse();
				break;
			case 'Contractid':
				$this->useMeasurementRecordQuery()->
					useConstructionQuery()->filterByContractid($filterValue)
					->endUse()->endUse();
				break;
			case 'Contractorid':
				$this->useMeasurementRecordQuery()->
					useConstructionQuery()->
					useContractQuery()->filterByContractorid($filterValue)
					->endUse()->endUse();
				break;
			default:
				if (in_array($filterName, MeasurementRecordPeer::getFieldNames(BasePeer::TYPE_PHPNAME))
					|| is_array($filterValue) )
						$this->filterBy($filterName, $filterValue);
				else {
						//Log - campo inexistente.
				}

				break;
		}

		return $this;
	}

	/**
	 * Agrega multiples filtros a la Query.
	 *
	 * @see     addFilter
	 * @param   type $filters
	 * @return  ModelCriteria
	 */
	public function addFilters($filters = array()) {
		foreach ($filters as $name => $value)
				$this->addFilter($name, $value);

		return $this;
	}
	
	/**
	 * Crea un pager.
	 *
	 * @param   array $filters
	 * @param   int $page
	 * @param   int $perPage
	 * @return  PropelModelPager
	 */
	public function createPager($filters, $page = 1, $perPage = 10) {
		return $this->addFilters($filters)->paginate($page, $perPage);
	}

} // CertificateQuery
