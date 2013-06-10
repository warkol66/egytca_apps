<?php
/**
 * HeadlinesTagsDoEditAction
 *
 * Crea o guarda cambios de etiquetas (HeadlineTag)
 *
 * @package    headlines
 */
require_once 'BaseDoEditAction.php';

class HeadlinesTagsDoEditAction extends BaseDoEditAction {
	
	function __construct() {
		parent::__construct('HeadlineTag');
	}

}
