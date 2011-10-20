<?php

require_once 'AffiliatesListAction.php';

class AffiliatesVerifiersListAction extends AffiliatesListAction {

	public function AffiliatesVerifiersListAction() {
        parent::__construct();
        $this->set('listAction', 'affiliatesVerifiersList');
        $this->set('classKey', AffiliatePeer::CLASSKEY_VERIFIER);
        $this->set('query', VerifierQuery::create());
	}

}
