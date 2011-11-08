<?php

class VialidadMeasurementRecordRelationsDoDeleteDocumentAction extends BaseAction {

	function VialidadMeasurementRecordRelationsDoDeleteDocumentAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		if (!empty($_POST["id"])) {

			$itemRecord = MeasurementRecordRelationQuery::create()->findOneById($_POST["id"]);

			$documentPeer = new DocumentPeer();

			if (!$documentPeer->delete($itemRecord->getDocumentid()))
				throw new Exception('error deleting document');
			else {
				$itemRecord->setDocument(null);
				if (!$itemRecord->save())
					throw new Exception('error saving document');
			}
		}
		else
			throw new Exception('wrong params');

		return $this->generateDynamicForward('success');
	}
}