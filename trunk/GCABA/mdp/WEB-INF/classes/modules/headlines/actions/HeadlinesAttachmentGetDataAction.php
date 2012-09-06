<?php

class HeadlinesAttachmentGetDataAction extends BaseAction {
	
	function HeadlinesAttachmentGetDataAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_GET['id'])) {
			$attachment = HeadlineAttachmentQuery::create()->findOneById($_GET['id']);
			if (is_null($attachment))
				throw new Exception('invalid ID');
			
			// por algun motivo extranio los videos dicen wmv pero son 3gp
			$type = $attachment->getType() == 'video/x-ms-wmv' ? 'video/3gpp' : $attachment->getType();
			switch ($type) {
				case 'video/3gpp':
					$extension = '3gp';
					break;
				case 'audio/mpeg':
					$extension = 'mp3';
					break;
				case 'image/jpeg':
					$extension = 'jpg';
					break;
			}
			header('Content-Type: '.$type);
			header("Content-length: ".filesize($attachment->getRealpath()));
			header('Content-Disposition: attachment; filename="'.$attachment->getId().'.'.$extension.'"');
			readfile($attachment->getRealpath());
		}
		else
			throw new Exception('missing ID');
	}
	
}