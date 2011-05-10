<?php

require_once('import/classes/ClientQuoteHistory.php');
require_once('import/classes/ClientQuoteHistoryPeer.php');
require_once 'import/classes/om/BaseClientQuote.php';


/**
 * Skeleton subclass for representing a row from the 'import_clientQuote' table.
 *
 * Cotizacion a Cliente
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
class ClientQuote extends BaseClientQuote {

	//estados internos del objeto
	const STATUS_NEW = 1;
	const STATUS_SUPPLIER_QUOTE_REQUESTED = 2;
	const STATUS_WAITING_FOR_PRICING = 3;
	const STATUS_PARTIALLY_QUOTED = 4;
	const STATUS_QUOTED = 5;
	const STATUS_ACCEPTED = 6;
	const STATUS_PARTIALLY_ACCEPTED = 7;
	const STATUS_REJECTED = 8;
	
	//nombre de los estados para los clientes
	private $statusNamesClient = array(
								ClientQuote::STATUS_NEW => 'New',
								ClientQuote::STATUS_SUPPLIER_QUOTE_REQUESTED => 'In Progress',
								ClientQuote::STATUS_WAITING_FOR_PRICING => 'In Progress',
								ClientQuote::STATUS_PARTIALLY_QUOTED => 'Partially Quoted',
								ClientQuote::STATUS_QUOTED => 'Quoted',
								ClientQuote::STATUS_ACCEPTED => 'Accepted',
								ClientQuote::STATUS_PARTIALLY_ACCEPTED => 'Partially Accepted',
								ClientQuote::STATUS_REJECTED => 'Rejected'								
							);

	//nombre de los estados para los administradores
	private $statusNamesAdmin = array(
								ClientQuote::STATUS_NEW => 'New',
								ClientQuote::STATUS_SUPPLIER_QUOTE_REQUESTED => 'Quote Requested',
								ClientQuote::STATUS_WAITING_FOR_PRICING => 'Waiting For Pricing',
								ClientQuote::STATUS_PARTIALLY_QUOTED => 'Waiting For Pricing',
								ClientQuote::STATUS_QUOTED => 'Quoted',
								ClientQuote::STATUS_ACCEPTED => 'Accepted',
								ClientQuote::STATUS_PARTIALLY_ACCEPTED => 'Partially Accepted',
								ClientQuote::STATUS_REJECTED => 'Rejected'
							);							

	/**
	 * Devuelve un array con los nombres de los distintos mensajes de status para el afiliado/cliente
	 * @return array
	 */	
	public function getStatusNamesClient() {
		return $this->statusNamesClient;
	}

	/**
	 * Devuelve un array con los nombres de los distintos mensajes de status para el adminstrador
	 * @return array
	 */
	public function getStatusNamesAdmin() {
		return $this->statusNamesAdmin;
	}
	
	
	/**
	 * El cliente confirma que el contenido de la cotizacion esta listo para ser cotizado por anmaga.
	 * Internamente la cotizacion para de estado NEW a estado Waiting For Response
	 * @return boolean
	 */
	public function clientConfirm() {
		
		try {

			if ($this->getStatus() != ClientQuote::STATUS_NEW) {
				return false;
			}

			$this->setStatus(ClientQuote::STATUS_SUPPLIER_QUOTE_REQUESTED);
			$this->save();
			
			$this->saveCurrentStatusOnHistory();
			
		} catch (PropelException $e) {
			return false;
		}
		
		return true;
		
	}

	/**
	 * El cliente cierra la cotizacion, confirmando sus precioas al cliente .
	 * Internamente la cotizacion pasa al estado QUOTED
	 * @return boolean
	 */
	public function close() {
		
		try {

			if ($this->getStatus() != ClientQuote::STATUS_PARTIALLY_QUOTED) {
				return false;
			}

			$this->setStatus(ClientQuote::STATUS_QUOTED);
			$this->save();
			
			$this->saveCurrentStatusOnHistory();
			
		} catch (PropelException $e) {
			return false;
		}
		
		return true;
		
	}
	
	/**
	 * Indica si la cotizacion se encuentra en espera de respuesta.
	 * @return boolean
	 */
	public function isWaitingResponse() {
		return (($this->getStatus() == ClientQuote::STATUS_SUPPLIER_QUOTE_REQUESTED) ||($this->getStatus() == ClientQuote::STATUS_WAITING_FOR_PRICING) || ($this->getStatus() == ClientQuote::STATUS_PARTIALLY_QUOTED));
	}

	/**
	 * Indica si la cotizacion se encuentra recien creada.
	 * @return boolean
	 */
	public function isNewStatus() {
		return ($this->getStatus() == ClientQuote::STATUS_NEW);
	}

	/**
	 * Indica si la cotizacion se encuentra contestada parcialmente.
	 * @return boolean
	 */
	public function isPartiallyQuoted() {
		return ($this->getStatus() == ClientQuote::STATUS_PARTIALLY_QUOTED);
	}

	
	/**
	 * Devuelve el nombre del status actual de la cotizacion para un administrador
	 * @return string
	 */
	public function getStatusNameAdmin() {
		$statusArray = ClientQuotePeer::getStatusNamesAdmin2();
		return $statusArray[$this->getStatus()];
	}

	/**
	 * Devuelve el nombre del status actual de la cotizacion para un cliente
	 * @return string
	 */
	public function getStatusNameClient() {
		$statusArray = ClientQuotePeer::getStatusNamesAffiliate2();
		return $statusArray[$this->getStatus()];
	}	

	/**
	 * Obtiene un cierto elemento de la cotizacion
	 * @param integer $id id del elemento a obtener
	 */
	public function getClientQuoteItem($id) {
		$criteria = new Criteria();
		$criteria->add(ClientQuoteItemPeer::CLIENTQUOTEID,$this->getId());
		$criteria->add(ClientQuoteItemPeer::ID,$id);
		
		$result = $this->getClientQuoteItems($criteria);
		return $result[0];
	}
	
	/**
	 * Saves the current status of the instance in his history
	 * @return boolean
	 */
	public function saveCurrentStatusOnHistory() {
		
		require_once('ClientQuoteHistory.php');
		
		try {

			$clientQuoteHistory = new ClientQuoteHistory();
			$clientQuoteHistory->setClientQuote($this);
			$clientQuoteHistory->setStatus($this->getStatus());
			$clientQuoteHistory->setCreatedAt(time());
			$clientQuoteHistory->save();
			
		} catch (Exception $e) {
			return false;
		}
		
		return true;
	}

	/**
	 * Indica si la cotizacion se encuentra cerrada
	 * @return boolean
	 */
	public function isQuoted() {
		return ($this->getStatus() == ClientQuote::STATUS_QUOTED);
	}

	/**
	 * Indica si la cotizacion se encuentra rechazada
	 * @return boolean
	 */
	public function isRejected() {
		return ($this->getStatus() == ClientQuote::STATUS_REJECTED);
	}


	/**
	 * Indica si la cotizacion se encuentra aceptada
	 * @return boolean
	 */
	public function isAccepted() {
		return ($this->getStatus() == ClientQuote::STATUS_ACCEPTED);
	}
	
	/**
	 * Indica si la cotizacion se encuentra parcialmente aceptada
	 * @return boolean
	 */
	public function isPartiallyAccepted() {
		return ($this->getStatus() == ClientQuote::STATUS_PARTIALLY_ACCEPTED);
	}	
	
	/**
	 * Obtiene aquellos items de la orden
	 * que un cierto proveedor tiene disponibles
	 * @param Supplier $supplier instancia de proveedor
	 * @return array
	 */
	public function getClientQuoteItemsBySupplier($supplier) {
		
		require_once('ClientQuoteItemPeer.php');
		
		$criteria = new Criteria();
		$criteria->addJoin(ClientQuoteItemPeer::PRODUCTID,ProductSupplierPeer::PRODUCTID,Criteria::INNER_JOIN);
		$criteria->add(ClientQuoteItemPeer::CLIENTQUOTEID,$this->getId());
		$criteria->add(ProductSupplierPeer::SUPPLIERID,$supplier->getId());

		return ClientQuoteItemPeer::doSelect($criteria);
		
	}
	
	/**
	 * Obtiene los proveedores que estan relacionados a los productos que tiene la cotizacion
	 * @return array array de instancias de supplier
	 */
	public function getProductRelatedSuppliers() {
		
		require_once('SupplierPeer.php');
		
		$criteria = new Criteria();
		$criteria->addJoin(SupplierPeer::ID,ProductSupplierPeer::SUPPLIERID,Criteria::INNER_JOIN);
		$criteria->addJoin(ProductSupplierPeer::PRODUCTID,ClientQuoteItemPeer::PRODUCTID,Criteria::INNER_JOIN);
		$criteria->add(ClientQuoteItemPeer::CLIENTQUOTEID,$this->getId());
		$criteria->setDistinct();
		
		return SupplierPeer::doSelect($criteria);
	}
	
	/**
	 * crea una clientPurchaseOrder
	 * @param array $items array de instancias de ClientQuoteItem
	 * @param AffiliateUser $affiliateUser usuario afiliado que crea la instancia (si es el caso)
	 * @param User $user usuario administrador que crea la instancia (si es el caso)
	 * @return ClientPurchaseOrder
	 */
	private function buildClientPurchaseOrder($items,$affiliateUser='',$user='') {
	
		require_once('ClientPurchaseOrder.php');
		require_once('ClientPurchaseOrderItem.php');
		
		$clientPurchaseOrder = new ClientPurchaseOrder();
		$clientPurchaseOrder->setCreatedAt(time());
		$clientPurchaseOrder->setStatus(ClientPurchaseOrder::STATUS_ORDERED_TO_SUPPLIER);
		$clientPurchaseOrder->setClientQuote($this);
		$clientPurchaseOrder->setAffiliateId($this->getAffiliateId());

		if (!empty($affiliateUser)) {
			$clientPurchaseOrder->setAffiliateUser($affiliateUser);
		}
		
		if (!empty($user)) {
			$clientPurchaseOrder->setUser($user);
		}
		
		foreach ($items as $item) {
			$clientPurchaseOrderItem = new ClientPurchaseOrderItem();
			$clientPurchaseOrderItem->setProductId($item->getProductId());
			$clientPurchaseOrderItem->setQuantity($item->getQuantity());
			$clientPurchaseOrderItem->setPrice($item->getPrice());
			$clientPurchaseOrder->addClientPurchaseOrderItem($clientPurchaseOrderItem);
		}
		
		return $clientPurchaseOrder;
	
	}
	
	/**
	 * crea una supplierPurchaseOrder
	 * @param array $items array de instancias de ClientQuoteItem
	 * @param AffiliateUser $affiliateUser usuario afiliado que crea la instancia (si es el caso)
	 * @param User $user usuario administrador que crea la instancia (si es el caso)
	 * @return ClientPurchaseOrder
	 */
	private function buildSupplierPurchaseOrders($items,$affiliateUser='',$user='') {
	
		require_once('SupplierPurchaseOrder.php');
		require_once('SupplierPurchaseOrderItem.php');
		require_once('SupplierQuotePeer.php');

		$supplierItemsSorted = array();
		
		foreach ($items as $item) {
			$supplierItem = $item->getSupplierQuoteItem();
			$supplierItem->setQuantity($item->getQuantity());
			if (!isset($supplierItemsSorted[$supplierItem->getSupplierQuoteId()])) {
				$supplierItemsSorted[$supplierItem->getSupplierQuoteId()] = array();
			}
			array_push($supplierItemsSorted[$supplierItem->getSupplierQuoteId()],$supplierItem);
		}
		
		$supplierPurchaseOrders = array();
		
		foreach ($supplierItemsSorted as $supplierQuoteId => $supplierItems) {

			$supplierQuote = SupplierQuotePeer::get($supplierQuoteId);

			$supplierPurchaseOrder = new SupplierPurchaseOrder();
			$supplierPurchaseOrder->setCreatedAt(time());
			$supplierPurchaseOrder->setSupplierId($supplierQuote->getSupplierId());
			$supplierPurchaseOrder->setStatus(SupplierPurchaseOrder::STATUS_FABRICATION_NON_INITIATED);
			$supplierPurchaseOrder->setSupplierQuoteId($supplierQuote);
			$supplierPurchaseOrder->setClientQuoteId($this);
			$supplierPurchaseOrder->setAffiliateId($this->getAffiliateId());

			if (!empty($affiliateUser)) {
				$supplierPurchaseOrder->setAffiliateUser($affiliateUser);
			}

			if (!empty($user)) {
				$supplierPurchaseOrder->setUser($user);
			}

			foreach ($supplierItems as $supplierItem) {

				$supplierPurchaseOrderItem = new SupplierPurchaseOrderItem();
				$supplierPurchaseOrderItem->setProductId($supplierItem->getProductId());
				$supplierPurchaseOrderItem->setQuantity($supplierItem->getQuantity());
				$supplierPurchaseOrderItem->setPortId($supplierItem->getPortId());
				$supplierPurchaseOrderItem->setIncotermId($supplierItem->getIncotermId());
				$supplierPurchaseOrderItem->setPrice($supplierItem->getPrice());
				$supplierPurchaseOrderItem->setDelivery($supplierItem->getDelivery());
				$supplierPurchaseOrderItem->setPackage($supplierItem->getPackage());
				$supplierPurchaseOrderItem->setUnitLength($supplierItem->getUnitLength());
				$supplierPurchaseOrderItem->setUnitWidth($supplierItem->getUnitWidth());
				$supplierPurchaseOrderItem->setUnitHeight($supplierItem->getUnitHeight());
				$supplierPurchaseOrderItem->setUnitGrossWeigth($supplierItem->getUnitGrossWeigth());
				$supplierPurchaseOrderItem->setUnitsPerCarton($supplierItem->getUnitsPerCarton());
				$supplierPurchaseOrderItem->setCartons($supplierItem->getCartons());
				$supplierPurchaseOrderItem->setCartonLength($supplierItem->getCartonLength());
				$supplierPurchaseOrderItem->setCartonWidth($supplierItem->getCartonWidth());
				$supplierPurchaseOrderItem->setCartonHeight($supplierItem->getCartonHeight());
				$supplierPurchaseOrderItem->setCartonGrossWeigth($supplierItem->getCartonGrossWeigth());																																	
				$supplierPurchaseOrder->addSupplierPurchaseOrderItem($supplierPurchaseOrderItem);
			}
			
			array_push($supplierPurchaseOrders,$supplierPurchaseOrder);
			
		}
	
		
		return $supplierPurchaseOrders;
	
	}	
	
	
	/**
	 * Factory Method que genera una ClientPurchaseOrder Relacionada a la Cotizacion
	 * @param array $items array de instancias de ClientQuoteItem
	 * @param AffiliateUser $affiliateUser usuario afiliado que crea la instancia (si es el caso)
	 * @param User $user usuario administrador que crea la instancia (si es el caso)
	 * @return ClientPurchaseOrder
	 */
	public function createClientPurchaseOrder($items,$affiliateUser='',$user='') {
		
		try {
			
			//generacion de pedido del cliente
			$clientPurchaseOrder = $this->buildClientPurchaseOrder($items,$affiliateUser,$user);
			$clientPurchaseOrder->save();
			$clientPurchaseOrder->saveCurrentStatusOnHistory();
			
			$supplierPurchaseOrders = $this->buildSupplierPurchaseOrders($items,$affiliateUser,$user);

			//generacion de los pedidios a los distintos proveedores
			foreach ($supplierPurchaseOrders as $supplierPurchaseOrder) {
				$supplierPurchaseOrder->save();
				$supplierPurchaseOrder->saveCurrentStatusOnHistory();
			}
			
			//cambiamos el status de la clientQuote
			
			if (count($items) == $this->countClientQuoteItems()) {
				$this->setStatus(ClientQuote::STATUS_ACCEPTED);
			}
			else {
				$this->setStatus(ClientQuote::STATUS_PARTIALLY_ACCEPTED);
			}
			
			$this->save();
			$this->saveCurrentStatusOnHistory();

			
		} catch (PropelException $e) {
			return false;
		}

		return $clientPurchaseOrder;
		
	}

	/**
	 * Rechaza la totalidad de la cotizacion
	 * @return boolean
	 */
	public function reject() {

		try {
			$this->setStatus(ClientQuote::STATUS_REJECTED);
			$this->save();
			$this->saveCurrentStatusOnHistory();
		} catch (PropelException $e) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Indicates if the quote has a certain Product
	 * @param $product Product
	 * @return boolean
	 */
	public function hasProduct($product) {
		
		$items = $this->getClientQuoteItems();
		foreach ($items as $item) {
			if ($item->getProductId() == $product->getId()) {
				return true;
			}
		}
		return false;
		
	}


	/**
	 * Indicates if the quote has a certain Product
	 * @param $product Product
	 * @return boolean
	 */
	public function getAffiliateName() {
		
		$affiliateId = $this->getAffiliateId();
		$affiliate = AffiliatePeer::get($affiliateId);
		return $affiliate->getName();
		
	}
	
} // ClientQuote
