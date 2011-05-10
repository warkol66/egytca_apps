<?php



/**
 * Skeleton subclass for representing a row from the 'panel_resultFrameIndicator' table.
 *
 * Indicador del Marco de Resultados
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class ResultFrameIndicator extends BaseResultFrameIndicator {
	/**
	* Obtiene el nombre del padre de un indicador.
	*
	* @return string nombre del padre de un indicador
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
	* Obtiene el id del padre de un indicador.
	*
	* @return int id del padre de un indicador
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
	* Obtiene el nombre traducido del tipo de indicador.
	*
	* @return string tipo de indicador
	*/
	function getTypeTranslated() {
		$type = $this->getType();

		$indicatorTypes = ResultFrameIndicatorPeer::getTypes();
		$indicatorTypesName = $indicatorTypes[$type];
		$indicatorTypesNameTranslated = Common::getTranslation($indicatorTypesName,'panel');
		return $indicatorTypesNameTranslated;
	}
	
	/**
	 * Obtiene el objeto asociado al indicador.
	 */
	public function getObject() {
		$objectPeer = $this->getObjectType() . 'Peer';
		return call_user_func(array($objectPeer, 'get'), $this->getObjectId());
	}
	
	/**
	 * 
	 * @return PolicyGuideline, la policyGuideline de la que cuelga el indicador. 
	 * NULL si es la raiz.
	 */
	public function getPolicyGuideline() {
		$indicator = $this;
		while (!empty($indicator) && $indicator->getObjectType() != 'PolicyGuideline') {
			$indicator = $indicator->getParent();
		}
		if (!empty($indicator))
			return $indicator->getObject();
		return NULL;
	}
	
	/**
	 * 
	 * @return int, año de inicio de la policyGuideline correspondiente. 
	 */
	public function getStartingYear() {
		$policyGuideline = $this->getPolicyGuideline();
		if (!empty($policyGuideline))
			return $this->getPolicyGuideline()->getStartingYear();
		return NULL;
	}
	
	/**
	 * 
	 * @return int, año de finalización de la policyGuideline correspondiente. 
	 */
	public function getEndingYear() {
		$policyGuideline = $this->getPolicyGuideline();
		if (!empty($policyGuideline))
			return $this->getPolicyGuideline()->getEndingYear();
		return NULL;
	}
	
	/**
	 * 
	 * @return int, cantidad de años de duración de la policyGuideline.
	 */
	public function getYearsCount() {
		return $this->getEndingYear() - $this->getStartingYear();
	}
	
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Devuelve un array asociativo con los valores asociados al indicador.
	 * @return array asociativo, year => ResultFrameValue.
	 */
	public function getValues() {
		$resultFrameValues = array();
		$startingYear = $this->getStartingYear();
		$endingYear = $this->getEndingYear();
		
		if (!empty($startingYear) && !empty($endingYear)) {
			for ($year = $startingYear; $year <= $endingYear; $year++) {
				// Solo creamos valores nuevos si no existe alguno previamente.
				$query = ResultFrameValueQuery::create()->filterByResultFrameIndicatorId($this->getId())->filterByYear($year);
				$resultFrameValues[$year] = $query->findOneOrCreate();
			}
		}
		return $resultFrameValues;
	}
} // ResultFrameIndicator
