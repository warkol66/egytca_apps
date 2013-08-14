<?php
class ActionErrors extends ActionMessages {
	var $GLOBAL_ERROR = 'phpmvc.action.GLOBAL_ERROR';
	function getGlobalErrorKey() {
		return $this -> GLOBAL_ERROR;
	}
	function add($property, $error) { parent::add($property, $error);
	}

}
?>
