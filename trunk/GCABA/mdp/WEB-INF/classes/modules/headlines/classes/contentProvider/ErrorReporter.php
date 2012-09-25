<?php

class ErrorReporter {
	
	/*
	 * Sends a mail with the errors report to the debug responsible
	 */
	public static function report($errors) {
		require_once 'EmailManagement.php';
		
		$emailMgr = new EmailManagement();
		$emailMgr->setTestMode(true);
		
		global $system;
		
		$recipients = $system['config']['system']['parameters']['debugMail']; // will be overriden
		$subject = 'errors parsing headlines';
		$mailFrom = $system['config']['system']['parameters']['fromEmail'];
		$mailBody = '';
		
		foreach ($errors as $error) {
			$mailBody .= "[user: " . Common::getLoggedUser() . "] "
				. "error parsing headlines using strategy "
				. $error['strategy'].": ".$error["code"]."\n";
		}
		
		$message = $emailMgr->createTextMessage($subject, $mailBody);
		$result = $emailMgr->sendMessage($recipients, $mailFrom, $message);
		if ($result == 0)
			throw new Exception('an error ocurred while sending the mail');
	}
}