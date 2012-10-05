<?php

class ErrorReporter {
	
	/*
	 * Sends a mail with the errors report to the debug responsible
	 */
	public static function report($errors) {
		require_once 'EmailManagement.php';
		
		$emailMgr = new EmailManagement();
		
		global $system;
		
		$recipients = explode(',', $system['config']['system']['parameters']['debugMail']);
		$subject = $system['config']['system']['parameters']['siteShortName'] . " / errors parsing headlines " . Common::getLoggedUser();
		$mailFrom = $system['config']['system']['parameters']['fromEmail'];
		$mailBody = '';
		
		foreach ($errors as $error) {
			$mailBody .= "[user: " . Common::getLoggedUser() . "] "
				. "error parsing headlines using strategy "
				. $error['strategy'].": ".$error["message"]." [".$error["code"]."]\n";
		}
		
		$message = $emailMgr->createTextMessage($subject, $mailBody);
		$result = $emailMgr->sendMessage($recipients, $mailFrom, $message);
		if ($result == 0)
			throw new Exception('an error ocurred while sending the mail');
	}

}