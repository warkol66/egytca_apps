<?php

class ActorsDoUploadPhotoAction extends BaseAction {
	
	protected $smarty;
	protected $mapping;

	function ActorsDoUploadPhotoAction() {
		;
	}
	
	function success() {
//		if ($this->isAjax()) {
//			$this->smarty->display('ActorsDoUploadPhotoX.tpl');
//		} else {
//			return $this->mapping->findForwardConfig('success');
//		}
		return;
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
		
		parent::execute($mapping, $form, $request, $response);
		
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
			
			$photosDir = ConfigModule::get('actors', 'photosDir');
			
			$newWidth = $config['photoSize']['width'];
			$newHeight = $config['photoSize']['height'];
			$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$newFilename = $actor->getId() . '.' . $extension;
			
			switch ($extension) {
				case 'jpeg':
				case 'jpg' :
					$readImgFn = 'imagecreatefromjpeg';
					$saveImgFn = 'imagejpeg';
					break;
				case 'gif':
					$readImgFn = 'imagecreatefromgif';
					$saveImgFn = 'imagegif';
					break;
				case 'png':
					$readImgFn = 'imagecreatefrompng';
					$saveImgFn = 'imagepng';
					break;
			}
			$tmpImage = $readImgFn($_FILES['file']['tmp_name']);
			list($tmpWidth, $tmpHeight) = getimagesize($_FILES['file']['tmp_name']);
			$resized = imagecreatetruecolor($newWidth, $newHeight);
			imagecopyresampled($resized, $tmpImage, 0, 0, 0, 0, $newWidth, $newHeight, $tmpWidth, $tmpHeight);
			$saveImgFn($resized, $photosDir.'/'.$newFilename);
			
			if (!file_exists($photosDir.'/'.$newFilename))
//				return $this->failure("cannot create file $newFilename in dir $photosDir. check dir existance and permissions");
				echo "cannot create file $newFilename in dir $photosDir. check dir existance and permissions";
			
			return $this->success();
		}
	}
}

