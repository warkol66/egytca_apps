<?php

class NewslettersSchedulesDoEditAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewslettersSchedulesDoEditAction() {
		;
	}
	
	function validate($mapping,$smarty) {

		return (!empty($_POST["newsletterschedule"]["clusterId"]) && !empty($_POST["newsletterschedule"]["deliveryMode"]) && !empty($_POST["newsletterschedule"]["newsletterTemplateId"]));
		
	}

	function manageEditFailure($mapping,$smarty) {

		$newsletterSchedule = NewsletterSchedulePeer::get($_POST["newsletterschedule"]["id"]);
		$smarty->assign('newsletterschedule',$newsletterSchedule);
		
		$clusters = SegmentationClusterPeer::getAll();
		$smarty->assign('clusters',$clusters);		
		$smarty->assign("newsletterTemplateIdValues",NewsletterTemplatePeer::getAll());

		$smarty->assign("action",'edit');
		$smarty->assign("message","error");
		
		return $mapping->findForwardConfig('failure');
	}
	
	function manageCreateFailure($mapping,$smarty) {

		$newsletterschedule = new NewsletterSchedule();
		$newsletterschedule->setid($_POST["newsletterschedule"]["id"]);
		$newsletterschedule->setnewsletterTemplateId($_POST["newsletterschedule"]["newsletterTemplateId"]);
		require_once("NewsletterTemplatePeer.php");		
		$smarty->assign("newsletterTemplateIdValues",NewsletterTemplatePeer::getAll());
		$newsletterschedule->setDeliveryMode($_POST["newsletterschedule"]["deliveryMode"]);
		$newsletterschedule->setclusterId($_POST["newsletterschedule"]["clusterId"]);
		$newsletterschedule->setactive($_POST["newsletterschedule"]["active"]);
		$smarty->assign("newsletterschedule",$newsletterschedule);	
		$smarty->assign("action",'create');
		$smarty->assign("message","error");
		
		$clusters = SegmentationClusterPeer::getAll();
		$smarty->assign('clusters',$clusters);
		
		return $mapping->findForwardConfig('failure');		
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
		$section = "NewsletterSchedules";
		$smarty->assign("section",$section);		

		if ( $_POST["action"] == "edit" ) {
			//estoy editando un newsletterschedule existente
			if(!$this->validate($mapping,$smarty))
				return $this->manageEditFailure($mapping,$smarty);

			NewsletterSchedulePeer::update($_POST["newsletterschedule"]);
      		
			return $mapping->findForwardConfig('success');

		}
		else {
		  //estoy creando un nuevo newsletterschedule
			if(!$this->validate($mapping,$smarty))
				return $this->manageCreateFailure($mapping,$smarty);
			
			if (!NewsletterSchedulePeer::create($_POST["newsletterschedule"]))
				return $this->manageCreateFailure($mapping,$smarty);

			return $mapping->findForwardConfig('success');
		}

	}

}
