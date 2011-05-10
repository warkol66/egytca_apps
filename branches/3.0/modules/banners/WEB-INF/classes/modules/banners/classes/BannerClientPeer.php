<?php

/**
 * Skeleton subclass for performing query and update operations on the 'banners_client' table.
 *
 * Clientes de los banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners.classes
 */
class BannerClientPeer extends BaseBannerClientPeer {

	/**
	* Obtiene todos los clientes de banners.
	*
	*	@return array Informacion sobre todos los clientes de banners
	*/
	function getAll() {
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(BannerClientPeer::ID);
		$allObj = BannerClientPeer::doSelect($criteria);
		return $allObj;
	}

	/**
	* Obtiene la informacion de un cliente.
	*
	* @param int $id Id del cliente
	* @return array Informacion del cliente
	*/
	function get($id) {
		$obj = BannerClientPeer::retrieveByPK($id);
		return $obj;
	}

	/**
	* Crea un cliente nuevo.
	*
	* @param string $name Nombre de cliente
	* @param string $contactName Nombre del contacto del el cliente
	* @param string $phone Teléfonos del cliente
	* @param string $eMail EMail del cliente
	* @param string $webSiteUrl Url del sitio web del clientes
	* @param string $comments Comentarios para el cliente
	* @return boolean true si pudo crear el cliente sino false
	*/
	function create($name, $contactName, $phone, $eMail, $webSiteUrl, $comments)
	{
		try {
			$client = new BannerClient();
			$client->setName($name);
			$client->setContactName($contactName);
			$client->setPhone($phone);
			$client->setEMail($eMail);
			$client->setWebSiteUrl($webSiteUrl);
			$client->setComments($comments);
			$client->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza un cliente.
	*
	* @param int $id ID de cliente
	* @param string $name Nombre de cliente
	* @param string $contactName Nombre del contacto del el cliente
	* @param string $phone Teléfonos del cliente
	* @param string $eMail EMail del cliente
	* @param string $webSiteUrl Url del sitio web del clientes
	* @param string $comments Comentarios para el cliente
	* @return boolean true si pudo actualizar el cliente sino false
	*/
	function update($id, $name, $contactName, $phone, $eMail, $webSiteUrl, $comments)
	{
		try {
			$client = BannerClientPeer::retrieveByPK($id);
			$client->setName($name);
			$client->setContactName($contactName);
			$client->setPhone($phone);
			$client->setEMail($eMail);
			$client->setWebSiteUrl($webSiteUrl);
			$client->setComments($comments);
			$client->save();
			return true;
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina un cliente.
	*
	* @param int $id ID de cliente
	* @return boolean true si pudo actualizar el cliente sino false
	*/
	function delete($id)
	{
		try {
			return BannerClientPeer::doDelete($id);
		}
		catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

} // BannerClientPeer
