<?php

//Accion que devuelve el listado de medias para mostrar en el autocomplete

class MediasAutocompleteListXAction extends BaseAction {

	function MediasAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Medias";	
		$smarty->assign("module",$module);
		
		$searchString = $_REQUEST['value'];
		$smarty->assign("searchString",$searchString);

		$medias = MediaQuery::create()->where('Media.Name LIKE ?', "%" . $searchString . "%")
									->limit($_REQUEST['limit'])
									->find();
		
		$smarty->assign("medias",$medias);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}

}
