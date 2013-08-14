<?php
class SmartyMLPlugInDriver extends APlugIn {
	function SmartyMLPlugInDriver() {  		parent::APlugIn();
		$this -> plugIn = new SmartyML("en");
	}

}
?>
