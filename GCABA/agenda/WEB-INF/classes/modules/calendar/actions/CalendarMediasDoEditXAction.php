<?php

class CalendarMediasDoEditXAction extends BaseAction {

	function CalendarMediasDoEditXAction() {
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
		$section = "Media";
		$smarty->assign("section",$section);				

		//obtenemos las variables del request
		list($code,$id) = explode('_',$_POST['editorId']);
		$value = $_POST['value'];
		
		$calendarMedia = CalendarMediaPeer::get($id);
		
		if ($code == 'descriptionEdit') {
			//estamos editando la descripcion
			try {
				$calendarMedia->setDescription($value);
				$calendarMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}

		if ($code == 'titleEdit') {
			//estamos editando el titulo
			try {
				$calendarMedia->setTitle($value);
				$calendarMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}
	
		//seteamos la respuesta de smarty
		$smarty->assign('value',$value);
	
		return $mapping->findForwardConfig('success');
	}

}
