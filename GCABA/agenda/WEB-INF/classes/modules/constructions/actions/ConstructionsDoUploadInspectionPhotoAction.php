<?php

require_once 'FileResampler.php';

class ConstructionsDoUploadInspectionPhotoAction extends BaseAction {
	
	protected $smarty;
	protected $mapping;
	
	private $inspection;
	private $photoName;

	function ConstructionsDoUploadInspectionPhotoAction() {
		;
	}
	
	function success() {
		if (!empty($_POST['isSWFU'])) {
			$this->smarty->assign('error', 0);
			$this->smarty->assign('data', json_encode(array(
				'inspection' => $this->inspection->toJSON(),
				'photo' => $this->photoName
			)));
			$this->smarty->display('EntityDoUploadResourceSWF.tpl');
		} else {
			if ($this->isAjax()) {
				$this->smarty->display('ConstructionsDoUploadInspectionPhotoX.tpl');
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

		$module = 'Constructions';
		$smarty->assign('module', $module);
		
		if (!empty($_GET['filters'])) {
			$filters = $_GET['filters'];
			$smarty->assign('filters', $filters);
		}
		
		$config = Common::getConfiguration($module);
		
		if ($_FILES['file']['error'] > 0) {
			return $this->failure($_FILES['file']['error']);
		} elseif (empty($_REQUEST['inspectionId'])) {
			return $this->failure('missing param: inspectionId');
		} else {
			$this->inspection = InspectionQuery::create()->findOneById($_REQUEST['inspectionId']);
			if (is_null($this->inspection))
				return $this->failure('invalid inspectionId');
			
			$photoResource = new Resource();
			$photoResource->fromArray($_POST['params'], BasePeer::TYPE_FIELDNAME);
			
			$newFilename = uniqid().'.png';
			
			try {
				$photosDir = ConfigModule::get('constructions', 'inspectionPhotosDir').'/'.$this->inspection->getId();
				Common::ensureWritable($photosDir);
				FileResampler::resampleTmp($_FILES['file'], $photosDir.'/'.$newFilename);
				$this->photoName = $photosDir.'/'.$newFilename;
				$photoResource->setPath($this->photoName);
				$this->inspection->addResource($photoResource);
				$this->inspection->save();
			} catch (Exception $e) {
				return $this->failure($e->getMessage());
			}
			
			return $this->success();
		}
	}
}

