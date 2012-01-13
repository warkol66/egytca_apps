<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Include the {@link shared.make_timestamp.php} plugin
 */
if (method_exists($smarty, '_get_plugin_filepath')) {
	//handle with Smarty version 2
	require_once $smarty->_get_plugin_filepath('shared', 'make_timestamp');
} else {
	//handle with Smarty version 3
	foreach ($smarty->getPluginDir as $value) {
		$filepath = $value ."/shared.make_timestamp.php";
		if (file_exists($filepath))
			require_once $filepath;
	}
}

/**
 * Smarty date_format modifier plugin
 *
 * Type:     modifier<br>
 * Name:     dateTime_format<br>
 * Purpose:  format datestamps via strftime<br>
 * Input:<br>
 *         - string: input date string
 *         - format: strftime format for output
 *         - default_date: default date if $string is empty
 * @link http://smarty.php.net/manual/en/language.modifier.date.format.php
 *          date_format (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string
 * @param string
 * @return string|void
 * @uses smarty_make_timestamp()
 */
function smarty_modifier_dateTime_format($string, $format = '', $default_date = '')
{
    //modificacion para uso del formato por default del sistema
	if ($format == '') {
		//utilizamos el formato del sistema
		global $system;
		$format = $system["config"]["system"]["parameters"]["dateTimeFormat"]["value"];

		$format = preg_replace_callback('/[A-Za-z]/',
								create_function('$matches', 'return "%".$matches[0];'),
								$format
							);

		if (empty($format))
			//seteamos el formato default de smarty
			$format = '%m-%d-%Y %H:%M:%S';		
	}

	if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } elseif ($default_date != '') {
        $timestamp = smarty_make_timestamp($default_date);
    } else {
        return;
    }
    if (DIRECTORY_SEPARATOR == '\\') {
        $_win_from = array('%D',       '%h', '%n', '%r',          '%R',    '%t', '%T');
        $_win_to   = array('%m/%d/%y', '%b', "\n", '%I:%M:%S %p', '%H:%M', "\t", '%H:%M:%S');
        if (strpos($format, '%e') !== false) {
            $_win_from[] = '%e';
            $_win_to[]   = sprintf('%\' 2d', date('j', $timestamp));
        }
        if (strpos($format, '%l') !== false) {
            $_win_from[] = '%l';
            $_win_to[]   = sprintf('%\' 2d', date('h', $timestamp));
        }
        $format = str_replace($_win_from, $_win_to, $format);
    }
    return strftime($format, $timestamp);
}

/* vim: set expandtab: */

?>
