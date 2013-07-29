<?php

class CommonTestAction extends BaseAction {
	
	public function execute($mapping, $form, &$request, &$response) {
		
		parent::execute($mapping, $form, $request, $response);
		
		return $mapping->findForwardConfig();
	}
}
