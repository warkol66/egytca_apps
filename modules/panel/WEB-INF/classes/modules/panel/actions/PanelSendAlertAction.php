<?php
/**
 * PanelSendAlertAction
 *
 */

require_once("BaseAction.php");
require_once("EmailManagement.php");

/**
 * Esta acción está pensada para ser corrida con cron.
 * Para ello se puede usar las siguientes lineas:
 * 
 * cd /ruta/del/main/; php Main.php do=panelSendAlert 1>> alert_log 2>> alert_log;
 * 
 * Con eso redireccionamos la salida estandar y la de errores al archivo alert_log.
 * 
 * Recordar comentar la linea $manager->setTestMode(); cuando se quiera activar efectivamente.
 */

class PanelSendAlertAction extends BaseAction {

	function PanelSendAlertAction() {
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
				
		$users = UserQuery::create()->find(); // obtenemos todos los usuarios.
		$recipients = array();
		
		foreach ($users as $user) {
			$positions = $user->getPositions();
			if (!empty($positions) && !$positions->isEmpty()) { // si es responsable de al menos una position
				// se prepara el mail
				$mailTo = $user->getMailAddress();
				
				$subject = Common::getTranslation('Alert','users');
				
				$mailFrom = $system["parameters"]["fromEmail"];
			
				$smarty->assign('user', $user);
				$smarty->assign('positions', $positions);
				$smarty->assign('projectPeer', new ProjectPeer);
				$smarty->assign('objectivePeer', new ObjectivePeer); 
				$body = $smarty->fetch("PanelAlertMail.tpl");
				
				$manager = new EmailManagement();
				
				// Descomentar la siguiente linea si se desea redirigir los mails al debugMail.
				$manager->setTestMode();
				
				$message = $manager->createHTMLMessage($subject,$body);
				
				$notification = new Notification();
				$notificationParams = array(
					'userId' => $user->getId(),
					'mailBody' => $body,
					'type' => NotificationPeer::ALERT,
					'deliveredOn' => new DateTime()
				);
				Common::setObjectFromParams($notification, $notificationParams);
				$notification->save();
				
				$recipients[] = $mailTo;
				$result = $manager->sendMessage($mailTo,$mailFrom,$message); // se envía.
			}
		}
		$smarty->assign('timestamp', new DateTime());
		$smarty->assign('recipientsCount', count($recipients));
		return $mapping->findForwardConfig('success');
	}
}
