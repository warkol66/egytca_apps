<?php

class VialidadSourcesDoEditXAction extends BaseAction {

	function VialidadSourcesDoEditXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$userParams = Common::userInfoToDoLog();
		$sourceParams = array_merge_recursive($_POST["params"],$userParams);

		if ($_POST["action"] == "edit") { // Existing source

			$source = SourcePeer::get($_POST["id"]);
			$source = Common::setObjectFromParams($source,$sourceParams);
			
			if ($source->isModified() && !$source->save()) 
				throw new Exception("Couldn't save source");
		}
		else { // New source

			$source = new Source();
			$source = Common::setObjectFromParams($source,$sourceParams);
			if (!$source->save())
				throw new Exception("Couldn't save source");
			$smarty->assign('newSource', $source);
		}
		
		$sources = SourceQuery::create()->find();
		$smarty->assign('sources', $sources);
		return $mapping->findForwardConfig('success');
	}

}
