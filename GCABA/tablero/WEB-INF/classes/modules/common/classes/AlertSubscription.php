<?php



/**
 * Skeleton subclass for representing a row from the 'common_alertSubscription' table.
 *
 * Suscripciones de alerta
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class AlertSubscription extends BaseAlertSubscription {
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
		return AlertSubscriptionUserQuery::create()->filterByAlertSubscriptionId($this->getId())
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
		$extraRecipients = explode(',', $extraRecipients);
		$recipients = array_merge($recipients, $extraRecipients);
		return $recipients;
	}
	
	public function getEntitiesFiltered() {
		$entityName = $this->getModuleEntity()->getPhpName();
		$fieldName = $this->getModuleEntityFieldRelatedByEntityfielduniquename()->getName();
		$max = new DateTime('today');
		$min = new DateTime('today');
		$alertPeriodCount = $this->getAnticipationdays();
		$max->modify("+$alertPeriodCount days");
		$queryClassName = $entityName . 'Query';
		$filterMethodName = 'filterBy' . $fieldName;
		if (class_exists($queryClassName) && method_exists($queryClassName, $filterMethodName)) {
			$query = new $queryClassName;
			call_user_func(array($query, $filterMethodName), array('min' => $min, 'max' => $max ));
			$entities = call_user_func(array($query, 'find'));
		}
		return $entities;
	}
	
	public function getPosibleNameFields() {
		return AlertSubscriptionPeer::getPosibleNameFieldsByEntityName($this->getEntityName());
	}
	
	public function getPosibleTemporalFields() {
		return AlertSubscriptionPeer::getPosibleTemporalFieldsByEntityName($this->getEntityName());
	}
} // AlertSubscription
