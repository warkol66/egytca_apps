<?php
/**
 * BlogDoDeleteAction
 *
 * Elimina Entradas (BlogEntry)
 *
 */

class BlogDoDeleteAction extends BaseDoDeleteAction {
	
	function __construct() {
		parent::__construct('BlogEntry');
	}

}
