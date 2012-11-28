<?php

class BlogCommentsChangeStatusXAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('BlogComment');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
	}
	
}
