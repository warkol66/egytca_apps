<?php

require_once ('affiliates/classes/Affiliate.php');

/**
 * Dependencia.
 *
 * @package tablero
 */
class TableroDependency extends Affiliate {

	/** the default item name for this class */
	const ITEM_NAME = 'Dependency';

	function getOwner() {
		require_once("AffiliateUserPeer.php");
		return AffiliateUserPeer::get($this->getOwnerId());
	}


	//mapea un status a la llamada del metodo que indica que estado tiene
	 private $objectiveStatus = array(
						'delayed'=>'isDelayed',
						'ended'=>'isEnded',
						'working'=>'isOnWork',
						'OnTime'=>'isOnTime',
						'Delayed'=>'isDelayed2',
						'Late'=>'isLate'
		);


	function statusColor() {
		global $system;
		$colors = $system["config"]["tablero"]["colors"];
		if ($this->isOnTime())
			return $colors["onTime"];
		if ($this->isDelayed2())
			return $colors["delayed"];
		if ($this->isLate())
			return $colors["late"];
	}

	function isOnTime() {
		return ($this->getCountObjectivesDelayed() == 0 && $this->getCountObjectivesLate() == 0);
	}

	function isDelayed2() {
		return ($this->getCountObjectivesDelayed() != 0 && $this->getCountObjectivesLate() == 0);
	}

	function isLate() {
		return ($this->getCountObjectivesLate() != 0);
	}

	private function countNumberObjectives($status) {

		//busco la llamada a hacer
		$method = $this->objectiveStatus[$status];

		$count = 0;

		foreach ($this->getTableroObjectives() as $objective) {
			if ($objective->$method())
				$count++;
		}

		return $count;

	}

	private function getObjectivesByStatus($status) {

		//busco la llamada a hacer
		$method = $this->objectiveStatus[$status];

		$objectives = array(); //objetivos a devolver

		foreach ($this->getObjectives() as $objective) {
			if ($objective->$method())
				$objectives[] = $objective;
		}

		return $objectives;

	}

	/**
	* Obtiene la cantidad de objetivos en tiempo de la dependencia. Los objetivos en tiempo son los que poseen a todos sus proyectos en tiempo.
	*
	* @return int Cantidad de objetivos en tiempo.
	*/
	function getCountObjectivesOnTime() {
		return $this->countNumberObjectives('OnTime');
	}

	/**
	* Obtiene la cantidad de objetivos retrazados de la dependencia. Los objetivos retrazados son los que poseen algunos de sus proyectos retrazados y ninguno demorado.
	*
	* @return int Cantidad de objetivos retrazados.
	*/
	function getCountObjectivesDelayed() {
		return $this->countNumberObjectives('Delayed');
	}

	/**
	* Obtiene la cantidad de objetivos demorados de la dependencia. Los objetivos demorados son los que poseen algunos de sus proyectos demorados.
	*
	* @return int Cantidad de objetivos demorados.
	*/
	function getCountObjectivesLate() {
		return $this->countNumberObjectives('Late');
	}

	/**
	* Obtiene los objetivos en tiempo de la dependencia. Los objetivos en tiempo son los que poseen a todos sus proyectos en tiempo.
	*
	* @return array Objetivos en tiempo.
	*/
	function getObjectivesOnTime() {
		return $this->getObjectivesByStatus('OnTime');
	}

	/**
	* Obtiene los objetivos retrazados de la dependencia. Los objetivos retrazados son los que poseen algunos de sus proyectos retrazados y ninguno demorado.
	*
	* @return array Objetivos retrazados.
	*/
	function getObjectivesDelayed() {
		return $this->getObjectivesByStatus('Delayed');
	}

	/**
	* Obtiene los objetivos demorados de la dependencia. Los objetivos demorados son los que poseen algunos de sus proyectos demorados.
	*
	* @return array Objetivos demorados.
	*/
	function getObjectivesLate() {
		return $this->getObjectivesByStatus('Late');
	}


	public function getObjectivesJoinProject() {

		$criteria = new Criteria();
		$criteria->add(TableroObjectivePeer::AFFILIATEID,$this->getId());

		$startcol2 = 0;
		// agregamos las columnas de Projecto
		TableroProjectPeer::addSelectColumns($criteria);
		$startcol3 = $startcol2 + (TableroProjectPeer::NUM_COLUMNS - TableroProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($criteria);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS);

		$criteria->addJoin(TableroObjectivePeer::ID, TableroProjectPeer::OBJECTIVEID, Criteria::LEFT_JOIN);


		//$stmt = AffiliatePeer::doSelectStmt($c, $con);

		$stmt = BasePeer::doSelect($criteria, $con);
		$results = array();


		$projects = array();
		$objectives = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

			$key3 = TableroObjectivePeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key3 !== null) {
				$objective = TableroObjectivePeer::getInstanceFromPool($key3);
				if (!$objective) {

					$cls = TableroObjectivePeer::getOMClass(false);

					$objective = new $cls();
					$objective->hydrate($row, $startcol4);
					TableroObjectivePeer::addInstanceToPool($objective, $key3);
				} // if obj2 already loaded

				// Add the $obj1 (TableroIndicator) to $obj2 (TableroProject)
				//$affiliate->addTableroObjective($objective);

			} // if joined row was not null

			$key2 = TableroProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key2 !== null) {
				$project = TableroProjectPeer::getInstanceFromPool($key2);
				if (!$project) {

					$cls = TableroProjectPeer::getOMClass(false);

					$project = new $cls();
					$project->hydrate($row, $startcol3);
					TableroProjectPeer::addInstanceToPool($project, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (TableroIndicator) to $obj2 (TableroProject)
				//$objective->addTableroProject($project);

			} // if joined row was not null

			//armamos las relaciones a la inversa

			if (in_array($project->getId(),array_keys($projects))) {
				//recupero la referencia
				$project = $projects[$project->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$projects[$project->getId()] =& $project;
			}

			if (in_array($objective->getId(),array_keys($objectives))) {
				//recupero la referencia
				$objective = $objectives[$objective->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$objectives[$objective->getId()] =& $objective;
			}

		//establezco las relaciones

			$objective->setAffiliate($affiliate);
			$project->setTableroObjective($objective);

			//y las inversas

			//$affiliate->addTableroObjective($objective);
			$objective->addTableroProject($project);

		}
		$stmt->closeCursor();

		return $objectives;
	}

} // Dependency
