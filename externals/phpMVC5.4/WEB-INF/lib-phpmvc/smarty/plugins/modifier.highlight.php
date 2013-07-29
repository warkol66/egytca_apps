<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier
 * Name:     highlight
 * Date:     Feb 26, 2003
 * Purpose:  highlight a word o array of words
 * Example:  {$text|highlight:['Internet','PHP','Apache webserver']}
 * @version  1.0
 * @param string
 * @return string
 */
function smarty_modifier_highlight($text='', $words='', $className='')
{
	if(strlen($text) > 0) {
		if (!empty($className)) {
			$tagName = "span";
			$class = " class='$className'";
		}
		else
			$tagName = "strong";
		if (!is_array($words))
			if (strlen(trim($words)) > 0)
				$words = explode(' ',trim($words));
		foreach ($words as $word)
			$text =  preg_replace('/\b('.preg_quote($word).')\b/i', "<$tagName$class>".'$1'."</$tagName>", $text);
	}
	return($text);
}
