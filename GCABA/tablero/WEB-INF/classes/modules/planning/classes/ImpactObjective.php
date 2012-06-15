<?php



/**
 * Skeleton subclass for representing a row from the 'planning_impactObjective' table.
 *
 * Objetivos de Impacto
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ImpactObjective extends BaseImpactObjective {

	/**
	 * Devuelve array con posibles ejes de gestion (PolicyGuidelines)
	 *  id => ejes de gestion
	 *
	 * @return array ejes de gestion
	 */
	public static function getPolicyGuidelines() {
		$agendas = array(
			1 => 'Fortalecimiento de las políticas de promoción social, salud y educación',
			2 => 'Seguridad',
			3 => 'Movilidad sustentable'
		);
		return $agendas;
	}
	
	/**
	 * Devuelve array con posibles ejes de gestion (ExpectedResult)
	 *  id => resultado esperado
	 *
	 * @return array resultados esperados
	 */
	public static function getExpectedResults() {
		$agendas = array(
			1 => 'Incremento',
			2 => 'Descenso',
			3 => 'Aceleración',
			4 => 'Desaceleración'
		);
		return $agendas;
	}

	

} // ImpactObjective
