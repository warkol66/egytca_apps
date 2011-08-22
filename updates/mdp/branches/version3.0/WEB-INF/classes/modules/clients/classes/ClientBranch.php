<?php



/**
 * Skeleton subclass for representing a row from the 'clients_branch' table.
 *
 * Sucursales de Clientes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientBranch extends BaseClientBranch {

  /**
  * Obtiene el nombre del cliente o nada si no lo encuentra
  *
  * @return string Nombre del cliente
  */
	function getClient() {
		$clientId = $this->getClientId();
		$client = ClientQuery::create()->findPk($clientId);
		if($client)
			return $client->getName();
		else
			return;
  }

} // ClientBranch
