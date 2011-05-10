<?php

require_once("BaseAction.php");
require_once("WorkforcePeer.php");
require_once("BillboardPeer.php");
require_once("CircuitPeer.php");

class LausiWorkforcesDoAssignAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiWorkforcesDoAssignAction() {
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

		$module = "Lausi";
		$smarty->assign("module",$module);
		$section = "Workforces";
		$smarty->assign("section",$section);				

		if ($_POST['ajax'] == 1) {

			$this->template->template = 'template_ajax.tpl';
			$advertId = $_POST['advertisementId'];
			$workforceId = $_POST['workforceId'];
			$advert = AdvertisementPeer::get($advertId);
			
			if ($workforceId > 0) {
				$workforce = WorkforcePeer::get($workforceId);
				$advert->assignWorkforce($workforce);
			}
			
			if ($workforceId == 0) {
				$advert->clearWorkforce();
				$smarty->assign('cleared',1);				
			}
			$smarty->assign('date',Common::convertToMysqlDateFormat($_GET['fromDate']));
			$smarty->assign('advert',$advert);
			$smarty->assign('workforce',$workforce);
			$smarty->assign('workforces',WorkforcePeer::getAll());
			return $mapping->findForwardConfig('success-ajax');
			
		}

		if ($_POST['workforceId']) {
			
			$workforce = WorkforcePeer::get($_POST['workforceId']);
			$toAssign = $_POST['toAssign'];
			
			foreach ($toAssign as $advertId) {
				$advert = AdvertisementPeer::get($advertId);
				$advert->assignWorkforce($workforce);
			}			
			
		}

		$myRedirectConfig = $mapping->findForwardConfig('success');
		$myRedirectPath = $myRedirectConfig->getpath();
	
		if ($_POST['workforceId'])
			$queryData .= '&workforceId='.$_POST["workforceId"];
			
		if ($_POST['circuitId'])
			$queryData .= '&circuitId='.$_POST["circuitId"];
		
		if ($_POST['themeId'])
			$queryData .= '&themeId='.$_POST["themeId"];

		if ($_POST['fromDate'])
			$queryData .= '&fromDate='.$_POST["fromDate"];

		$myRedirectPath .= $queryData;
		
		$fc = new ForwardConfig($myRedirectPath, True);
		return $fc;
		
	}

}