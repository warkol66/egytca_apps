<?php
require_once("EmailManagement.php");

class ImportShipmentReleasesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ImportShipmentReleasesDoEditAction() {
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
		
		$module = "Import";
		$smarty->assign('module',$module);

		$shipmentReleaseParams = $_POST['shipmentRelease'];
		
		if ( !empty($_POST['id']) )
			$shipmentRelease = ShipmentReleasePeer::get($_POST['id']);
		
		if (empty($shipmentRelease))
			$shipmentRelease = new ShipmentRelease();
			
		Common::setObjectFromParams($shipmentRelease, $shipmentReleaseParams);
		
		if ($shipmentRelease->isColumnModified(ShipmentReleasePeer::ESTIMATEDMOVEMENTTOSTOREHOUSEDATE))
			$this->sendNotification($smarty, $shipmentRelease);
		
		if ($shipmentRelease->save())
			return $mapping->findForwardConfig('success');
						
		return $mapping->findForwardConfig('failure');
	}
	
	private function sendNotification(&$smarty, $shipmentRelease) {
	  $importConfig = Common::getConfiguration('import');
		$mailTo = $importConfig['shipmentReleases']['warehouseMail'];
		$subject = Common::getTranslation('Notification', 'import');					
		AlertSubscriptionPeer::sendAlertSmarty($shipmentRelease, $smarty, $this->template, 'ImportShipmentReleasesMail.tpl', $mailTo, $subject);
	}
}

