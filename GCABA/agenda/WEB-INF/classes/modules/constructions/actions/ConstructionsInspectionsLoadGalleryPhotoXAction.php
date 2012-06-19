<?php

class ConstructionsInspectionsLoadGalleryPhotoXAction extends BaseAction {
	
	function ConstructionsInspectionsLoadGalleryPhotoXAction() {
		;
	}
	
	public function execute($mapping, $form, &$request, &$response) {
		parent::execute($mapping, $form, $request, $response);
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		if (!empty($_POST['photoId'])) {
			$photo = ResourceQuery::create()->findOneById($_POST['photoId']);
			if (is_null($photo))
				throw new Exception('invalid id');
			
			$smarty->assign('photo', $photo);
			$smarty->display('ConstructionsInspectionsGalleryPhotoInclude.tpl');
		} else {
			throw new Exception('invalid params'); // trigger ajax failure
		}
	}
}