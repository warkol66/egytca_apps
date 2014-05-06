<?php

class HeadlinesAttachmentDownloadXAction extends BaseAction {
	
	private $format = null;
	private $mapping;
	private $smarty;

	function HeadlinesAttachmentDownloadXAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

		parent::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty = $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->mapping = $mapping;
		$this->smarty = $smarty;
		
		if (!empty($_REQUEST['format']) && $_REQUEST['format'] == 'json')
			$this->format = 'json';

		if (!empty($_POST['id'])) {
			
			$attachment = HeadlineAttachmentQuery::create()->findOneById($_POST['id']);

			if (!is_null($attachment)) {
				try {
					$attachment->download();
				} catch (Exception $e) {
					return $this->returnError($e->getMessage());
				}
				
				$smarty->assign('name', $attachment->getName());
				return $this->returnSuccess();
			} else {
				return $this->returnError('invalid ID');
			}
		} else {
			return $this->returnError('missing ID');
		}
	}
	
	private function returnError($message) {
		if ($this->format == 'json') {
			echo json_encode(array(
				'error' => array('message' => $message)
			), JSON_PRETTY_PRINT);
			echo "\n";
			return;
		} else {
			$this->smarty->assign('errorMessage', $message);
			return $this->mapping->findForwardConfig('success');
		}
	}
	
	private function returnSuccess() {
		if ($this->format == 'json') {
			echo json_encode(array(
				'error' => null
			), JSON_PRETTY_PRINT);
			echo "\n";
			return;
		} else {
			return $this->mapping->findForwardConfig('success');
		}
	}
}
