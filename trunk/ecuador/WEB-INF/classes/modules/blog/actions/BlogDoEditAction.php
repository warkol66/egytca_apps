<?php

class BlogDoEditAction extends BaseDoEditAction {

	function __construct() {
		parent::__construct('BlogEntry');
	}
	
	protected function postUpdate(){
		parent::postUpdate();
	}
	
}
