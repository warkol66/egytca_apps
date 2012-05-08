<?php
require_once("EmailManagement.php");

class CommonSendAlertsAction extends BaseAction {

	function CommonSendAlertsAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$this->template->template = "TemplatePlain.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		$system = Common::getModuleConfiguration("system");
				
		$alertsSubscriptions = AlertSubscriptionPeer::getAll();
		$totalRecipients = array();
		
		foreach($alertsSubscriptions as $alertSubscription) {
			$recipients = $alertSubscription->getRecipients();
			$smarty->assign('alertSubscription', $alertSubscription);
			$body = $smarty->fetch("CommonAlertMail.tpl");
			$alertSubscription->getEntitiesFiltered();
			foreach($recipients as $recipient) {
				$mailTo = $recipient;
				$subject = Common::getTranslation('Alert','users');
				$mailFrom = $system["parameters"]["fromEmail"];
				$manager = new EmailManagement();
				$manager->setTestMode();
				$message = $manager->createHTMLMessage($subject,$body);
				$totalRecipients[] = $mailTo;
				$result = $manager->sendMessage($mailTo,$mailFrom,$message); // se envía.
			}	
		}
		$smarty->assign('timestamp', new DateTime());
		$smarty->assign('recipientsCount', count($totalRecipients));
		return $mapping->findForwardConfig('success');
	}
}
