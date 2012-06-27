<?php



/**
 * Skeleton subclass for representing a row from the 'planning_operativeObjective' table.
 *
 * Objetivos operativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.planning.classes
 */
class OperativeObjective extends BaseOperativeObjective {

	/**
	 * Devuelve un string con quien modifico el Proyecto (PlanningProject)
	 *
	 * @return string nombre del usuario que modifico el proyecto
	 */
	public function updatedBy() {
		if ($this->getUserobjecttype() != "") {
			$objectQueryName = $this->getUserobjecttype() . 'Query';
			if (class_exists($objectQueryName)) {
				$query = BaseQuery::create($this->getUserobjecttype());
				return $query->findPK($this->getUserobjectid());
			}
		}
		return;
	}

	/**
	 * Devuelve array con posibles productos organizacionales (ProductKinds)
	 *  id => productos organizacionales
	 *
	 * @return array productos organizacionales
	 */
	public static function getProductKinds() {
		$productKinds = array(
			1 => 'Producción Externa',
			2 => 'Producción Organizacional',
			3 => 'Producción Interna'
		);
		return $productKinds;
	}

	/**
	 * Devuelve array con posibles generos (PopulationGender)
	 *  id => generos
	 *
	 * @return array generos
	 */
	public static function getPopulationGender() {
		$populationGender = array(
			0 => 'No aplica',
			1 => 'Mujer',
			2 => 'Hombre'
		);
		return $populationGender;
	}

} // OperativeObjective
