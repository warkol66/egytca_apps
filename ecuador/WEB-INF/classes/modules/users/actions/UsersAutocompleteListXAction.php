<?php
/**
 * Listado de usuarios
 *
 * @package users
 */
class UsersAutocompleteListXAction extends BaseListAction {
	
 /**
	* Constructor
	*/
	function __construct() {
		parent::__construct('User');
	}

 /**
	* Acciones a ejecutar antes de obtener la coleccion de objetos
	*/
	protected function preList() {
		parent::preList();

		$this->notPaginated = true;

		$searchString = $_REQUEST['value'];
		$this->smarty->assign("searchString",$searchString);

		$filters = array("searchString" => $searchString, "limit" => $_REQUEST['limit']);

		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("adminActId" => $_REQUEST['adminActId']));
		else if ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("issueId" => $_REQUEST['issueId']));
		else if ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("headlineId" => $_REQUEST['headlineId']));

		if ($_REQUEST['getCandidates'])
			$filters = array_merge_recursive($filters, array("getCandidates" => true));

		if ($_REQUEST['adminActId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => IssuePeer::get($_REQUEST['adminActId'])));
		else if ($_REQUEST['issueId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => IssuePeer::get($_REQUEST['issueId'])));
		else if ($_REQUEST['headlineId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => HeadlinePeer::get($_REQUEST['headlineId'])));
		else if ($_REQUEST['campaignId'])
			$filters = array_merge_recursive($filters, array("relatedObject" => CampaignPeer::get($_REQUEST['campaignId'])));

		$this->filters = $filters;
		//$smarty->assign("users",$users);
		$this->smarty->assign("limit",$_REQUEST['limit']);
		$this->smarty->assign("type",$_REQUEST['type']);


		//Aplico filtro para eleminar el usuario Systems id = -1
		$this->filters['ignoreNonRealUsers'] = true;
	}

 /**
	* Acciones a ejecutar despues de obtener la coleccion de objetos
	*/
	protected function postList() {
		// Elimino el filtro para que no aparezca en el paginador
		unset($this->filters['ignoreNonRealUsers']);
		parent::postList();
		
		// Listado de usuarios inactivos
		$this->smarty->assign("inactiveUsers",User::getInactives());

	}

}
