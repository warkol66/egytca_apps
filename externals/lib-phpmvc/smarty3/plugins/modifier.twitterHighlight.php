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
 * Name:     twitterHighlight
 * Date:     Feb 26, 2003
 * Purpose:  highlight hashtags y users en un tweet
 * Example:  {$text|twitterHighlight}
 * @version  1.0
 * @param string
 * @return string
 */
function smarty_modifier_twitterHighlight($text='')
{
	if(strlen($text) > 0) {
		$tagName = "span";
		$class = " class='userHash'";
			$text =  preg_replace('/@+([\w]+)/', "<$tagName$class>".'$0'."</$tagName>", $text);
			$text =  preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', "<$tagName$class><strong>".'$0'."</strong></$tagName>", $text);
	}
	return($text);
}
