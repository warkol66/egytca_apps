<?php

/**
 * lcfirst
 * lcfirst para php < 5.3.0
 * @return primer caracter de string en minuscula
 */
if (false === function_exists('lcfirst')) {
	function lcfirst( $str ) {
		return (string)(strtolower(substr($str,0,1)).substr($str,1));
	}
}
