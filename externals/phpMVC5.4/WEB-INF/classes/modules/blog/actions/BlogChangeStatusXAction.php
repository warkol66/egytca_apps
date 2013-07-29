<?php

class BlogChangeStatusXAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function preUpdate(){
		parent::preUpdate();
		
	}
	
	protected function postUpdate(){
		parent::postUpdate();
		
	}

}
