<?php

class LausiThemesRotateXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function LausiThemesRotateXAction() {
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
		$section = "Themes";
		$smarty->assign("section",$section);
		
		if (isset($_POST['advertId']) && isset($_POST['billboardId'])) {
		
			$smarty->assign('advertId', $_POST['advertId']);
			//obtenemos el actual.
			$advert = AdvertisementPeer::get($_POST['advertId']);
			
			//creamos la nueva publicacion del motivo en un direccion
			$newAdvert = $advert->copy();
			$newAdvert->setBillboardId($_POST['billboardId']);
			if (!$newAdvert->save()) {
				//no se ha podido crear
				return $mapping->findForwardConfig('failure');
			}
			
			//se realizo la rotacion, eliminamos la otra cartelera.			
			AdvertisementPeer::delete($_POST['advertId']);
			
			$smarty->assign('advertId',$_POST['advertId']);
		}
		
		return $mapping->findForwardConfig('success');
	}
}
