<?php



/**
 * Skeleton subclass for representing a row from the 'panel_reportSection' table.
 *
 * Seccion de reporte al BM
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ReportSection extends BaseReportSection {

	/**
	* Obtiene el nombre del padre de una seccion.
	*
	* @return string nombre del padre de una seccion
	*/
	function getParentName() {
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getName();
		}
		else
			return;
	}

	/**
	* Obtiene el id del padre de una seccion.
	*
	* @return int id del padre de una seccion
	*/
	function getParentId() {
		$parent = $this->getParent();
		if (!empty($parent)) {
			return $parent->getId();
		}
		else
			return -1;
	}
	
	/**
	* Obtiene el nombre traducido del tipo de seccion.
	*
	* @return string tipo de seccion
	*/
	function getTypeTranslated()
	{
		$type = $this->getType();

		$sectionTypes = ReportSectionPeer::getTypes();
		$sectionTypesName = $sectionTypes[$type];
		$sectionTypesNameTranslated = Common::getTranslation($sectionTypesName,'positions');
		return $sectionTypesNameTranslated;

	}
	
	/**
	 * Obtiene el objeto asociado a la sección.
	 */
	public function getObject() {
		$objectPeer = $this->getObjectType() . 'Peer';
		return call_user_func(array($objectPeer, 'get'), $this->getObjectId());
	}
} // ReportSection
