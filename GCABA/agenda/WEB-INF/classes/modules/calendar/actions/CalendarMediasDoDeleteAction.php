<?php

class CalendarMediasDoDeleteAction extends BaseAction {

	function CalendarMediasDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "CalendarMedias";
		$smarty->assign("module",$module);
		
		$media = CalendarMediaPeer::get($_POST["id"]);

    	CalendarMediaPeer::delete($_POST["id"]);

		if (!empty($_POST['ajaxFromArticle'])) {
			$this->template->template = 'TemplateAjax.tpl';
			$smarty->assign('id',$_POST["id"]);
			return $mapping->findForwardConfig('success-from-event');
		}

		//redireccionamiento con opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');

	}

}