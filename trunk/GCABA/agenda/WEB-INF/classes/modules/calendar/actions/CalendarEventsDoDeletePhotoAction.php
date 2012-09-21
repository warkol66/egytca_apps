<?php

class CalendarEventsDoDeletePhotoAction extends BaseAction {

	function CalendarEventsDoDeletePhotoAction() {
		;
	}
	
	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_POST['id'])) {
			$photo = ResourceQuery::create()->findOneById($_POST['id']);
			$photo->delete();
		}
	}
}