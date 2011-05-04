<?php

require_once("BaseAction.php");
require_once("mer/CategoryPeer.php");
require_once("mer/HierarchyPeer.php");
require_once("mer/ActorPeer.php");

class ActorsDoSetActorsHierarchyAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ActorsDoSetActorsHierarchyAction() {
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

		$module = "Mer";
		$section = "Configure";
		
    $smarty->assign("module",$module);
    $smarty->assign("section",$section);
		
		$actors = $_POST["rel"];
		$hierarchy = $_POST["r"];
		
		$hierarchies = array();
		for ($i=1; $i<=count($actors); $i++)
			$hierarchies[$actors[$i]] = $hierarchy[$i];

		arsort($hierarchies);

    $hierarchyPeer = new HierarchyPeer();

		$hierarchyPeer->deleteByCategory($_POST["category"]);

    $categoryPeer = new CategoryPeer();
    $category = $categoryPeer->get($_POST["category"]);
    $hierarchyActors = $category->getHierarchyActors();

    reset($hierarchies);
    $i=0;
		while ( $i<$hierarchyActors && $i<count($hierarchies) ) {
			$actor = key($hierarchies);
    	$hierarchyPeer->add($actor,$_POST["category"],$i);
    	next($hierarchies);
    	$i++;
		}
		
		header("Location: Main.php?do=actorsSetActorsHierarchy&cat=".$_POST["category"]);
		exit;

		return $mapping->findForwardConfig('success');
	}

}
?>
