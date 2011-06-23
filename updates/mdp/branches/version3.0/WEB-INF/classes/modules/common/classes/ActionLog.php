<?php


/**
 * Skeleton subclass for representing a row from the 'actionLogs_log' table.
 *
 * logs del sistema
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class ActionLog extends BaseActionLog {

	private $queryObjs = array(
		'user' => 'UserQuery',
		'affiliate' => 'AffiliateUserQuery'
	);

	/**
	 * Obtiene el usuario remitente.
	 */
	public function getUserObject() {
		$criteria = new $this->queryObjs[$this->getUserObjectType()];
		return $criteria->findPk($this->getUserObjectId());
	}

	/**
	*
	* Obtiene la etiqueta de ese modulo
	*
	* @return string label la etiqueta
	*/
	
	function getLabel(){
		
		try{
		include_once 'ActionLogLabelPeer.php';
		global $system;
		$language = Common::getCurrentLanguageCode();
		if(empty($language))
			$language='eng';
		$logLabelInfo=ActionLogLabelPeer::getByInfo($this->GetAction(),$this->GetForward(),$language);
		return $logLabelInfo;
		}catch (PropelException $e) {}
	}

	/**
	* getActionLabel
	* Obtiene la etiqueta del action
	*
	* @return string label la etiqueta
	*/
	
	function getActionLabel(){
		
		try{
			include_once 'SecurityActionLabelPeer.php';
	
			$language = Common::getCurrentLanguageCode();
			if(empty($language))
				$language='eng';
			$actionLabelInfo = SecurityActionLabelPeer::getByActionAndLanguage($this->getAction(),$language);
			return $actionLabelInfo;
		}catch (PropelException $e) {}
	}

	public function getSecurityAction() {
		
		$result = parent::getSecurityAction();
		
		//si es un action con Do, buscamos la informacion sin el do
		//ya que en ese caso se da de alta como pair
		if (empty($result) && (preg_match("/(.*)([a-z]Do[A-Z])(.*)/",$this->getAction(),$parts))) {
			
			$actionWithoutDo = $parts[1].$parts[2][0].$parts[2][3].$parts[3];
			$result = SecurityActionPeer::get($actionWithoutDo);		
		
		}
		
		return $result;
	
	}

	function getAffiliateUser(){
		$criteria = new Criteria();
		require_once('AffiliateUserPeer.php');
		return AffiliateUserPeer::get($this->getAffiliateId());
	}

} // ActionLog
