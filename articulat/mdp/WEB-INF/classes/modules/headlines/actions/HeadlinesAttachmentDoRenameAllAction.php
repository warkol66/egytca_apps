<?php

class HeadlinesAttachmentDoRenameAllAction extends BaseAction {

	function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		foreach (HeadlineAttachmentQuery::create()->find() as $headlineAttachment) {
			
			$fileDir = preg_replace("/\/[^\/]*$/", '', $headlineAttachment->getRealpath());
			if (!file_exists($fileDir))
				mkdir ($fileDir, 0777, true);
			if (!file_exists($fileDir))
				die("no se pudo crear $fileDir: chequear permisos");
			
			if ($headlineAttachment->oldDataExists()) {
				rename($headlineAttachment->getOldRealpath(), $headlineAttachment->getRealpath());
				if (!file_exists($headlineAttachment->getRealpath()))
					echo "error moviendo ".$headlineAttachment->getOldRealpath()." to ".$headlineAttachment->getRealpath()."<br>";
			}
			if ($headlineAttachment->oldSecondaryDataExists()) {
				rename($headlineAttachment->getOldSecondaryDataRealpath(), $headlineAttachment->getSecondaryDataRealpath());
				if (!file_exists($headlineAttachment->getSecondaryDataRealpath()))
					echo "error moviendo ".$headlineAttachment->getOldSecondaryDataRealpath()." to ".$headlineAttachment->getSecondaryDataRealpath()."<br>";
			}
		}
		
		echo "TERMINADO";
	}
}
