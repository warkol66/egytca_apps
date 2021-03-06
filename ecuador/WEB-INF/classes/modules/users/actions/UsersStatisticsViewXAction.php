<?php
/**
 * UsersStatisticsViewXAction
 *
 * Vista de Grafico de Actividad por usuario (Users)
 *
 * @package    users
 * @subpackage    users
 */

class UsersStatisticsViewXAction extends BaseSelectAction {
	
	function __construct() {
		parent::__construct('User');
	}
	
	protected function postSelect() {
		parent::postSelect();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);
			
		$id = $_REQUEST['id'];

		$this->smarty->assign("show", true);

		if(isset($id)){
			$this->smarty->assign("id", $id);
			//Constantes y opciones posibles
			$this->smarty->assign("blogEntries", BlogEntryQuery::create()->filterByUserid($id)->count());
			$this->smarty->assign("blogComments", BlogCommentQuery::create()->filterByObjectid($id)->count());
			$this->smarty->assign("boardChallenges", BoardChallengeQuery::create()->filterByUserid($id)->count());
			$this->smarty->assign("boardComments", BoardCommentQuery::create()->filterByUserid($id)->count());
			$this->smarty->assign("boardBonds", BoardBondQuery::create()->filterByUserid($id)->count());
			$this->smarty->assign("documents", DocumentQuery::create()->filterByUserObjectid($id)->count());
		}elseif(isset($_REQUEST['dateFrom']) && isset($_REQUEST['dateTo'])){
			$from = Common::convertToMysqlDateFormat($_REQUEST['dateFrom']);
			$to = Common::convertToMysqlDateFormat($_REQUEST['dateTo']);
			$this->smarty->assign("from", $_REQUEST['dateFrom']);
			$this->smarty->assign("to", $_REQUEST['dateTo']);
			
			$this->smarty->assign("blogEntries", BlogEntryQuery::create()->filterByCreationDate(array('min' => $from,'max' => $to))->count());
			$this->smarty->assign("blogComments", BlogCommentQuery::create()->filterByCreationDate(array('min' => $from,'max' => $to))->count());
			$this->smarty->assign("boardChallenges", BoardChallengeQuery::create()->filterByCreationDate(array('min' => $from,'max' => $to))->count());
			$this->smarty->assign("boardComments", BoardCommentQuery::create()->filterByCreationDate(array('min' => $from,'max' => $to))->count());
			//$this->smarty->assign("boardBonds", BoardBondQuery::create()->filterByCreationDate(array('min' => $from,'max' => $to))->count());
			$this->smarty->assign("documents", DocumentQuery::create()->filterByDocumentDate(array('min' => $from,'max' => $to))->count());
		}
		
		$this->template->template = "TemplateAjax.tpl";
	}

}
