<?php

require_once 'swift/lib/swift_required.php';

/**
* Wrapper de la funcionalidades basicas de Swift.
*
* Encapsulamiento de los aspectos basicos de envio de email de Swift para
* liberar al usuario de sus opciones de configuracion.
*/
class EmailManagement
{
	private $testMode;

	public function __construct() {
		$testMode = false;
	}

	/**
	 * Crea una conexion a traves de la cual se podran enviar emails
	 * con la configuracion del sistema.
	 * @return Swift instance
	 * @throws Exception
	 */
	private function createMailer() {

		global $system;
		$mailMode = $system["config"]["email"]["mode"]["value"];

		if ( ($mailMode != 'SMTP') || ($mailMode == 'PHP'))
			$transport = Swift_SendmailTransport::newInstance('/usr/sbin/exim -bs');

		else if ($mailMode == 'SMTP') {

			$smtpHost = $system["config"]["email"]["smtpOptions"]["smtpHost"];
			$smtpPort = $system["config"]["email"]["smtpOptions"]["smtpPort"];
			$smtpSsl = $system["config"]["email"]["smtpOptions"]["smtpSsl"]["value"];
			$smtpUser = $system["config"]["email"]["smtpOptions"]["smtpUsername"];
			$smtpPassword = $system["config"]["email"]["smtpOptions"]["smtpPassword"];

			if ($smtpSsl == YES)
				$transport = Swift_SmtpTransport::newInstance($smtpHost, $smtpPort, 'ssl')
				  ->setUsername($smtpUser)
				  ->setPassword($smtpPassword)
				  ;
			else
				$transport = Swift_SmtpTransport::newInstance($smtpHost, $smtpPort)
				  ->setUsername($smtpUser)
				  ->setPassword($smtpPassword)
				  ;

			//Create the Mailer using your created Transport
			$mailer = Swift_Mailer::newInstance($transport);
		}

		return $mailer;

	}

	/**
	 * Crea un nuevo mensaje en HTML
	 * @param string subject of the email
	 * @param string HTML Content
	 */
	public function createHTMLMessage($subject,$mailBody) {

		$message = Swift_Message::newInstance();
		$message->setSubject($subject);
		$message->setBody($mailBody, 'text/html');

		return $message;

	}

	/**
	 * Crea un nuevo mensaje en HTML
	 * @param string subject of the email
	 * @param string HTML Content
	 */
	public function createTextMessage($subject,$mailBody) {

		$message = Swift_Message::newInstance();
		$message->setSubject($subject);
		$message->setBody($mailBody, 'text/plain');

		return $message;

	}

	/**
	 * Creates a Text only version of an HTML content
	 * @param string HTML mail body
	 */
	private function createTextFromHTML($mailBody) {
		//nos quedamos solo con el body
		$mailBody = str_replace('<br />',"<br />\r\n",$mailBody);
		$mailBody = str_replace('</p>',"<p>\r\n",$mailBody);
		$mailBody = preg_replace('/(<h[1-9]/>)/i',"\\1\r\n",$mailBody);
		return strip_tags($mailBody);
	}

	/**
	 * Crea un nuevo mensaje Multipart
	 * @param string subject of the email
	 * @param string HTML Content
	 */
	public function createMultipartMessage($subject,$mailBody) {

		$message = Swift_Message::newInstance();
		$message->setSubject($subject);
		$message->addPart($this->createTextFromHTML($mailBody), 'text/plain');
		$message->addPart($mailBody, 'text/html');
		return $message;

	}

	/**
	 * Envia un mensaje a un conjunto de destinatarios
	 *
	 * @param Swift_RecipientList o string lista de destinatarios creada usando createMultipleRecipientsList o string con email a enviar
	 * @param String email desde donde se envia el email
	 * @param Swift_Message Mensaje a enviar
	 * @param string direccion de respuesta
	 * @return boolean true si la operacion fue exitosa, false en caso de error
	 */
	public function sendMessage($recipients,$mailFrom,$message,$mailReplyTo="") {

		$result = false;

		if (!empty($mailReplyTo))
			$message->setReplyTo($mailReplyTo);

		try {
			//obtenemos en elemento de envio
			$mailer = $this->createMailer();

			$message->setFrom($mailFrom);
			
			if ($this->testMode) {
				$system = Common::getModuleConfiguration("system");
				$mailTo = $system['parameters']['debugMail'];
				$message->setTo($mailTo);
			} else {
				$message->setTo($recipients);
			}
			$result = $mailer->send($message);
		} catch (Exception $e) {
	//		print_r($e);
			return false;
		}

		return $result;

	}

	/**
	 * Crea una lista de multiples destinatarios para enviar un email
	 *
	 * @param message object de Swift
	 * @param array array de strings con destinatario para campo to
	 * @param array array de strings con destinatario para campo cc
	 * @param array array de strings con destinatario para campo bcc
	 * @return Swift_RecipientList Instancia de Swift_RecipientList, false en caso de error
	 */
	public function createMultipleRecipientsList($message,$toRecipients = array(),$ccRecipients = array(),$bccRecipients = array()) {

		if (empty($toRecipients) && empty($ccRecipients) && empty($bccRecipients))
			//se tiene que dar algun email como minimo para que se envie
			return false;

		foreach ($toRecipients as $email)
			$message->addTo($email);

		foreach ($ccRecipients as $email)
			$message->addCc($email);

		foreach ($bccRecipients as $email)
			$message->addBcc($email);

		return $message;

	}
	
	public function setTestMode($testMode = true) {
		$this->testMode = $testMode;
	}
}
