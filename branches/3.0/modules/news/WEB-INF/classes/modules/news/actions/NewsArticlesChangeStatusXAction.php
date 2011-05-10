<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");

class NewsArticlesChangeStatusXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesChangeStatusXAction() {
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
		
		//por ser una llamada via ajax
		$this->template->template = 'TemplateAjax.tpl';

		$module = "News";
		$smarty->assign("module",$module);
		
		//caso de actualizacion de una sola noticia
		if (isset($_POST['newsarticle']))
			NewsArticlePeer::update($_POST['newsarticle']);
		
		//cambio de status de varios elementos
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			
			foreach ($_POST['selected'] as $id) {
				$newsarticle['id'] = $id;
				$newsarticle['status'] = $_POST['status'];
				NewsArticlePeer::update($newsarticle);
			}
		}


		return $mapping->findForwardConfig('success');
	

	}

}