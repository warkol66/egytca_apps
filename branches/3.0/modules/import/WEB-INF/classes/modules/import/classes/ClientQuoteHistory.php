<?php

require_once('import/classes/ClientQuoteHistoryPeer.php');
require 'import/classes/om/BaseClientQuoteHistory.php';


/**
 * Skeleton subclass for representing a row from the 'import_clientQuoteHistory' table.
 *
 * Historial de Cotizacion a Cliente
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    import.classes
 */
class ClientQuoteHistory extends BaseClientQuoteHistory {

	/**
	 * Initializes internal state of ClientQuoteHistory object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Devuelve el nombre del status actual de la cotizacion para un administrador
	 * @return string
	 */
	public function getStatusNameAdmin() {
		
		$clientQuote = $this->getClientQuote();
		$statusNames = $clientQuote->getStatusNamesAdmin();
		return $statusNames[$this->getStatus()];
	}

	/**
	 * Devuelve el nombre del status actual de la cotizacion para un cliente
	 * @return string
	 */
	public function getStatusNameClient() {
		$clientQuote = $this->getClientQuote();
		$statusNames = $clientQuote->getStatusNamesClient();
		return $statusNames[$this->getStatus()];
	}	

} // ClientQuoteHistory
