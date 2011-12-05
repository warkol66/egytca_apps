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
		
		$user = Common::getLoggedUser();
		$_POST['params']['userId'] = $user->getId();
		$_POST['params']['userType'] = get_class($user);
		
		$comment = new MeasurementRecordComment();
		$comment = Common::setObjectFromParams($comment, $_POST['params']);
		
		$comment->save();
		
		$smarty->assign('comment', $comment);
		
		return $mapping->findForwardConfig('success');
	}
}