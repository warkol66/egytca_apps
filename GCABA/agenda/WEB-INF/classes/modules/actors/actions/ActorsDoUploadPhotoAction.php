<?php

require_once 'FileResampler.php';

class ActorsDoUploadPhotoAction extends BaseAction {
	
	protected $smarty;
	protected $mapping;
	
	private $actor;

	function ActorsDoUploadPhotoAction() {
		;
	}
	
	function success() {
		if (!empty($_POST['isSWFU'])) {
			$this->smarty->assign('error', 0);
			$this->smarty->assign('data', json_encode(array(
				'actor' => $this->actor->toJSON()
			)));
			$this->smarty->display('EntityDoUploadResourceSWF.tpl');
		} else {
			if ($this->isAjax()) {
				$this->smarty->display('ActorsDoUploadPhotoX.tpl');
			} else {
				return $this->mapping->findForwardConfig('success');
			}
		}
	}
	
	function failure($msg = '') {
		if (!empty($_POST['isSWFU'])) {
			$this->smarty->assign('error', 1);
			$this->smarty->assign('message', $msg);
			$this->smarty->display('EntityDoUploadResourceSWF.tpl');
		} else {
			if ($this->isAjax()) {
				throw new Exception($msg);
			} else {
				if (!empty($msg))
					$this->smarty->assign('message', $msg);
				return $this->mapping->findForwardConfig('failure');
			}
		}
	}

	function execute($mapping, $form, &$request, &$response) {
		
		if (!empty($_POST['isSWFU'])) {
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
			$this->actor = ActorQuery::create()->findOneById($_REQUEST['id']);
			if (is_null($this->actor))
				return $this->failure('invalid id');
			
			$newFilename = $this->actor->getId().'.png';
			
			try {
				$photosDir = ConfigModule::get('actors', 'photosDir');
				Common::ensureWritable($photosDir);
				$thumbnailsDir = ConfigModule::get('actors', 'thumbnailsDir');
				Common::ensureWritable($thumbnailsDir);
				
				$newWidth = $config['photoSize']['width'];
				$newHeight = $config['photoSize']['height'];
				FileResampler::resampleTmp($_FILES['file'], $photosDir.'/'.$newFilename, $newWidth, $newHeight);
				$photoResource = new Resource();
				$photoResource->setPath($photosDir.'/'.$newFilename);
				$photoResource->save();
				$this->actor->setPhotoid($photoResource->getId());
								
				$newWidth = $config['thumbnailSize']['width'];
				$newHeight = $config['thumbnailSize']['height'];
				FileResampler::resampleTmp($_FILES['file'], $thumbnailsDir.'/'.$newFilename, $newWidth, $newHeight);
				$thumbnailResource = new Resource();
				$thumbnailResource->setPath($thumbnailsDir.'/'.$newFilename);
				$thumbnailResource->save();
				$this->actor->setThumbnailid($thumbnailResource->getId());
				
				$this->actor->save();
			} catch (Exception $e) {
				return $this->failure($e->getMessage());
			}
			
			return $this->success();
		}
	}
}

