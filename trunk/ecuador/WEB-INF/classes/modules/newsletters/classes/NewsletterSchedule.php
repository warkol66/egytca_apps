<?php

/**
 * Skeleton subclass for representing a row from the 'newsletters_schedule' table.
 *
 * Programacion de Newsletters
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    infocivica
 */
class NewsletterSchedule extends BaseNewsletterSchedule {

	/**
	 * Initializes internal state of NewsletterSchedule object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Indica si es un envio diario
	 * @return boolean
	 */
	public function isEveryDaySchedule() {
		return ($this->getDeliveryMode() == NewsletterSchedulePeer::EVERY_DAY_MODE);
	}
	
	/**
	 * Indica si es un envio semanal
	 * @return boolean
	 */
	public function isOnceAWeekSchedule() {
		return ($this->getDeliveryMode() == NewsletterSchedulePeer::ONCE_A_WEEK_MODE);
	}
	
	/**
	 * Indica si es un envio mensual
	 * @return boolean
	 */
	public function isOnceAMonthSchedule() {
		return ($this->getDeliveryMode() == NewsletterSchedulePeer::ONCE_A_MONTH_MODE);
	}
	
	/**
	 * Indica si es un envio por unica vez
	 * @return boolean
	 */
	public function isOnceSchedule() {
		return ($this->getDeliveryMode() == NewsletterSchedulePeer::ONCE_MODE);
	}

	/**
	 * Genera una descripcion del Envio Programado
	 * @return string
	 */ 
	public function getScheduleDescription() {
		
		$description = '';
		
		if ($this->isEveryDaySchedule()) {
			$description .= 'Envio Diario';
		}
		
		if ($this->isOnceAWeekSchedule()) {
			
			$description .= 'Envio Semanal ';
			$weekdays = NewsletterSchedulePeer::getWeekdays();
			$description .= '(Se realiza los dias ' . $weekdays[$this->getDeliveryDay()] . ')';
		}

		if ($this->isOnceAMonthSchedule()) {
			
			$description .= 'Envio Mensual ';
			$description .= '(Se realiza el dia ' . $this->getDeliveryDayNumber() . ' del mes)';
		}
		
		if ($this->isOnceSchedule()) {
			
			$description .= 'Envio Unico ';
			$description .= '(Se realiza el dia ' . date("d-m-Y",strtotime($this->getDeliveryDate())) . ')';
		}		
		
		return $description;
		
	}
	
	
	
	/**
	 * Ejecuta el envio programado.
	 * Obtiene los destinatarios, Genera el email y realiza el envio.
	 *
	 */
	public function execute() {
		
		//require_once('SegmentationClusterPeer.php');

		try {
		
			$cluster = $this->getSegmentationCluster();
			//no habia cluster asignado
			if (empty($cluster))
				return false;
			
			$users = $cluster->getUsers();

			global $system;
			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			
			//variable que no permite evaluar si de debera enviar a usuarios importados.
			$sendToImporter = ($system["config"]["newsletters"]["sendToPendingUsers"]["value"] == 'YES');
	
			//require_once('EmailManagement.php');
			$manager = new EmailManagement();
			
			$template = $this->getNewsletterTemplate();
			$renderFactory = new NewsletterTemplateRenderFactory();
			$render = $renderFactory->build($template);
			$subject = $render->getSubject();

			$params = array();
			$params['subject'] = $render->getSubject();
			$params['content'] = $render->getBody();
			$params['sentAt'] = date('Y-m-d h:i:s');
			$params['newsletterTemplateId'] = $template->getId();
			
			//creamos registro del envio
			$newsletterRegister = NewsletterPeer::create($params);			

			//envio de email a cada usuario		
			foreach ($users as $user) {	
				
				if ($user->wantsNewsletter()) {

					if ((!$user->isImported()) || ($user->isImported() && $sendToImporter)) {

						//se envian aquello que no fueron importados
						//o que fueron importados y que se indico en la configuracion que hay que enviarlos.
				
						$userInfo = $user->getUserInfo();
						$mailTo = $userInfo->getMailAddress();

						//personalizamos el envio para el usuario

						$body = $render->getCustomBody($user);

						$message = $manager->createMultipartMessage($subject,$body);

						//realizamos el envio
						$result = $manager->sendMessage($mailTo,$mailFrom,$message);

						$params = array();
						//creamos el registro del envio a un usuario				
						$params['newsletterId'] = $newsletterRegister->getId();
						$params['registrationUserId'] = $user->getId();
								
						NewsletterUserPeer::create($params);	
				
					}
				}
			}
			

		}
		catch (Exception $exp) {
			return false;
		}
		return true;
		
	}
	
	/**
	 * El Schedule Continua un envio programado de un cierto newsletter
	 *
	 */
	public function continueExecution($newsletter) {

		//verificacion de que se correspondan
		if ($newsletter->getNewsletterTemplateId() != $this->getNewsletterTemplateId() ) {
			//no se corresponden
			return false;
		}

		//obtenemos el ultimo usuario al que se le ha enviado el newsletter
		$lastUser = $newsletter->getLastUserSent();

		//require_once('SegmentationClusterPeer.php');

		try {
		
			$cluster = $this->getSegmentationCluster();
			//no habia cluster asignado
			if (empty($cluster))
				return false;
			
			$users = $cluster->getUsersAfterUser($lastUser);

			global $system;
			$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];
			
			//variable que no permite evaluar si de debera enviar a usuarios importados.
			$sendToImporter = ($system["config"]["newsletters"]["sendToPendingUsers"]["value"] == 'YES');
	
			//require_once('EmailManagement.php');
			$manager = new EmailManagement();
			
			$template = $this->getNewsletterTemplate();
			$renderFactory = new NewsletterTemplateRenderFactory();
			$render = $renderFactory->build($template);
			$subject = $render->getSubject();

			$params = array();
			$params['subject'] = $render->getSubject();
			$params['content'] = $render->getBody();
			$params['sentAt'] = date('Y-m-d h:i:s');
			$params['newsletterTemplateId'] = $template->getId();
			
			//creamos registro del envio
			$newsletterRegister = $newsletter;			

			//envio de email a cada usuario		
			foreach ($users as $user) {	
				
				if ($user->wantsNewsletter()) {

					if ((!$user->isImported()) || ($user->isImported() && $sendToImporter)) {

						//se envian aquello que no fueron importados
						//o que fueron importados y que se indico en la configuracion que hay que enviarlos.
				
						$userInfo = $user->getUserInfo();
						$mailTo = $userInfo->getMailAddress();

						//personalizamos el envio para el usuario

						$body = $render->getCustomBody($user);

						$message = $manager->createMultipartMessage($subject,$body);

						//realizamos el envio
						$result = $manager->sendMessage($mailTo,$mailFrom,$message);

						if (!$result) {
							$params = array();
							try {

								//creamos el registro del envio a un usuario				
								$params['newsletterId'] = $newsletterRegister->getId();
								$params['registrationUserId'] = $user->getId();

								NewsletterUserPeer::create($params);

							} catch (Exception $e) {
								var_dump($e);
							}
							
						}
				
					}
				}
			}
			

		}
		catch (Exception $exp) {
			return false;
		}
		return true;	
		
	}

} // NewsletterSchedule
