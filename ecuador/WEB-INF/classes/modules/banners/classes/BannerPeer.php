<?php
/**
 * Skeleton subclass for performing query and update operations on the 'banners_banner' table.
 *
 * Tabla de banners
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    banners
 */
class BannerPeer extends BaseBannerPeer {

	private $byWeight = false;
	private $byOrder = false;

	/**
	 * Aplica ordenamiento por pesos
	 */
	public function setByWeight()

	{
		$this->byWeight = true;
	}

	/**
	 * Aplica ordenamiento por orden
	 */
	public function setByOrder()
	{
		$this->byOrder = true;
	}

	/**
	* Obtiene una cantidad de banners de una zona en forma aleatoria
	*
	* @param int $zoneId Id de la zona
	* @param int $ammount cantida de banners a retornar
	* @return array Informacion de los banners
	*/
	function getRandom($zoneId, $amount)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		$criteria->addAscendingOrderByColumn('RAND()');
		$criteria->setLimit($amount);

		$objects = BannerPeer::doSelect($criteria);
		return $objects;
	}


	/**
	* Obtiene una cantidad de banners de una zona en forma aleatoria
	*
	* @param int $zoneId Id de la zona
	* @param int $ammount cantida de banners a retornar
	* @return array Informacion de los banners
	*/
	function getOrdered($zoneId, $amount)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		$criteria->addAscendingOrderByColumn(BannerZoneRelationPeer::ORDER);
		$criteria->setLimit($amount);

		$objects = BannerPeer::doSelect($criteria);
		return $objects;
	}

	/**
	* Obtiene los banners activos de una zona
	*
	* @param int $zoneId Id de la zona
	* @param array $notInt Id de los banners que no se deben incluir en el resutlado
	* @return array Informacion de los banners
	*/
	function getByZoneForDisplay($zoneId, $notIn = null)
	{
		$criteria = new Criteria();

		// banners activos solamente
		$criteria->add(BannerPeer::ACTIVE, true);

		// banners de la zona a mostrar
		$criteria->addJoin(BannerPeer::ID, BannerZoneRelationPeer::BANNERID, Criteria::INNER_JOIN);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId);

		// que le queden impresiones restantes o de frecuencia permanente
		// que esté dentro del rango de fechas de la campaña

		// permanente
		$criteriOn1 = $criteria->getNewCriterion(BannerPeer::FREQUENCY, Banner::FREQUENCY_PERMANENT);

		// o que le queden impresiones restantes dentro del rango de fechas de la campaña
		$criteriOn2 = $criteria->getNewCriterion(BannerPeer::PRINTSLEFT, 0, Criteria::GREATER_THAN);

		$criteriOn3 = $criteria->getNewCriterion(BannerPeer::CAMPAIGNSTARTDATE, Criteria::CURRENT_DATE, Criteria::LESS_EQUAL);
		$criteriOn3->addAnd($criteria->getNewCriterion(BannerPeer::CAMPAIGNFINALDATE, Criteria::CURRENT_DATE, Criteria::GREATER_EQUAL));

		// Combino los criteriOn
		$criteriOn2->addAnd($criteriOn3);

		$criteriOn1->addOr($criteriOn2);

		$criteria->add($criteriOn1);

		if (! $notIn == null)
			$criteria->add(BannerPeer::ID, $notIn, Criteria::NOT_IN);

		$objects = BannerZoneRelationPeer::doSelect($criteria);
		return $objects;
	}

	/**
	 */
	function getStats($clientId, $zoneId, $zoneId) {

/*
		$c = new Criteria(BannerPeer::DATABASE_NAME);
		BannerPeer::addSelectColumns($c);
		$c->addAsColumn('printsReached', BannerPeer::PRINTSLEFT . ' - ' . BannerPeer::PRINTSTOTAL);
		$c->clearSelectColumns();
		$c->addSelectColumn(BannerPeer::ID);
		$c->addSelectColumn(BannerPeer::NAME);
		$c->addSelectColumn(BannerPeer::PRINTSLEFT);
		$c->addSelectColumn(BannerPeer::PRINTSTOTAL);
		$c->addSelectColumn(BannerZonePeer::BANNERID);
		$c->add(BannerPeer::CLIENTID, $clientId);

		if ( !empty($zoneId) ) {
			$c->add(BannerZonePeer::ZONEID, $zoneId);
			$c->addJoin(BannerZonePeer::BANNERID, BAnnerPeer::ID);
		}
		return BannerPeer::doSelect($c);
		*/

		$allOBj = arraY();
		$c = new Criteria();
		$c->clearSelectColumns();
		$c->addSelectColumn(BannerPeer::ID);
		$c->addSelectColumn(BannerPeer::NAME);
		$c->addSelectColumn(BannerPeer::PRINTSLEFT);
		$c->addSelectColumn(BannerPeer::PRINTSTOTAL);
		$c->addAsColumn('printsReached', BannerPeer::PRINTSTOTAL . ' - ' . BannerPeer::PRINTSLEFT);
		$c->add(BannerPeer::CLIENTID, $clientId);

		$c->addAsColumn('clickthru', 'COUNT('.BannerClickPeer::BANNERID.')');
		$c->addJoin(BannerPeer::ID, BannerClickPeer::BANNERID, Criteria::LEFT_JOIN);
		$c->addGroupByColumn(BannerPeer::ID);
		$c->addGroupByColumn(BannerPeer::NAME);
		$c->addGroupByColumn(BannerPeer::PRINTSLEFT);
		$c->addGroupByColumn(BannerPeer::PRINTSTOTAL);

		$c->addDescendingOrderByColumn('clickthru');

		$stmt = self::doSelectStmt($c);
		$allObj = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $allObj;
	 }

	/**
	 * Retorna los banners de la zona con su correspndiente peso
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByZone($zoneId)
	{
		$criteria = new Criteria();
		$criteria->addJoin(BannerZoneRelationPeer::BANNERID, BannerPeer::ID);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId, Criteria::EQUAL);
		$criteria->addAscendingOrderByColumn(BannerPeer::ID);
		return BannerPeer::doSelect($criteria);

	 }

	/**
	 * Retorna los banners de la zona con su correspndiente peso
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByClient($clientId)
	{
		$criteria = new Criteria();
		$criteria->add(BannerPeer::CLIENTID, $clientId);
		$criteria->addAscendingOrderByColumn(BannerPeer::ID);
		return BannerPeer::doSelect($criteria);

	 }

	/**
	 * Retorna los banners de la zona con su correspondiente peso y orden
	 * @param int $zoneId Id de la zona
	 * @return array Información de los banners para la zona dada
	 */
	function getAllByZoneHydrated($zoneId,$method)
	{
		$criteria = new Criteria();
		$criteria->addJoin(BannerZoneRelationPeer::BANNERID, BannerPeer::ID);
		$criteria->add(BannerZoneRelationPeer::ZONEID, $zoneId, Criteria::EQUAL);
		if ($method=="weight")
			$criteria->addAscendingOrderByColumn(BannerPeer::ID);

		BannerPeer::addSelectColumns($criteria);
		$criteria->addSelectColumn(BannerZoneRelationPeer::WEIGHT);
		$criteria->addSelectColumn(BannerZoneRelationPeer::ORDER);
		if ($method=="order")
			$criteria->addAscendingOrderByColumn(BannerZoneRelationPeer::ORDER);
		$stmt = BannerPeer::doSelectStmt($criteria);

		$banners = Array();

		while ($row = $stmt->fetch()){
			$banner = new Banner();
			$banner->hydrate($row);
			$banner->weight = $row['WEIGHT'];
			$banner->order = $row['ORDER'];
			$banners[] = $banner;
		}
		return $banners;

	 }



} // BannerPeer
