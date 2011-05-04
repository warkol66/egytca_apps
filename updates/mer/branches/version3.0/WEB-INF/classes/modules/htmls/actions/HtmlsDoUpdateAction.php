<?php

require_once 'BaseAction.php';

class HtmlsDoUpdateAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function HtmlsDoUpdateAction() {
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
		
		$module = 'HTMLS';
		$smarty->assign("module",$module); 
    
    $smarty->assign("SUBIDO",1);
    
    if ( !empty($_POST["name"]) ) {

    	if ( $_POST["external"]==1)
      	$filename="WEB-INF/tpl/htmls_content_".$_POST["name"]."_external.tpl";
      else {
				if ( $_POST["private"]==1)
        	$filename="WEB-INF/tpl/htmls_content_private_".$_POST["name"].".tpl";
        else
		    	$filename="WEB-INF/tpl/htmls_content_".$_POST["name"].".tpl";
	    }

	    if(move_uploaded_file($_FILES['document']['tmp_name'],$filename)) {
	      if ( $_POST["private"]==1)
					$smarty->assign("link","Main.php?do=htmlsShowPrivate&name=".$_POST["name"]);
				else
        	$smarty->assign("link","Main.php?do=htmlsShow&name=".$_POST["name"]);
				$smarty->assign("ERROR",0);
	    }
	    else
	      $smarty->assign("ERROR",1);
	  } else
    	$smarty->assign("ERROR",1);

		//////////
		// Forward control to the specified success URI
		return $mapping->findForwardConfig('success');

	}

}
?>
