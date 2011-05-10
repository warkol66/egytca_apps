<?php

require_once("BaseAction.php");
require_once("NewsArticlePeer.php");

class NewsArticlesGetThumbnailAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesGetThumbnailAction() {
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
			$newsArticle = NewsArticlePeer::get($_GET["id"]);
			if (!empty($newsArticle)) {
				$image = $newsArticle->getFirstImage();
				if (!empty($image)) {
					$file = $moduleRootDir."/WEB-INF/classes/modules/news/files/images/";
					$file .= "thumbnails";
					$file .= "/".$image->getId();
		  		header("Cache-Control: private_no_expire");
  				header("Content-Type: image/jpeg"); 
			    header("Content-Length: ".filesize($file)."\"");
					readfile($file);
					die;				
				}
			}
		}

	}

}
