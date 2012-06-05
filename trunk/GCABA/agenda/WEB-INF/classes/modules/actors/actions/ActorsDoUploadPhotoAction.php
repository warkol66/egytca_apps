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
			
			$photosDir = 'WEB-INF/classes/modules/actors/files/photos';
			preg_match('/[^\.]\w+$/', $_FILES['file']['name'], $matches);
			$extension = $matches[0];
			$filename = $actor->getId() . '.' . $extension;
			move_uploaded_file($_FILES['file']['tmp_name'], $photosDir.'/'.$filename);
			if (!file_exists($photosDir.'/'.$filename))
//				return $this->failure("cannot create file $filename in dir $photosDir. check dir existance and permissions");
				echo "cannot create file $filename in dir $photosDir. check dir existance and permissions";
			
			return $this->success();
		}
	}
}

