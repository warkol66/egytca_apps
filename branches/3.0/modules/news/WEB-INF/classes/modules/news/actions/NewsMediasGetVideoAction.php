<?php

require_once("BaseAction.php");
require_once("NewsMediaPeer.php");

class NewsMediasGetVideoAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsMediasGetVideoAction() {
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

		global $moduleRootDir;

		if ( !empty($_GET["id"]) ) {
			$file = $moduleRootDir."/WEB-INF/classes/modules/news/files/videos/flv/";
			$file .= $_GET["id"].".flv";

			$fp=@fopen($file, "rb");
			@header("Content-Type: video/x-FLV");
			@header("Content-Disposition: inline; filename=\"video.flv\"");
			@header("Content-Length: ".(string)(filesize($file)) );
			@fpassthru($fp);
			@fclose($fp);
			die;			
		}

	}

}
