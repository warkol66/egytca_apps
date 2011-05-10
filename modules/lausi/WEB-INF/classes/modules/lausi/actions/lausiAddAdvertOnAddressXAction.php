<?php

class lausiAddAdvertOnAddressXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function lausiAddAdvertOnAddressXAction() {
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
		$section = "Advertisements";
		$smarty->assign("section",$section);
		
		$params = $_POST['advertisement'];
		
		if (empty($_POST['addressId']) || empty($_POST['quantity']) || empty($params['themeId']) || empty($params['duration']) || empty($params['publishDate']))
				return $mapping->findForwardConfig('failure');
				
		$params['date'] = $params['publishDate'];
		
		$theme = ThemePeer::get($params['themeId']);
		
		$quantity = $_POST['quantity'];
		if ($theme->getType() == ThemePeer::TYPE_DOBLE)
			$quantity = ceil($quantity/2);
		
		$result = BillboardPeer::getAllAvailableByAddress($_POST['addressId'],$params['publishDate'],$params['duration'],$quantity,$theme->getType());

		$billboards = $result[$_POST['addressId']]['elements'];
		
		$total = $_POST['quantity'];
		$count = 0;
			
		foreach ($billboards as  $billboard) {
			$advert = new Advertisement;
			$params['billboardId'] = $billboard->getId();
			Common::setObjectFromParams($advert, $params);
			if ($advert->save()) {
				$count++;
			}
		}

		if ($theme->getType() == ThemePeer::TYPE_DOBLE)
			$count = $count * 2;
			
		$smarty->assign('total',$total);
		$smarty->assign('count',$count);

		return $mapping->findForwardConfig('success');
	}

}
