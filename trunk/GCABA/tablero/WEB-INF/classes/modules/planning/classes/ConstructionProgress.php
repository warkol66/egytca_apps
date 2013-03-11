<?php



/**
 * Skeleton subclass for representing a row from the 'planning_constructionProgress' table.
 *
 * Ejecucion fisico/financiera
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class ConstructionProgress extends BaseConstructionProgress {

	/**
	 * Obtiene la diferencia de avance fisico del planificado vs real
	 */
	public function getFinancialDelta() {
		$delta = $this->getRealFinancialProgress() - $this->getFinancialProgress();
		return $delta;
	}

	/**
	 * Obtiene la diferencia de avance finaciero del planificado vs real
	 */
	public function getPhysicalDelta() {
		$delta = $this->getRealPhysicalProgress() - $this->getPhysicalProgress();
		return $delta;
	}

} // ConstructionProgress
