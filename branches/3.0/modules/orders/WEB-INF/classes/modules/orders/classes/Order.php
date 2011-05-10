<?php

/**
 * Skeleton subclass for representing a row from the 'orders_order' table.
 *
 * Orders
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.orders.classes
 */
class Order extends BaseOrder {

	/**
	* Obtiene el nombre traducido el estado del order.
	*
	* @return string nombre del estado del order
	*/
	function getStateName() {
		$status = $this->getState();
		$orderStatus = OrderPeer::getOrderStatusTranslated();
		$orderStatusTranslated = $orderStatus[$status];
		return $orderStatusTranslated;
	}


	/**
	 * Agrega un Item a la Orden de Pedido
	 *
	 *
	 *
	 */
	function addItem ($productCode, $price, $quantity) {

		//regla de negocio
		// la cantidad de items debe ser mayor que cero
	 if ($quantity <= 0)
			return false;

		try {
			$item = OrderItemPeer::create($this->getId(),$productCode,$price,$quantity);
		}
		catch(PropelException $exp) {
			return false;
		}

		//se agrego satisfactoriamente
		$total = $this->getTotal();
		$this->setTotal($total + ($price * $quantity));

		try {
			$this->save();
		}
		catch (PropelException $exp){
			return false;
		}

		return $item;
	}

	/**
	 * Eelimina un Item a la Orden de Pedido
	 *
	 */
	function deleteItem($itemId) {

		$item = OrderItemPeer::get($itemId);
		$oldQuantity = $item->getQuantity();
		$oldPrice = $item->getPrice();

		if (!OrderItemPeer::delete($itemId))
			return false;

		$total = $this->getTotal();
		$this->setTotal($total - ($oldQuantity * $oldPrice));

		$this->save();

		return true;
	}

	/**
	 * Actualiza la cantidad de un Item de la Orden de Pedido
	 *
	 */
	function updateQuantityItem($itemId,$quantity) {

		$item = OrderItemPeer::get($itemId);
		$oldQuantity = $item->getQuantity();
		$price = $item->getPrice();

		$item->setQuantity($quantity);
		try {
			$item->save();
		} catch (PropelException $exp) {
			return false;
		}

		$total = $this->getTotal() - ($oldQuantity * $price) + ($quantity * $price);
		$this->setTotal($total);

		try {
			$this->save();
		} catch (PropelException $exp) {
			return false;
		}

		return true;

	}

	/**
	 * Devuelve la fecha en la que fue Creada la Order
	 *
	 */
	function getDateCreated() {

		$date = getdate(strtotime($this->getCreated()));
		return  $date['year'] . "-" . $date['mon'] . "-" . $date['mday'];

	}
	/*
	 * Permite modificar la fecha en la que fue modificada la orden
	 *
	 */
	function setDateCreated($date) {

		//$date = new DateTime($date);
		//$dateTimeString = $date->format('Y-m-d H:i:s');
		$this->setCreated($date);

		try {
			$this->save();
		}
		catch (PropelException $exp) {
			return false;
		}

		return true;
	}

	/*
	 * Obtiene los items ordenados por el codigo de ordenamiento de los productos.
	 *
	 */
	function getOrderItemsOrderByProductOrderCode() {
		$criteria =  new Criteria();
		$criteria->addJoin(OrderItemPeer::PRODUCTID,ProductPeer::ID);
		$criteria->addAscendingOrderByColumn(ProductPeer::ORDERCODE);
		return $this->getOrderItems($criteria);
	}

	/*
	 * Obtiene el último comentario de una orden
	 *
	 */
	function getLastComment() {
		$criteria =  new Criteria();
		$criteria->add(OrderStateChangePeer::ORDERID,$this->getId(),Criteria::EQUAL);
		$criteria->add(OrderStateChangePeer::STATE,OrderPeer::STATE_EXPORTED,Criteria::NOT_EQUAL);
		$criteria->addDescendingOrderByColumn(OrderStateChangePeer::CREATED);
		$commentObj = OrderStateChangePeer::doSelectOne($criteria);
		return $commentObj;

	}

}
