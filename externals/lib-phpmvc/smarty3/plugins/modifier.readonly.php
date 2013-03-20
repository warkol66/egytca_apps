<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     readonly
 * Purpose:  Devuelve el readonly="readonly" class="readonly" si el valor es show o readonly
 * Example:  |-$readonly|readonly-| o |-$readonly|readonly:"emptyValidation right"-|
 * -------------------------------------------------------------
 */
function smarty_modifier_readonly($value, $class = '') {
	if ($class != '')
		$separator = ' ';
	if ($value == "readonly" || $value == "showLog")
		return 'readonly="readonly" class="' . $class . $separator . 'readOnly" onclick="return false" onkeydown="return false"';
	if ($class != '')
		$class = 'class="' . $class . '"';
	return $class;
}
