<?php

require_once 'FileResampler.php';

class ConstructionsDoUploadInspectionPhotoAction extends BaseAction {
	
	protected $smarty;
	protected $mapping;

	function ConstructionsDoUploadInspectionPhotoAction() {
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
		
		parent::execute($mapping, $form, $request, $response);
		
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
		} elseif (empty($_REQUEST['id'])) {
			return $this->failure('missing param: id');
		} else {
			$inspection = InspectionQuery::create()->findOneById($_REQUEST['id']);
			if (is_null($inspection))
				return $this->failure('invalid id');
			
			$newFilename = uniqid().'.png';
			
			try {
				$photosDir = ConfigModule::get('constructions', 'inspectionPhotosDir').'/'.$inspection->getId();
				FileResampler::resampleTmp($_FILES['file'], $photosDir.'/'.$newFilename);
			} catch (Exception $e) {
				echo $e->getMessage();
//				return $this->failure($e->getMessage());
			}
			
//			return $this->success();
			return;
		}
	}
}

