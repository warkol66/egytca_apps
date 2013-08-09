<?php
/**
 * UsersStatisticsViewXAction
 *
 * Vista de Grafico de Actividad por usuario (Users)
 *
 * @package    users
 * @subpackage    users
 */

class UsersStatisticsViewXAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('User');
	}
	
	protected function postEdit() {
		parent::postEdit();
		if ($this->entity->isNew());
			$this->smarty->assign("notValidId", true);
			
		$id = $_REQUEST['id'];

		$this->smarty->assign("show", true);

		//Constantes y opciones posibles
		$this->smarty->assign("blogEntries", BlogEntryQuery::create()->filterByUserid($_REQUEST['id'])->count());
		$this->smarty->assign("blogComments", BlogCommentQuery::create()->filterByUserid($_REQUEST['id'])->count());
		$this->smarty->assign("boardChallenges", BoardChallengeQuery::create()->filterByUserid($_REQUEST['id'])->count());
		$this->smarty->assign("boardComments", BoardCommentQuery::create()->filterByUserid($_REQUEST['id'])->count());
		
		$this->template->template = "TemplateAjax.tpl";
	}

}
