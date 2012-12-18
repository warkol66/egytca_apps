<?php
/**
* TemplatesDoDeleteAction
*
*  Action que genera un cambio de estado en la base de datos, se le manda el nombre de una categoria
*  y lo busca en dicha base de datos y finalmente lo elimina.
*
*/

class TemplatesDoDeleteAction extends BaseDoDeleteAction {

	function __construct() {
		parent::__construct('Template');
	}

	protected function postDelete(){
		parent::postDelete();

		global $appDir;
		$templatesPath = realpath($appDir . '/WEB-INF/templates/');
		unlink($templatesPath . '/' . $this->entity->getId());
		
	}

}
