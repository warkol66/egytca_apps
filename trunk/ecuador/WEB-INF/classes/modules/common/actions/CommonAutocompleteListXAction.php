<?php

class CommonAutocompleteListXAction extends BaseListAction {
	
	function __construct() {
		$object = ucfirst($_REQUEST['object']);
		parent::__construct($object);
	}
	
	protected function preList() {
		parent::preList();
		
		$object = ucfirst($_REQUEST['object']) . 'Query';
		
		//me fijo si es el caso especial sin entdades asociadas desde el principio
		if(isset($_REQUEST['request']['term']))
			$searchString = $_REQUEST['request']['term'];
		else
			$searchString = $_REQUEST['term'];
		
		$this->smarty->assign("searchString",$searchString);

		$this->filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);
		
		if(isset($_REQUEST['request']['entityIds'])){
			if(method_exists($object, 'getDifferentFrom'))
				$this->filters = array_merge($this->filters, array("getDifferentFrom" => $_REQUEST['request']['entityIds']));
		}
		
		if (!empty($_REQUEST['entityType']) && !empty($_REQUEST['entityId'])) {
			$this->filters = array_merge($this->filters, array(
				'EntityFilter' => array(
					'entityType' => $_REQUEST['entityType'],
					'entityId' => $_REQUEST['entityId'],
					'getCandidates' => !empty($_REQUEST['getCandidates'])
					)
				)
			);
		}
	}
	
	protected function postList() {
		parent::postList();

		$module = "Common";
		$this->smarty->assign("module",$module);

		$this->smarty->assign('class',ucfirst($_REQUEST['object']));
		$this->smarty->assign('objects',$this->results);
		
	}

	/*function CommonAutocompleteListXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Common";
		$smarty->assign("module",$module);

		$searchString = $request->getParameter('term');
		$smarty->assign("searchString",$searchString);

		$object = ucfirst($request->getParameter('object'));

		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);
		
		if (!empty($_REQUEST['entityType']) && !empty($_REQUEST['entityId'])) {
			$filters = array_merge($filters, array(
				'EntityFilter' => array(
					'entityType' => $_REQUEST['entityType'],
					'entityId' => $_REQUEST['entityId'],
					'getCandidates' => !empty($_REQUEST['getCandidates'])
					)
				)
			);
		}

		$objects = BaseQuery::create($object)
				->addFilters($filters)
				->limit($_REQUEST['limit'])
				->find();

		$smarty->assign("objects",$objects);
		$smarty->assign("class",$object);
		$smarty->assign("limit",$_REQUEST['limit']);

		return $mapping->findForwardConfig('success');
	}*/

}
