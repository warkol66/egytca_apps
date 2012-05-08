<?php

class PanelNotificationsGetMailBodyXAction extends BaseAction {

	function PanelNotificationsGetMailBodyXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		//por ser una action ajax.
		$this->template->template = "TemplateAjax.tpl";

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$notificationId = $_GET['notificationId'];
		$notification = NotificationPeer::get($notificationId);
		if (!empty($notification))
			$mailBody = $notification->getMailBody();	
		
		$smarty->assign('mailBody',$mailBody);
		return $mapping->findForwardConfig('success');
	}

}
