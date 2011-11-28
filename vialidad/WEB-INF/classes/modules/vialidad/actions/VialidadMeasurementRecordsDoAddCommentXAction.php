<?php

class VialidadMeasurementRecordsDoAddCommentXAction extends BaseAction {

	function VialidadMeasurementRecordsDoAddCommentXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Vialidad";
		$smarty->assign("module",$module);
		$section = "MeasurementRecords";
		$smarty->assign("section",$section);

		$filters = $_GET["filters"];
		$smarty->assign("filters",$filters);

		$message = $_GET["message"];
		$smarty->assign("message",$message);
		
		
		foreach ($_POST['params'] as $param) {
			if (empty($param))
				throw new Exception('wrong params');
		}

		// vienen todos los parametros por post
		// o el tipo de usuario se deduce aca???
		throw new Exception('no quiero olvidarme de revisar esto');
		
		$comment = new MeasurementRecordComment();
		$comment->fromArray($_POST['params']);
		$comment->save();
		
		throw new Exception('no quiero olvidarme de revisar esto');//$smarty->assign('user', $comment->getUser???);
		$smarty->assign('content', $comment->getContent());
		
		return $mapping->findForwardConfig('success');
	}
}