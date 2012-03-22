<?php

class ErrorReporter {
	
	/*
	 * Sends a mail with the errors report to the debug responsible
	 */
	public static function report($errors) {
		require_once 'EmailManagement.php';
		
		$emailMgr = new EmailManagement();
		$emailMgr->setTestMode(true);
		
		$recipients = null; // will be overriden
		$subject = 'errors parsing headlines';
		$mailFrom = 'canuhedc@gmail.com';
		$mailBody = '';
		
		foreach ($errors as $error) {
			$mailBody .= "error: ".$error["code"]."\n";
		}
		
		$message = $emailMgr->createTextMessage($subject, $mailBody);
		$result = $emailMgr->sendMessage($recipients, $mailFrom, $message);
		if ($result == 0)
			throw new Exception('an error ocurred while sending the mail');
	}
}