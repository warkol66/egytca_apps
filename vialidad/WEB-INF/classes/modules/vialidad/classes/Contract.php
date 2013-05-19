<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_contract' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class Contract extends BaseContract {

	/**
	 * Obtiene el Contractor
	 *
	 * @return  object contractor
	 */
	public function getContractor() {
		return $this->getAffiliate();
	}

	/**
	 * Obtiene los documentos asociados al contrato
	 *
	 * @return  propel Coll de documentos
	 */
	public function getDocuments() {
		return DocumentQuery::create()
					->useDocumentRelatedEntityQuery()
						->filterByEntitytype('Contract')
						->filterByEntityid($this->getId())
					->endUse()
					->find();
	}

	/**
	 * Devuelve array con tipos de contrato (types)
	 *  id => Tipo tipos de contrato
	 *
	 * @return array tipos de contrato
	 */
	public static function getTypes() {
		$types = array(
			1 => 'Obra',
			2 => 'Adquisiciones de Bienes y Servicios'
		);
		return $types;
	}

	/**
	 * Devuelve array con tipos de plazo (termTypes)
	 *  id => Tipo tipos de plazo
	 *
	 * @return array tipos de plazo
	 */
	public static function getTermTypes() {
		$termTypes = array(
			1 => 'días',
			2 => 'meses',
			3 => 'años'
		);
		return $termTypes;
	}

	/**
	 * Calcula la fecha de finalizacion
	 *
	 * @return  date fecha de finalizacion
	 */
	public function getCalculatedEndDate() {
		$calculatedEndDate = new DateTime($this->getSignDate('Y-m-d'));
		switch ($this->getValidationType()) {
		case 1:
			$calculatedEndDate->modify(+$this->getValidationLength() . ' days');
		case 2:
			$calculatedEndDate->modify(+$this->getValidationLength() . ' months');
		case 3:
			$calculatedEndDate->modify(+$this->getValidationLength() . ' yearts');
		}
		return $calculatedEndDate->format('Y-m-d');
	}

	/**
	 * Cuenta cuantos certificados hay
	 *
	 * @return  date fecha de finalizacion
	 */
	public function getCertificatesCount() {
		return CertificateQuery::create()
										->useMeasurementRecordQuery()
											->useConstructionQuery()
												->filterByContractid($this->getId())
											->endUse()
										->endUse()
									->count();
	}

	/**
	 * Cuenta cuantos certificados hay
	 *
	 * @return  date fecha de finalizacion
	 */
	public function getLastCertificateDate() {
		$lastCertificate = CertificateQuery::create()
										->useMeasurementRecordQuery()
										->orderByMeasurementDate(Criteria::DESC)
											->useConstructionQuery()
												->filterByContractid($this->getId())
											->endUse()
										->endUse()
									->findOne();
		if (!empty($lastCertificate))
			return $lastCertificate->getMeasureRecord()->getMeasurementDate();
		else
			return;
	}


} // Contract
