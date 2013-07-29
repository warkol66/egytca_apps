<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {entity_include} function plugin
 *
 * Type:     function<br>
 * Name:     entity_include<br>
 * Purpose:  incluir consultas a entidades<br>
 * Example:	 {entity_include entity=Position template="PositionsHomeInclude.tpl" filters=['type'=>'11','limit'=>'5']}
 * @param array $params
 * @param Smarty $smarty
 */

function smarty_function_entity_include($params, &$smarty)
{

	if (!empty($params['entity']))
		$smarty->assign("result", BaseQuery::create($params['entity'])->addFilters($params['filters'])->find());

	//Debo cambiarle el outputfilter para poder usar otro external
	$smartyOutputFilter = new SmartyOutputFilter();
	$smartyOutputFilter->template = 'TemplateInclude.tpl';
	$smartyFilters = $smarty->getRegisteredFilters();
	$oldSmartyOutputFilter = $smartyFilters['output']['SmartyOutputFilter_smarty_add_template'][0];
	$smarty->registerFilter('output', array($smartyOutputFilter,"smarty_add_template"));

	//Obtengo el html resultante
	if(!$smarty->templateExists($params['template']))
		echo "NO EXISTE TEMPLATE: '" . $params['template'] . "'.";

	$html_result = $smarty->fetch($params['template']);

	//vuelvo a poner el viejo outputfilter de antes
	$smarty->registerFilter('output', array($oldSmartyOutputFilter, 'smarty_add_template'));

	return $html_result;
}
