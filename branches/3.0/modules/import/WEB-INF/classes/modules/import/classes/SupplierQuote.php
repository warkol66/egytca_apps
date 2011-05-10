﻿<?php

require_once('import/classes/SupplierQuoteHistoryPeer.php');
require_once 'import/classes/om/BaseSupplierQuote.php';


/**
 * Skeleton subclass for representing a row from the 'import_supplierQuote' table.
 *
 * Cotizacion de Proveedor
 *
 * This class was autogenerated by Propel on:
 *
 * Mon Feb  2 17:02:11 2009
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    anmaga
 */
class SupplierQuote extends BaseSupplierQuote {
	
	const STATUS_NEW = 1;
	const STATUS_QUOTE_REQUESTED = 2;
	const STATUS_PARTIALLY_QUOTED = 3;
	const STATUS_QUOTED = 4;
	const STATUS_FEEDBACK = 5;
	
	private $statusNames = array(
								SupplierQuote::STATUS_NEW => 'New',
								SupplierQuote::STATUS_QUOTE_REQUESTED => 'Quote Requested',
								SupplierQuote::STATUS_PARTIALLY_QUOTED => 'Partially Quoted',
								SupplierQuote::STATUS_QUOTED => 'Quoted',
								SupplierQuote::STATUS_FEEDBACK => 'Feedback'
							);	

	public static function getStatusNames2() {
		//nombre de los estados para los administradores
		$statusNames = array();
		$statusNames[SupplierQuote::STATUS_NEW] = Common::getTranslation('New','import');
		$statusNames[SupplierQuote::STATUS_QUOTE_REQUESTED] = Common::getTranslation('Quote Requested','import');
		$statusNames[SupplierQuote::STATUS_PARTIALLY_QUOTED] = Common::getTranslation('Partially Quoted','import');
		$statusNames[SupplierQuote::STATUS_QUOTED] = Common::getTranslation('Quoted','import');
		$statusNames[SupplierQuote::STATUS_FEEDBACK] = Common::getTranslation('Under negotiation','import');
		return $statusNames;		
	} 
	
	/**
	 * Devuelve el nombre del status actual de la cotizacion
	 * @return string
	 */
	public function getStatusName() {
		$statusArray = SupplierQuote::getStatusNames2();
		return $statusArray[$this->getStatus()];
	}
	
	/**
	 * Obtiene un cierto elemento de la cotizacion
	 * @param integer $id id del elemento a obtener
	 */
	public function getSupplierQuoteItem($id) {

		require_once('SupplierQuoteItemPeer.php');
		
		$criteria = new Criteria();
		$criteria->add(SupplierQuoteItemPeer::SUPPLIERQUOTEID,$this->getId());
		$criteria->add(SupplierQuoteItemPeer::ID,$id);
		
		$result = $this->getSupplierQuoteItems($criteria);
		return $result[0];
	}
	
	/**
	 * Crea un mensaje de notificacion a proveedor
	 * @param String $content Contenido del mensaje
	 * @param String $subject Asunto del mensaje
	 * @return Swift_Message
	 */
	private function createNotifyMessage($content,$subject = '') {

		require_once('EmailManagement.php');
		
		if (empty($subject)) {
			$subject = Common::getTranslationByLanguageCode('Quote Request','import','cn');
			$subject .= " / ".Common::getTranslationByLanguageCode('Quote Request','import','eng');
		}
		
		$manager = new EmailManagement();
		
		//creamos el mensaje multipart
		$message = $manager->createMultipartMessage($subject,$content);
		
		return $message;
	}
	
	/** 
	 * Envia un mensaje de notificacion
	 * @param String o Swift_RecipientList $destination destinatarios del email
	 * @param Swift_Message $message mensaje a enviar
	 * @return boolean
	 */
	private function sendMessage($destination,$message) {

		require_once('EmailManagement.php');

		$manager = new EmailManagement();

		global $system;
		$mailFrom = $system["config"]["system"]["parameters"]["fromEmail"];

		//realizamos el envio
		$result = $manager->sendMessage($destination,$mailFrom,$message);
		
		return $result;
	}
	
