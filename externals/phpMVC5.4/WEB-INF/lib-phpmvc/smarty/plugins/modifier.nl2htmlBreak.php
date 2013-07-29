<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     nl2htmlBreak<br>
 * Date:     Feb 26, 2003
 * Purpose:  convert \r\n, \r or \n to any html break (p, li, ul, span)
 * Example:  {$text|nl2br:p:myClass}
 * @version  1.0
 * @param string
 * @return string
 */
function smarty_modifier_nl2htmlBreak($string, $htmlBreak = 'p', $class = NULL)
{
		if (isset($class))
			$class = ' class="' . $class . '"';

    return "<$htmlBreak$class>" . str_replace("<br />", "</$htmlBreak>\n<$htmlBreak$class>", nl2br($string)) . "</$htmlBreak>\n";
}
