<?php

set_time_limit(240);

class NewslettersExecuteDailyDeliveryAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewslettersExecuteDailyDeliveryAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*/
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Newsletters";
		$smarty->assign("module",$module);
		$section = "Newsletters";
		$smarty->assign("section",$section);
		
		if (!empty($_GET['newsletterId']) && !empty($_GET['newsletterScheduleId'])) {
			//reenvio de un cierto newsletter a los usuarios faltantes
			//dado un determinado newsletterSchedule
			
			$schedule = NewsletterSchedulePeer::get($_GET['newsletterScheduleId']);
			$newsletter = NewsletterPeer::get($_GET['newsletterId']);
			
			$schedule->continueExecution($newsletter);

		}
		else {

			//obtenemos la fecha de hoy
			$date = date('Y-m-d');
			//obtenemos los schedules de todos los tipos programados para el dia de hoy
			$schedules = NewsletterSchedulePeer::getNewsletterSchedulesForDate($date);	

			foreach ($schedules as $schedule) {
				$schedule->execute();
			}
			
		}

	}

}
