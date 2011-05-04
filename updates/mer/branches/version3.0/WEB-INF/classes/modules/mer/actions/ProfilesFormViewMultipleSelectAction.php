<?php

class ProfilesFormViewMultipleSelectAction extends CategorySelect{
	
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
		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Mer";
		$section = "Profiles";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);		

		if ($request->getParameter("alls") == 1)
    	$actors = ActorPeer::getAll();
		$categoryId = $request->getParameter("categoryId");
		if (!empty($categoryId))
			$actors = ActorPeer::getByCategory($categoryId);
		$smarty->assign('actors',$actors);
		global $system;
		$maxActors = $system["config"]["mer"]["profiles"]["max_actors_compare"];
		$smarty->assign('maxActors',$maxActors);
		return parent::execute($mapping,$form,$request,$response);		
	}
}
?>
