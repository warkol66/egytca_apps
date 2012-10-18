<?php

class HeadlinesGetImageAction extends BaseAction {
	
	function HeadlinesGetImageAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_GET['id']) && !empty($_GET['source'])) {
			
			switch ($_GET['source']) {
				case 'clipping':
					$headline = HeadlineQuery::create()->findOneById($_GET['id']);
					if (is_null($headline))
						throw new Exception('invalid ID');
					if (!$headline->hasClipping())
						throw new Exception("headline with id ".$headline->getId()." doesn't have a clipping");
					$type = 'image/jpg';
					$filename = 'c-'.$headline->getId().'.jpg';
					$path = $headline->getClippingFullname();
					break;
				
				case 'attachment':
					$attachment = HeadlineAttachmentQuery::create()->findOneById($_GET['id']);
					if (is_null($attachment)) 
						throw new Exception('invalid ID');
					
					$type = $attachment->getType();
					if ($type != 'image/jpg')
						throw new Exception('attachment is not a jpeg image');
					$filename = 'a-'.$attachment->getId().'.jpg';
					$path = empty($_GET['secondary']) ? $attachment->getRealpath() : $attachment->getSecondaryDataRealpath();
					break;
					
				default:
					throw new Exception('unknown image source');
			}
			
			header('Content-Type: '.$type);
			header("Content-length: ".filesize($path));
			header('Content-Disposition: inline; filename="'.$filename.'"');
			readfile($path);
		}
		else
			throw new Exception('faltan parametros');
	}
	
}