<?php

class ActorsDoSetHierarchyAction extends BaseAction {

	function ActorsDoSetHierarchyAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

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

		header("Location: Main.php?do=actorsSetHierarchy&cat=".$_POST["category"]);
		exit;

		return $mapping->findForwardConfig('success');
	}

}
