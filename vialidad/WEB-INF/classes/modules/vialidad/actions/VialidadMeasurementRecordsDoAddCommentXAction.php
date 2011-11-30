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
		
		$comment = new MeasurementRecordComment();
		
		//por que no anda?
		//$comment->fromArray($_POST['params']);
		$comment->setUserid($_POST['params']['userId']);
		$comment->setUserType($_POST['params']['userType']);
		$comment->setMeasurementrecordid($_POST['params']['measurementRecordId']);
		$comment->setContent($_POST['params']['content']);
		
		$comment->save();
		
		$smarty->assign('comment', $comment);
		
		return $mapping->findForwardConfig('success');
	}
}