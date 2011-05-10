<?php

class LausiDoDistributeXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiDoDistributeXAction() {
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

		//por ser una action ajax.		
		$this->template->template = "template_ajax.tpl";


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

		if (isset($_POST['themeId']) && isset($_POST['publishDate']) && isset($_POST['duration'])) {
				$toDistribute = $_POST['toDistribute'];
				
				$advertisementParams = array(
					'date' => date("Y-M-d"),
					'publishDate' => $_POST['publishDate'],
					'duration' => $_POST['duration'],
					'themeId' => $_POST['themeId']
				);
				
				foreach($toDistribute as $billboardId) {
					$advertisementParams['billboardId'] = $billboardId;
					$advert = new Advertisement;
					Common::setObjectFromParams($advert, $advertisementParams);
					$res = $advert->save();
				}
			
		}
		
		//casos particulares de subtotales
		if ($_POST['circuit']) {
			//obtengo los totales por circuito 
			$circuits = CircuitPeer::getAll();
			$result = array();
			foreach ($circuits as $circuit) {
				$result[$circuit->getId()] = $circuit->getSheetsDistributed($_POST['themeId']);
			}
			
			$smarty->assign('mode','circuit');
		}
		
		if ($_POST['region']) {
			//obtengo los totales por circuito 
			$regions = RegionPeer::getAll();
			$result = array();
			foreach ($regions as $region) {
				$result[$region->getId()] = $region->getSheetsDistributed($_POST['themeId']);
			}
			
			$smarty->assign('mode','region');
		}
		
		$smarty->assign('result',$result);
		
		$theme = ThemePeer::get($_POST['themeId']);
		$smarty->assign('theme',$theme);

		$smarty->assign('formId',$_POST['formId']);
		
		return $mapping->findForwardConfig('success');
	}
}
