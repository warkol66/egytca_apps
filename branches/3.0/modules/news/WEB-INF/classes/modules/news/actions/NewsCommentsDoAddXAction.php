<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");
require_once("NewsCommentPeer.php");

class NewsCommentsDoAddXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsCommentsDoAddXAction() {
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

		$module = "News";
		$smarty->assign("module",$module);
				
		$this->template->template = "TemplateAjax.tpl";
		
		$smarty->assign('article',NewsArticlePeer::get($_POST['articleId']));

		//estoy creando un nuevo newscomment
		//validamos el captcha		
		if ( (empty($_POST['securityCode'])) || !Common::validateCaptcha($_POST['securityCode'])) {
			$smarty->assign('captcha',true);
			return $mapping->findForwardConfig('failure');
		}
		
		$comment = NewsCommentPeer::create($_POST["newscomment"]);
		if (!$comment) {
			$smarty->assign('article',NewsArticlePeer::get($_POST['articleId']));
			return $mapping->findForwardConfig('failure');
   		}
	
		$smarty->assign('comment',$comment);

		return $mapping->findForwardConfig('success');


	}

}