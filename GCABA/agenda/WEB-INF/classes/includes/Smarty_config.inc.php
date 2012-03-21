<?php
/*
 * Configuración del Smarty Templates
 *
 * @package Config
 */
/**
 * Used to setup an output filter to include the action HTML in an external template
 *
 */
class SmartyOutputFilter{
	/**
	 * External template file to use
	 *
	 * @var string
	 */
	public $template = 'Template.tpl';
	/**
	 * Smarty postfilter
	 *
	 * @param string $html
	 * @param Smarty $smarty
	 * @return string
	 */
		function smarty_add_template($html, &$smarty){
			if (!empty($GLOBALS[__FUNCTION__]))
				return $html;
			$GLOBALS[__FUNCTION__] = true;
			$smarty->assign("centerHTML",$html);
			$html = $smarty->fetch($this->template);
			$GLOBALS[__FUNCTION__] = false;
			return $html;
		}
}
