<?php
require_once("BaseAction.php");
require_once("EmailManagement.php");

class PanelNotificationsResendAction extends BaseAction {

	function PanelNotificationsResendAction() {
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

		$module = "Panel";
		$system = Common::getModuleConfiguration("system");
		
		$notification = NotificationPeer::get($_POST['id']);
				
		$user = UserPeer::get($notification->getUserId());
		
		// se prepara el mail
		$mailTo = $user->getMailAddress();
			
		$typesTranslated = NotificationPeer::getTypesTranslated();
		$typeTranslated = $typesTranslated[$notification->getType()];
		$subject = Common::getTranslation($typeTranslated,'users');
			
		$mailFrom = $system["parameters"]["fromEmail"];
		
		$body = $notification->getMailBody();
			
		$manager = new EmailManagement();
		$manager->setTestMode();                        // hace que los mails se envíen al debugMail.
		$message = $manager->createHTMLMessage($subject,$body);
		
		$notificationParams = array(
			'deliveredOn' => new DateTime()
		);
		Common::setObjectFromParams($notification, $notificationParams);
		$notification->save();
			
		$result = $manager->sendMessage($mailTo,$mailFrom,$message); // se envía.
		return $mapping->findForwardConfig('success');
	}
}
