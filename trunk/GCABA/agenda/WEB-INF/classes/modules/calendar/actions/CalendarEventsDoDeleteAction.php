<?php

class CalendarEventsDoDeleteAction extends BaseAction {

	function CalendarEventsDoDeleteAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);
				
    	CalendarEventPeer::delete($_POST["id"]);

		//redireccionamiento con opciones correctas
		return $this->addFiltersToForwards($_POST['filters'],$mapping,'success');	
	}

}