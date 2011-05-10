<?php

class SurveysDoGenerateProductsSurveyAction extends BaseAction {
	private $survey;
	private $smarty;

	// ----- Constructor ---------------------------------------------------- //

	function SurveysDoGenerateProductsSurveyAction() {
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
		$this->smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($this->smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Catalog";
    	$this->smarty->assign("module",$module);

		$moduleSection = "Products";
    	$this->smarty->assign("moduleSection",$section);
		
		$productIds = $_POST['survey']['productsIds'];
		if (empty($productIds) || count($productIds) > 10)
			return $this->addParamsToForwards(array('message'=>'no-products'), $mapping, 'failure');
			
		$products = ProductPeer::getByIds($productIds);
		
		$this->survey = SurveyPeer::generateSurveyForProducts($products);
		if (empty($this->survey))
			return $mapping->findForwardConfig('failure');
		
		$this->sendMessages();
			
		return $mapping->findForwardConfig('success');
	}
	
	protected function sendMessages() {
		//Si tenemos mensajeria interna, armamos los mensajes y los enviamos.
		if (class_exists('InternalMailPeer')) {
			$tpl = $this->template->template;  //Guardamos el template original.
			$this->template->template = "TemplatePlain.tpl";  //Establecemos un template plano para el mail.
			$subject = 'Encuesta sobre la calidad de los productos.';
			$recipientsUsers = AffiliateUserPeer::getAllOwners();
			$fromUser = UserPeer::get(-1);  //Usuario "system"
			
			$this->smarty->assign('survey', $this->survey);
			$body = $this->smarty->fetch('SurveysProductsNotificationMail.tpl');
			
			$this->template->template = $tpl;  //Restauramos el template original.

			InternalMailPeer::sendToUsers($subject, $body, $recipientsUsers, $fromUser);
		}
	}
}
