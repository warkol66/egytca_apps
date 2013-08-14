<?php
class SmartyPlugInDriver extends APlugIn {
	function SmartyPlugInDriver() {  		parent::APlugIn();
		$this -> plugIn = new Smarty;
	}

}
?>
