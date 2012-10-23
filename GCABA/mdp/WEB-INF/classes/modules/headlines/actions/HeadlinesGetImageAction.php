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
					
					$clippingType = Headline::CLIPPING_NORMAL;
					if ($_GET['tryresampled']) {
						if ($headline->hasClipping(Headline::CLIPPING_RESIZED))
							$clippingType = Headline::CLIPPING_RESIZED;
						
					}
					
					if (!$headline->hasClipping())
						throw new Exception("headline with id ".$headline->getId()." doesn't have a clipping");
					
					$type = 'image/jpg';
					$filename = 'c-'.$headline->getId().'.jpg';
					$path = $headline->getClippingFullname($clippingType);
					
					header('Content-Type: '.$type);
					header("Content-length: ".filesize($path));
					header('Content-Disposition: inline; filename="'.$filename.'"');
					readfile($path);
			
					break;
				
				case 'attachment':
					$attachment = HeadlineAttachmentQuery::create()->findOneById($_GET['id']);
					if (is_null($attachment)) 
						throw new Exception('invalid ID');
					
					$type = $attachment->getType();
					if ($type != 'image/jpg')
						throw new Exception('attachment is not a jpeg image');
					$filename = 'a-'.$attachment->getId().'.jpg';
					
					// $_GET['tryresampled'] tiene prioridad sobre $_GET['secondary']
					if (!empty($_GET['tryresampled'])) {
						$secDataRealpath = $attachment->getSecondaryDataRealpath();
						$path = file_exists($secDataRealpath) ? $secDataRealpath : $attachment->getRealpath();
					} else {
						$path = empty($_GET['secondary']) ? $attachment->getRealpath() : $attachment->getSecondaryDataRealpath();
					}
					
					header('Content-Type: '.$type);
					header("Content-length: ".filesize($path));
					header('Content-Disposition: inline; filename="'.$filename.'"');
					readfile($path);
			
					break;
					
				case 'document':
					$document = DocumentQuery::create()->findOneById($_GET['id']);
					if (is_null($document))
						throw new Exception('invalid ID');
					
					$extension = strrchr(strtolower($document->getRealfilename()),'.');

					switch ($extension) {
						case ".gif":
							header('Content-Type: image/gif');
							break;
						case ".jpg":
							header('Content-Type: image/jpeg');
							break;
						case ".png":
							header('Content-Type: image/png');
							break;
						default:
							throw new Exception('invalid file type');
					}

					$document->getContents();
					break;
					
				default:
					throw new Exception('unknown image source');
			}
		}
		else
			throw new Exception('faltan parametros');
	}
	
}