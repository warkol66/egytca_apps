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
			//usuarios
			$text =  preg_replace('/^@(\w+){1,15}/', "<$tagName$class>".'$0'."</$tagName>", $text);
			$text =  preg_replace('/@(\w+){1,15}/', "<$tagName$class>".'$0'."</$tagName>", $text);
			//urls
			$text =  preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', "<$tagName$class>".'$0'."</$tagName>", $text);
			//hashtags
			//$text =  preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', "<$tagName$class><strong>".'$0'."</strong></$tagName>", $text);
			//$text =  preg_replace('/#(\w+)/', "<$tagName$class><strong>".'$0'."</strong></$tagName>", $text);
			$text =  preg_replace('/#([^\n\s]+)/', "<$tagName$class><strong>".'$0'."</strong></$tagName>", $text);
	}
	return($text);
}
