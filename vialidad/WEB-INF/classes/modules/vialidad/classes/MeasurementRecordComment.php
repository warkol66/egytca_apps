<?php



/**
 * Skeleton subclass for representing a row from the 'vialidad_measurementRecordComment' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.vialidad.classes
 */
class MeasurementRecordComment extends BaseMeasurementRecordComment {
	
	public function getUser() {
		if (is_null($this->getUserid()))
			return null;
		
		switch ($this->getUsertype()) {
			case MeasurementRecordCommentPeer::USERTYPE_AFFILIATES_USER:
				return AffiliateUserQuery::create()->findOneById($this->getUserid());
			case MeasurementRecordCommentPeer::USERTYPE_USERS_USER:
				return UserQuery::create()->findOneById($this->getUserid());
			default:
				throw new Exception('comment has user id but user type is not recognized');
		}
	}

} // MeasurementRecordComment
