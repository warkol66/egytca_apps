<?php



/**
 * Skeleton subclass for representing a row from the 'panel_adminActParticipant' table.
 *
 * Base de participantes en actos administrativos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.panel.classes
 */
class AdminActParticipant extends BaseAdminActParticipant {

	public function getObject() {
		switch ($this->getObjectType()) {
			case "User":
				$object = UserPeer::get($this->getObjectId());
				break;
			case "Actor":
				$object = ActorPeer::get($this->getObjectId());
				break;
		}
		return $object;
	}

	public function getName() {
		$object = $this->getObject();
		if (is_object($object))
			return $object->getName();
		else
			return;
	}

	public function getSurname() {
		$object = $this->getObject();
		if (is_object($object))
			return $object->getSurname();
		else
			return;
	}

	public function getInstitution() {
		$object = $this->getObject();
		if (get_class($object) == "Actor")
			return $object->getInstitution();
		else
			return;
	}

	public function getTitle() {
		$object = $this->getObject();
		if (get_class($object) == "Actor")
			return $object->getTitle();
		else
			return;
	}

} // AdminActParticipant
