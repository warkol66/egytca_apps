<?php



/**
 * Skeleton subclass for representing a row from the 'panel_administrativeAct' table.
 *
 * Base de Actos Administrativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class AdministrativeAct extends BaseAdministrativeAct {

	/** the default item name for this class */
	const ITEM_NAME = 'Administrative Act';

	/**
	* Obtiene el nombre del proyecto asociado al acto administrativo
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
	* Obtiene el nombre traducido del tipo de acto.
	*
	* @return string nombre del tipo
	*/
	function getTypeTranslated() {
		$type = $this->getType();
		$types = AdministrativeActPeer::getAdministrativeActTypes();
		$typeName = $types[$type];
		$typeNameTranslated = Common::getTranslation($typeName,'panel');
		return $typeNameTranslated;
	}

	/**
	* Obtiene el nombre del proyecto asociado al acto administrativo
	*
	*	@return string nombre del proyecto
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

} // AdministrativeAct