	/**
	 * Notifica a un proveedor de la existencia de un pedido de cotizacion
	 * 
	 * @param String $content Contenido del Email (debe ser generado de forma externa. Ver ImportBaseAction.php)
	 * @param String $subject Asunto del Email Opcional
	 *
	 */
	public function notifySupplier($content,$subject='') {
		
		//creamos el mensaje multipart
		$message = $this->createNotifyMessage($content,$subject);

		$supplier = $this->getSupplier();
		
		$status = $this->sendMessage($supplier->getEmail(),$message);
		
		if ($status) {
			//se envio el mensaje
			if ($this->getStatus() == SupplierQuote::STATUS_NEW) {
				try {
					//actualizamos el estado
					$this->setStatus(SupplierQuote::STATUS_QUOTE_REQUESTED);
					$this->save();
					$this->saveCurrentStatusOnHistory();
					
				} catch (PropelException $e) {
					return false;
				}
			}
		}
		
		return $status;
		
	}
	
	/**
	 * Notifica a un proveedor la necesidad de feedback sobre un item
	 * 
	 * @param String $content Contenido del Email (debe ser generado de forma externa. Ver ImportBaseAction.php)
	 * @param String $subject Asunto del Email Opcional
	 *
	 */
	public function notifyFeedbackToSupplier($content,$subject='Notificacion de Pedido de Feedback') {
		
		//creamos el mensaje multipart
		$message = $this->createNotifyMessage($content,$subject);

		$supplier = $this->getSupplier();
		
		$status = $this->sendMessage($supplier->getEmail(),$message);
				
		return $status;
		
	}	
	
	/**
	 * Notifica a un proveedor de la existencia de un pedido de cotizacion
	 * 
	 * @param String $content Contenido del Email (debe ser generado de forma externa. Ver ImportBaseAction.php)
	 * @param String $subject Asunto del Email Opcional
	 *
	 */
	public function notifyRecipients($emails,$content,$subject) {
	
		//creamos el mensaje multipart
		$message = $this->createNotifyMessage($content,$subject);

		require_once('EmailManagement.php');
		
		$manager = new EmailManagement();

		//creamos una lista de multiples recipientes
		$recipientList = $manager->createMultipleRecipientsList($emails);
		
		$status = $this->sendMessage($recipientList,$message);
		
		return $status;
		
	}
	
	
	/**
	 * Regenera el codigo de acceso para un supplier.
	 * @return boolean
	 */
	public function regenerateSupplierAccessToken() {
		
		try {
			$this->setSupplierAccessToken(SupplierQuotePeer::generateRandomSupplierAccessCode());
			$this->save();
			
		} catch (PropelException $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Confirma una cotizacion de proveedor
	 * @return boolean
	 */
	public function confirm() {

		try {
			$this->setStatus(SupplierQuote::STATUS_QUOTED);
			$this->save();
			$this->saveCurrentStatusOnHistory();
			

			//la cotizacion de cliente relacionada pasa a waiting for pricing			
			$clientQuote = $this->getClientQuote();
			
			$clientQuote->setStatus(ClientQuote::STATUS_WAITING_FOR_PRICING);
			$clientQuote->save();
			$clientQuote->saveCurrentStatusOnHistory();
			
						
		} catch (PropelException $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Indica si la cotizacion se encuentra confirmada
	 * @return boolean
	 */
	public function isConfirmed() {
		return ($this->getStatus() == SupplierQuote::STATUS_QUOTED);
	}	

	/**
	 * Saves the current status of the instance in his history
	 * @return boolean
	 */
	public function saveCurrentStatusOnHistory() {
		
		require_once('SupplierQuoteHistory.php');
		
		try {

			$supplierQuoteHistory = new SupplierQuoteHistory();
			$supplierQuoteHistory->setSupplierQuote($this);
			$supplierQuoteHistory->setStatus($this->getStatus());
			$supplierQuoteHistory->setCreatedAt(time());
			$supplierQuoteHistory->save();
			
		} catch (Exception $e) {
			return false;
		}
		
		return true;
	}	

	/**
	 * Devuelve un array con los nombres de los distintos mensajes de status para el afiliado/cliente
	 * @return array
	 */	
	public function getStatusNames() {
		return $this->statusNames2;
	}
	
	/**
	 * Indica si la cotizacion se encuentra en espera de respuesta por negociacion
	 * @return boolean
	 */
	public function isOnFeedback() {
		return ($this->getStatus() == SupplierQuote::STATUS_FEEDBACK);
	}
	
	public function hasItemsOnFeedback() {
		$items = $this->getSupplierQuoteItems();
		foreach ($items as $item) {
			if ($item->isOnFeedback()) {
				return true;
			}
		}
		
		return false;
	}	

} // SupplierQuote
