<?php

class CalendarMediasUploadAction extends BaseAction {

	function CalendarMediasUploadAction() {
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

		if (empty($_POST['calendarMedia'])) {
			$status = false;
		}
		else {
			//estoy creando un nuevo calendarmedia	
			//tomamos como nombre de archivo el del archivo recibido
			$_POST['calendarMedia']['name'] = $_FILES['media']['name'];
			$status = CalendarMediaPeer::create($_POST['calendarMedia'],$_FILES['media']);
		}
   
		if ($status) {
			echo "Archivo Recibido";
			exit(0);
		}
		else {
			//header("HTTP/1.1 500 Internal Server Error");
			echo "Error al subir el archivo";
			exit(0);
		}	


	}

}