<?php
/**
 * HeadlinesTagsEditAction
 *
 * Crea o guarda cambios de etiquetas (HeadlineTag)
 *
 * @package    headlines
 */
require_once 'BaseEditAction.php';

class HeadlinesTagsEditAction extends BaseEditAction {
	
	function __construct() {
		parent::__construct('HeadlineTag');
	}
	
}
