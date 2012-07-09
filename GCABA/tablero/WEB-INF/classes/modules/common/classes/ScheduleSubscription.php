<?php



/**
 * Skeleton subclass for representing a row from the 'common_scheduleSubscription' table.
 *
 * Suscripciones de schedulea
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class ScheduleSubscription extends BaseScheduleSubscription {
	public function save(PropelPDO $con = null) {
		try {
			if ($this->validate()) { 
				parent::save($con);
				return true;
			} else {
				return false;
			}
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	public function hasUser($user) {
		return $this->countUsers(UserQuery::create()->findPk($user->getPrimaryKey())) > 0;
	}
	
	public function removeUser($userId) {
		return ScheduleSubscriptionUserQuery::create()->filterByScheduleSubscriptionId($this->getId())
												   ->filterByUserId($userId)
												   ->delete();
	}
	
	public function getRecipients() {
		$users = $this->getUsers();
		$recipients = array();
		foreach($users as $user) {
			$recipients[] = $user->getMailAddress();
		}
		$extraRecipients = $this->getExtraRecipients();
		if (!empty($extraRecipients)) {
			$extraRecipients = explode(',', $extraRecipients);
			$recipients = array_merge($recipients, $extraRecipients);
		}
		return $recipients;
	}
	
	public function getEntitiesFiltered() {
		$entityName = $this->getModuleEntity()->getPhpName();
		$dateFieldName = $this->getModuleEntityFieldRelatedByEntityDateFieldUniqueName()->getName();
		$booleanEntityField = $this->getModuleEntityFieldRelatedByEntityBooleanFieldUniqueName();
		if (!empty($booleanEntityField))
			$booleanFieldName = $booleanEntityField->getName();
		$max = new DateTime('today');
		$min = new DateTime('today');
		$schedulePeriodCount = $this->getAnticipationdays();
		$config = Common::getConfiguration('system');
		$schedulePeriodType = $config['schedule']['timePeriod']['type']['value'];
		$max->modify("+$schedulePeriodCount days");
		if ($schedulePeriodType == 'MONTHS_COUNT') {
			//Descomentar esta linea si se quiere excluir los dias restantes en el mes actual.
			//$min->modify('- '. (date('d') - 1) . ' days + 1 month');
			$max->modify('- '. ($max->format('d')) . ' days + 1 month');
		}
		$queryClassName = $entityName . 'Query';
		$filterByDateMethodName = 'filterBy' . $dateFieldName;
		$filterByBooleanMethodName = 'filterBy' . $booleanFieldName;
		if (class_exists($queryClassName) && method_exists($queryClassName, $filterByDateMethodName)) {
			$query = new $queryClassName;
			call_user_func(array($query, $filterByDateMethodName), array('min' => $min, 'max' => $max ));
			if (!empty($booleanFieldName) && method_exists($queryClassName, $filterByBooleanMethodName)) {
				//Evaluamos contra NULL
				$query->$filterByBooleanMethodName(null, Criteria::ISNULL);
				//Evaluamos contra 0
				$query->orWhere($entityName . '.' . ucfirst(strtolower($booleanFieldName)) . ' = ?', 0);
				//Evaluamos contra ''
				$query->orWhere($entityName . '.' . ucfirst(strtolower($booleanFieldName)) . ' = ?', '');
			}
			$entities = call_user_func(array($query, 'find'));
		}
		return $entities;
	}
	
	public function getPosibleNameFields() {
		return ScheduleSubscriptionPeer::getPosibleNameFieldsByEntityName($this->getEntityName());
	}
	
	public function getPosibleTemporalFields() {
		return ScheduleSubscriptionPeer::getPosibleTemporalFieldsByEntityName($this->getEntityName());
	}
	
	public function getPosibleBooleanFields() {
		return ScheduleSubscriptionPeer::getPosibleBooleanFieldsByEntityName($this->getEntityName());
	}
} // ScheduleSubscription
