<?php

class BlogChangeStatusXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
		//Arreglar multiple edit
		if (isset($_POST['status']) && isset($_POST['selected'])) {
			BlogEntryQuery::create()
				->filterById(($_POST['selected']), Criteria::IN)
				->update(array('status' => $_POST['status']));
		}
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
	}

}
