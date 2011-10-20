<?php

require_once 'AffiliatesListAction.php';

class AffiliatesContractorsListAction extends AffiliatesListAction {

	public function AffiliatesContractorsListAction() {
        parent::__construct();
        $this->set('listAction', 'affiliatesContractorsList');
        $this->set('classKey', AffiliatePeer::CLASSKEY_CONTRACTOR);
        $this->set('query', ContractQuery::create());
	}

}
