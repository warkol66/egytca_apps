<?php


/**
* Imports a csv file to the database
*/
class RegistrationImporter
{
	
	private $filename;
	private $report;
	
	public function __construct($filename) {
		$this->filename = $filename;
		$this->report = new RegistrationImportReport();
	}

	public function performImport() {

		$fd = fopen($this->filename, "r");
		$registrationUserPeer = new RegistrationUserPeer();
		
		while (($register = fgetcsv($fd,4096,";","'")) != FALSE) {
			
			$this->report->addRecordProcessed();
			
			$params = $this->convertRegister($register);				

			if(!$params) {
				$this->report->addConversionFailure($register);
			}
			else {
				$result = $registrationUserPeer->create($params['registrationUser'],$params['registrationUserInfo']);
				
				if (!$result)
					$this->report->addSaveFailure($register);
				else
					$this->report->addRecordSuccessfullyProcessed();
			}
			
		}
		return $this->report;

	}

	
	private function convertRegister($register) {
		$params = array();

		$params['registrationUser'] = array();
		$params['registrationUserInfo'] = array();
		
		if (!Common::validateEmail($register[3])) {
			//email invalido
			return false;
		}
		
		$params['registrationUserInfo']['mailAddress'] = $register[3];
		//genera un password random para el usuario
		$params['registrationUser']['password'] = 'password';
		//indica que el usuario esta siendo importado
		$params['registrationUser']['imported'] = true;
		$params['registrationUser']['active'] = true;
		
		if (!empty($register[0]))
			$params['registrationUserInfo']['name'] = $register[0];
		else
			$params['registrationUserInfo']['name'] = $register[2];
			
		$params['registrationUserInfo']['surname'] = $register[1];
		
		//lo subscribimos al newsletter
		$params['registrationUserInfo']['newsletterSubscribe'] = true;
		
		
		
		return $params;
	}

}

/**
* 
*/
class RegistrationImportReport
{
	
	private $recordsProcessed;
	private $conversionFailures;
	private $saveFailures;
	private $recordsSuccessfullyProcessed;
	
	function __construct() {
		$this->recordsProcessed = 0;
		$this->conversionFailures = array();
		$this->saveFailures = array();
		$this->recordsSuccessfullyProcessed = 0;
	}
	
	function addRecordProcessed() {
		$this->recordsProcessed++;
	}

	function addRecordSuccessfullyProcessed() {
		$this->recordsSuccessfullyProcessed++;
	}
	
	function getRecordsProcessed() {
		return $this->recordsProcessed;
	}

	function getRecordsSuccessfullyProcessed() {
		return $this->recordsSuccessfullyProcessed;
	}
	
	function addConversionFailure($register) {
		$this->conversionFailures[] = $register;
	}

	function addSaveFailure($register) {
		$this->saveFailures[] = $register;
	}
	
	function getConversionFailuresCount() {
		return count($this->conversionFailures);
	}

	function getSaveFailuresCount() {
		return count($this->saveFailures);
	}
	
	
}
