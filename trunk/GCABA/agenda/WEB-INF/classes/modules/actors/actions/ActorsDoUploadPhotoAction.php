<?php

require_once 'FileResampler.php';

class ActorsDoUploadPhotoAction extends BaseAction {
	
	protected $smarty;
	protected $mapping;

	function ActorsDoUploadPhotoAction() {
		;
	}
	
	function success() {
		if ($this->isAjax()) {
			$this->smarty->display('ActorsDoUploadPhotoX.tpl');
		} else {
			return $this->mapping->findForwardConfig('success');
		}
	}
	
	function failure($msg = '') {
		if ($this->isAjax()) {
			throw new Exception($msg);
		} else {
			if (!empty($msg))
				$this->smarty->assign('message', $msg);
			return $this->mapping->findForwardConfig('failure');
		}
	}

	function execute($mapping, $form, &$request, &$response) {
		
		if ($_POST['isSWFU']) {
			if (isset($_POST["PHPSESSID"])) {
				session_id($_POST["PHPSESSID"]);
				session_start();
			}
		} else {
			// TODO: revisar por que deja de andar el swfupload con esto
			parent::execute($mapping, $form, $request, $response);
		}
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		$this->smarty = $smarty;
		$this->mapping = $mapping;

		$module = 'Actors';
		$smarty->assign('module', $module);
		
		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}
		
		$config = Common::getConfiguration('Actors');
		
		if ($_FILES['file']['error'] > 0) {
			return $this->failure($_FILES['file']['error']);
		} elseif (empty($_REQUEST['id'])) {
			return $this->failure('missing param: id');
		} else {
			$actor = ActorQuery::create()->findOneById($_REQUEST['id']);
			if (is_null($actor))
				return $this->failure('invalid id');
			
			$newFilename = $actor->getId().'.png';
			
			try {
				$photosDir = ConfigModule::get('actors', 'photosDir');
				Common::ensureWritable($photosDir);
				$thumbnailsDir = ConfigModule::get('actors', 'thumbnailsDir');
				Common::ensureWritable($thumbnailsDir);
				
				$newWidth = $config['photoSize']['width'];
				$newHeight = $config['photoSize']['height'];
				FileResampler::resampleTmp($_FILES['file'], $photosDir.'/'.$newFilename, $newWidth, $newHeight);
								
				$newWidth = $config['thumbnailSize']['width'];
				$newHeight = $config['thumbnailSize']['height'];
				FileResampler::resampleTmp($_FILES['file'], $thumbnailsDir.'/'.$newFilename, $newWidth, $newHeight);
			} catch (Exception $e) {
				echo $e->getMessage();
//				return $this->failure($e->getMessage());
			}
			
//			return $this->success();
			return;
		}
	}
}

