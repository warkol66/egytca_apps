<?php


/**
 * Skeleton subclass for representing a row from the 'positions_position' table.
 *
 * Cargos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class Position extends BasePosition {

	/**
	 * Devuelve coleccion de objetos asociados (ImpactObjectives)
	 *
	 * @return coll objetos asociados al cargo
	 */
	public function getBrood() {
		return $this->getImpactObjectives();
	}

	/**
	 * Devuelve cantidad de objetos asociados (ImpactObjectives)
	 *
	 * @return int  cantidad de objetos asociados al cargo
	 */
	public function countBrood() {
		return $this->countImpactObjectives();
	}

	/**
	 * Devuelve el objeto (null) del que se desprende la dependencia
	 *
	 * @return null del que se desprende la dependencia
	 */
	public function getAntecessor() {
		return null;
	}

	/**
	 * Devuelve el nombre mas la particula identificatoria
	 *
	 * @return string
	 */
	public function getTreeName() {
		$pre = ConfigModule::get("planning","preTreeName");
		return $pre[get_class($this)].$this->getName();
	}

	/**
	* Obtiene el nombre del padre de un position.
	*
	* @return string Nombre del padre del position
	*/
	function getParentName() {
		$parent = $this->getParent();
		if (!empty($parent))
			return $parent->getName();
		else
			return;
	}

	/**
	* Obtiene el id del padre de un position.
	*
	* @return integer id del padre del position
	*/
	function getParentId() {
		$parent = $this->getParent();
		if (!empty($parent))
			return $parent->getId();
		else
			return -1;
	}

	/**
	* Obtiene el nombre traducido fel tipo de position.
	*
	* @return array tipos de position
	*/
	function getPositionTypeTranslated() {
		$type = $this->getType();

		$positionTypes = PositionPeer::getPositionTypes();
		$positionTypeName = $positionTypes[$type];
		$positionTypeNameTranslated = Common::getTranslation($positionTypeName,'positions');
		return $positionTypeNameTranslated;

	}

	/**
	* Obtiene el tenure actual
	*
	* @return object tenure actual
	*/
	public function getActiveTenure() {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::DATETO,null);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0) {
			$tenure = new PositionTenure();
			$tenure->setPosition($this);
		} else {
			$tenure = $tenures[0];
		}
		return $tenure;
	}

	/**
	* Obtiene el nombre del tenure actual
	*
	* @return object tenure actual
	*/
	public function getActiveTenureName() {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::DATETO,null);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0) {
			$tenure = new PositionTenure();
			$tenure->setPosition($this);
		}
		else
			$tenure = $tenures[0];

		if ($tenure->getUserId() > 0)
			$tenure = UserQuery::create()->findOneById($tenure->getUserId());

		return $tenure;
	}

	/**
	* Obtiene el position a partir del tenure id
	*
	* @param integer $tenureId tenure id.
	* @return object tenure actual
	*/
	public function getPositionTenure($tenureId) {
		$criteria = new Criteria();
		$criteria->add(PositionTenurePeer::ID,$tenureId);
		$tenures = $this->getPositionTenures($criteria);
		if (count($tenures) == 0)
			$tenure = null;
		else
			$tenure = $tenures[0];

		return $tenure;
	}

	/**
	* Crea la tenure a partir de parametros
	*
	* @param params array 
	* @return object tenure creado
	*/
	public function createTenure($params) {
		//agrego la relacion con position
		$params["positionCode"] = $this->getCode();
		return PositionTenurePeer::create($params);
	}

	/*
	* Obtiene todas los projects asociados a la instancia.
	*
	* @param Criteria $query, criteria para aplicar a los proyectos.
	* @return PropelCollection $projects
	*/
	public function getAllProjectsWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$projects = ProjectQuery::create(null, $query)->findByResponsibleCode($positionCodes);

		return $projects;
	}

	/*
	* Obtiene la cantidad total de projects asociados a la instancia.
	*
	* @param Criteria $query, criteria para aplicar a los proyectos.
	* @return int $count
	*/
	public function getAllProjectsCountWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$count = ProjectQuery::create(null, $query)->filterByResponsibleCode($positionCodes)->count();

		return $count;
	}

	/*
	* Obtiene todas los objectives asociados a la instancia.
	*
	* @param Criteria $query, criteria para aplicar a los objetivos.
	* @return PropelCollection $objectives
	*/
	public function getAllObjectivesWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$objectives = ObjectiveQuery::create(null, $query)->findByResponsibleCode($positionCodes);

		return $objectives;
	}

	/*
	* Obtiene la cantidad total de objectives asociados a la instancia.
	*
	* @param Criteria $query, criteria para aplicar a los objetivos.
	* @return int $count
	*/
	public function getAllObjectivesCountWithDescendants($query = null) {
		$positionCodes = array();
		$positionCodes[] = $this->getCode();
		if ($this->hasChildren()){
			$descendants = $this->getDescendants();
			foreach ($descendants as $descendant)
				$positionCodes[] = $descendant->getCode();
		}
		$count = ObjectiveQuery::create(null, $query)->filterByResponsibleCode($positionCodes)->count();

		return $count;
	}

	/*
	* Obtiene todas los projects asociados a la instancia.
	*
	* @return PropelCollection $projects
	*/
	public function getAllProjects() {
		return ProjectQuery::create()->findByResponsibleCode($this->getCode());
	}

	/*
	* Obtiene la cantidad total de projects asociados a la instancia.
	*
	* @return int $count
	*/
	public function getAllProjectsCount() {
		return ProjectQuery::create()->filterByResponsibleCode($this->getCode())->count();
	}

	/*
	* Obtiene todas los objectives asociados a la instancia.
	*
	* @return PropelCollection $objectives
	*/
	public function getAllObjectives() {
		return ObjectiveQuery::create()->findByResponsibleCode($this->getCode());
	}

	/*
	* Obtiene la cantidad total de objectives asociados a la instancia.
	*
	* @return int $count
	*/
	public function getAllObjectivesCount() {
		return ObjectiveQuery::create()->filterByResponsibleCode($this->getCode())->count();
	}

	/**
	 * Redefinimos el método para que el userGroupId se setee en todos los descendientes.
	 *
	 * @param int $userGroupId
	 */
	public function setUserGroupId($userGroupId) {
		if (empty($userGroupId) || $userGroupId <= 0)
			$userGroupId = NULL;
		parent::setUserGroupId($userGroupId);
		foreach ($this->getChildren() as $child) {
			if ($child->getPlanning() != 1)
				$child->setUserGroupId($userGroupId)->save();
		}
		return $this;
	}

} // Position
