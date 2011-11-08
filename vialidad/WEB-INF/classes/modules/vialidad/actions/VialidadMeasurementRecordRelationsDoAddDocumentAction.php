<?php

class VialidadMeasurementRecordRelationsDoAddDocumentAction extends BaseAction {

	function VialidadMeasurementRecordRelationsDoAddDocumentAction() {
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

			//si no existe el directorio de documentos se lo crea.
			$moduleConfig = Common::getModuleConfiguration('documents');
			$documentsPath = $moduleConfig['documentsPath'];
			if (!file_exists($documentsPath))
				if(!mkdir($documentsPath))
					throw new Exception("no se pudo crear directorio de documentos");

			$itemRecord = MeasurementRecordRelationQuery::create()->findOneById($_POST["id"]);

			$documentPeer = new DocumentPeer();
			$document = $documentPeer->create($_FILES["document_file"],$_POST['title'],$_POST["description"],$_POST['date'],$_POST["category"],$_POST["password"],$_POST["extra"]);
			if ($document === false)
				throw new Exception('error creating document');

			$itemRecord->setDocument($document);
			if (!$itemRecord->save())
				throw new Exception('error saving document');
		}
		else
			throw new Exception('wrong params');

		return $this->generateDynamicForward('success');
	}
}