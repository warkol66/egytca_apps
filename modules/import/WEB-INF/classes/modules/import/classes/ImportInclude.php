<?php

require_once('import/classes/ClientQuote.php');

/**
 *
 *
 * @package    import
 */
class ImportInclude extends ClientQuote {

	function getClientQuoteList($options) {

		require_once("ClientQuotePeer.php");

		$result = ClientQuotePeer::getAll();

		return $result;

	}


} // ClientQuoteInclude
