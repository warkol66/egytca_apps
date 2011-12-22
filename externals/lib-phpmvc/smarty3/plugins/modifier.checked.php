<?php

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     checked
 * Purpose:  Devuelve el checked="checked" si el valor1 es igual a valor2
 * -------------------------------------------------------------
 */
function smarty_modifier_checked($value1,$value2){
	if ($value1 == $value2)
		return 'checked="checked"';
}
