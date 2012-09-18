<?php

require_once 'AffiliatesListAction.php';

class AffiliatesClientsListAction extends AffiliatesListAction {

	public function AffiliatesClientsListAction() {
        parent::__construct();
        $this->set('listAction', 'affiliatesClientsList');
        $this->set('classKey', AffiliatePeer::CLASSKEY_CLIENT);
        $this->set('class', 'Client');
	}

}
