<?php



/**
 * Skeleton subclass for representing a row from the 'panel_guarantee' table.
 *
 * Base de Garantías
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class Guarantee extends BaseGuarantee {

	/** the default item name for this class */
	const ITEM_NAME = 'Guarantee';

	/**
	* Obtiene el nombre del proyecto asociado a la garantía
	*
	*	@return string nombre del proyecto
	*/
	function getProjectName() {
		$project = ProjectQuery::create()->findPk($this->getProjectId());
		if (is_object($project))
			return $project->getName();
		else
			return;
	}

	/**
	* Obtiene el nombre del proyecto asociado a la garantía
	*
	*	@return string nombre del proyecto
	*/
	function getContractorName() {
		$contractor = ContractorQuery::create()->findPk($this->getContractorId());
		if (is_object($contractor))
			return $contractor->getName();
		else
			return;
	}

	/**
	* Obtiene el nombre del proyecto asociado a la garantía
	*
	*	@return string nombre del proyecto
	*/
	function getCurrencyName() {
		$currencies = GuaranteePeer::getCurrencies();
		$currencyName = $currencies[$this->getCurrency()];
		return $currencyName;
	}

	/**
	* Obtiene el nombre del proyecto asociado al acto administrativo
	*
	*	@return string nombre del prestamo
	*/
	function getPolicyGuidelineName() {
		$project = ProjectQuery::create()->findPk($this->getProjectId());
		if (is_object($project)) {
			$objective = ObjectiveQuery::create()->findPk($project->getObjectiveId());
			if (is_object($objective))
				return $objective->getPolicyGuideline();
			else
				return;
		}
		else
			return;
	}

} // Guarantee
