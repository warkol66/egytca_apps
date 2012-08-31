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
function smarty_modifier_highlight($text='', $words='')
{
   if(strlen($text) > 0 && strlen(trim($words)) > 0)
   {
   	$wordsArray = explode(' ',trim($words));
   	foreach ($wordsArray as $word)
      $text =  preg_replace('/\b('.preg_quote($word).')\b/', '<b>${1}</b>', $text);
   }
   return($text);
}
