<?php

class BoardBondsDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BoardBond');
		
	}
	
	protected function postDelete(){
		parent::postDelete();
		
	}

}
