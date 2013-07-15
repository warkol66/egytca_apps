<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {javascript_form_validation_button} function plugin
 *
 *
 * Helper que permite crear un boton de submit de un formulario el cual ejecutara el formateo de los datos y la validacion de 
 * javascript del mismo del framework.
 *
 * Type:     function<br>
 * Name:     javascript_form_format_validation_button<br>
 * Purpose:  Helper de Validacion
 * @author 
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_javascript_form_format_button($params, &$smarty){
    
	if (empty($params['id']))
		$buttonId = 'submit_button';
	else
		$buttonId = $params['id'];

	if (empty($params['name']))
		$buttonName = 'submit_button';
	else
		$buttonName = $params['name'];

	if (empty($params['value']))
		$buttonValue = 'Submit';
	else
		$buttonValue = $params['value'];

	if (empty($params['title']))
		$buttonTitle = $buttonName;
	else
		$buttonTitle = $params['title'];
		
	if (empty($params['thousands']))
		$thousands = '.';
	else
		$thousands = $params['thousands'];
		
	if (empty($params['decimal']))
		$decimal = ',';
	else
		$decimal = $params['decimal'];

	$output = "<input type=\"button\" name=\"$buttonName\" id=\"$buttonId\" value=\"$buttonValue\" title=\"$buttonTitle\" onClick=\"javascript:formatInputs('$thousands','$decimal',this.form);\" />";

	return $output;

}
