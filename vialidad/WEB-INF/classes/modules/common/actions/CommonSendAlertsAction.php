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
				
		$alertsSubscriptions = AlertSubscriptionPeer::getAll();
		$totalRecipients = array();
		
		foreach($alertsSubscriptions as $alertSubscription) {
			$entitiesFiltered = $alertSubscription->getEntitiesFiltered();
			if (!empty($entitiesFiltered) && count($entitiesFiltered) > 0) {
				$recipients = $alertSubscription->getRecipients();
				print_r($recipients);die;
				$subject = Common::getTranslation('Alert','users');
				$smarty->assign('alertSubscription', $alertSubscription);
				$body = $smarty->fetch('CommonAlertMail.tpl');
				$partialRecipients = AlertSubscriptionPeer::sendAlert($alertSubscription, $body, $recipients, $subject);
				$totalRecipients = array_merge($totalRecipients, $partialRecipients);
			}	
		}
		$smarty->assign('timestamp', new DateTime());
		$smarty->assign('recipientsCount', count($totalRecipients));
		return $mapping->findForwardConfig('success');
	}
}
