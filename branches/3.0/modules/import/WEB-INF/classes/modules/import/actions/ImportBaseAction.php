<?php

require_once("BaseAction.php");

class ImportBaseAction extends BaseAction {

	/**
	 * Crea el contenido del email para notificar a un supplier quote
	 *
	 */
	public function renderSupplierQuoteNotifyEmail($supplierQuote) {
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		
		$this->template->template = 'TemplateMail.tpl';
		
		$smarty->assign('supplierQuote',$supplierQuote);
		$smarty->assign('supplier',$supplierQuote->getSupplier());
		
		$content = $smarty->fetch("ImportSupplierQuoteNotifyEmail.tpl");
		
		return $content;
		
	}

	/**
	 * Crea el contenido del email para notificar a un supplier quote de feedback
	 *
	 */
	public function renderSupplierQuoteFeedbackNotifyEmail($supplierQuote) {
		
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		
		$this->template->template = 'TemplateMail.tpl';
		
		$smarty->assign('supplierQuote',$supplierQuote);
		$smarty->assign('supplier',$supplierQuote->getSupplier());
		
		$content = $smarty->fetch("ImportSupplierQuoteFeedbackNotifyEmail.tpl");
		
		return $content;
		
	}

}