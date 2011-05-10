<?php
require_once("EmailManagement.php");

class CommonSendSchedulesAction extends BaseAction {

	function CommonSendSchedulesAction() {
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
				
		$schedulesSubscriptions = ScheduleSubscriptionPeer::getAll();
		$totalRecipients = array();
		
		foreach($schedulesSubscriptions as $scheduleSubscription) {
			$entitiesFiltered = $scheduleSubscription->getEntitiesFiltered();
			if (!empty($entitiesFiltered) && count($entitiesFiltered) > 0) {
				$recipients = $scheduleSubscription->getRecipients();
				$subject = Common::getTranslation('Schedule','users');
				$smarty->assign('scheduleSubscription', $scheduleSubscription);
				$body = $smarty->fetch('CommonScheduleMail.tpl');
				$partialRecipients = ScheduleSubscriptionPeer::sendSchedule($scheduleSubscription, $body, $recipients, $subject);
				$totalRecipients = array_merge($totalRecipients, $partialRecipients);
			}	
		}
		$smarty->assign('timestamp', new DateTime());
		$smarty->assign('recipientsCount', count($totalRecipients));
		return $mapping->findForwardConfig('success');
	}
}
