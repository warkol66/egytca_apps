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

} // Contract
