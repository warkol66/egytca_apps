<?php

/**
 * Representa el procesamiento de un Template de Newsletter con su External incorporado
 * sin haberle realizado los reemplazos necesarios para el usuario
 * @package    infocivica
 */
class NewsletterTemplateRender  {

	private $subject;
	private $body;
	private $customUserReplacements = array(
			'(\{userRegistrationDate\})' => 'getCreated',
			'(\{userRegistrationIP\})' => 'getIp',
			'(\{setUserRegistrationName\})' => 'getName',
			'(\{setUserRegistrationLastname\})' => 'getSurName'
		);


	/**
	 * Initializes internal state of NewsletterTemplateRender object.
	 */
	public function __construct() {
		
		$this->subject = '';
		$this->body = '';
	}
	
	private function processMatch($user,$condition,$match,$callback,$processedString) {
		
		$userInfo = $user->getUserInfo();
		
		$replacement = '';
		
		if (method_exists($user,$callback)) {
			$replacement = $user->$callback();
		}
		else {
			if (method_exists($userInfo,$callback)) {
				$replacement = $userInfo->$callback();
			}
		}

		return ereg_replace($condition,$replacement,$processedString);
		
	}
	
	/**
	 * Personaliza el cuerpo del mensaje rendereado a un usuario por registracion
	 * @param RegistrationUser instancia de RegistrationUser
	 * @todo
	 */
	public function getCustomBody($user) {

		$unprocessedContent = $this->body;

		$splittedContent = split(' ',$unprocessedContent);
		$processedContent = '';
		
		foreach ($splittedContent as $string) {
			$processedString = $string;
			foreach ($this->customUserReplacements as $condition => $callback ) {
				$match = array();
				if (ereg($condition,$string,$match)) {
					//se encontro un match
					$processedString = $this->processMatch($user,$condition,$match[1],$callback,$processedString);
				}
			}
			$processedContent .= "$processedString ";
		}
		
		if ($user->isImported()) {
			$processedContent .= $this->buildUserVerificationText($processedContent,$user);
		}

		return $processedContent;

	}
	
	private function buildUserVerificationText($processedContent,$user) {
		
		//require_once('RegistrationUserPeer.php');
		
		$hash = RegistrationUserPeer::generateHash($user);
		global $system;
		$url = $system["config"]["system"]["parameters"]["siteUrl"];
				
		$text = "<p>Si desea completar su registro en Infocivica clickee el siguiente <a href=".$url."/Main.php"."?do=registrationDoHashVerification&amp;hash=".$hash.">link</a></p>";
		return ereg_replace('</body>',$text.'</body>',$processedContent);
		
	}


	/**
	 * Define el cuerpo del render del template de newsletter
	 * @param string
	 */	
	public function setBody($body) {
		$this->body = $body;
	}

	/**
	 * Define el asunto del render del template de newsletter
	 * @param string
	 */	
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Devuelve el cuerpo del render del template de newsletter
	 * @param string
	 */	
	public function getBody() {
		return $this->body;
	}

	/**
	 * Devuelve el asunto del render del template de newsletter
	 * @param string
	 */	
	public function getSubject() {
		return $this->subject;
	}	

} // NewsletterTemplate
