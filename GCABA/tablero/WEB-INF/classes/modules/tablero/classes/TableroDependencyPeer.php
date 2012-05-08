<?php

/**
 * Dependencias.
 *
 * @package tablero
 */
class TableroDependencyPeer extends AffiliatePeer {

	public static function getOMClass($withPrefix = true)
	{
		return "TableroDependency";
	}

	/** the default item name for this class */
	const ITEM_NAME = 'Dependencies';

  public static function doSelectJoinMilestone(Criteria $c, $con = null) {

		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		$startcol = 0;

		//agregamos las columnas de milestone
		TableroMilestonePeer::addSelectColumns($c);
		$startcol2 = (TableroMilestonePeer::NUM_COLUMNS - TableroMilestonePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		// agregamos las columnas de Projecto
		TableroProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TableroProjectPeer::NUM_COLUMNS - TableroProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para dependencia
		AffiliatePeer::addSelectColumns($c);

		$c->addJoin(AffiliatePeer::ID,TableroObjectivePeer::AFFILIATEID,  Criteria::LEFT_JOIN);
		$c->addJoin(TableroObjectivePeer::ID, TableroProjectPeer::OBJECTIVEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroProjectPeer::ID, TableroMilestonePeer::PROJECTID, Criteria::LEFT_JOIN);

		$rs = BasePeer::doSelect($c, $con);

		$results = array();

		$milestones = array();
		$projects = array();
		$objectives = array();
		$affiliates = array();

		while($rs->next()) {

			//Hidratamos el Objeto Milestone
			$omClass = TableroMilestonePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$milestone = new $cls();
			$milestone->hydrate($rs);

			// Hidratamos el Objeto Project
			$omClass = TableroProjectPeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$project = new $cls();
			$project->hydrate($rs, $startcol2);

			// Hidratamos el Objeto Objective
			$omClass = TableroObjectivePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$objective = new $cls();
			$objective->hydrate($rs, $startcol3);

			// Hidratamos el Objeto Affiliate
			$omClass = AffiliatePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$affiliate = new $cls();
			$affiliate->hydrate($rs, $startcol4);

			//armamos las relaciones a la inversa

			if (in_array($milestone->getId(),array_keys($milestones))) {
				//recupero la referencia
				$milestone = $milestones[$milestone->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$milestones[$milestone->getId()] =& $milestone;
			}

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

			if (in_array($affiliate->getId(),array_keys($affiliate))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones
			$objective->setAffiliate($affiliate);
			$project->setObjective($objective);
			$milestone->setProject($project);

			//y las inversas
			$affiliate->addObjective($objective);
			$objective->addProject($project);
			$project->addMilestone($milestone);

		}
		return $affiliates;
	}


  public static function doSelectJoinIndicator(Criteria $c, $con = null) {

		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		$startcol = 0;

		//agregamos las columnas de indicator
		TableroIndicatorPeer::addSelectColumns($c);
		$startcol2 = (TableroIndicatorPeer::NUM_COLUMNS - TableroIndicatorPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		// agregamos las columnas de Projecto
		TableroProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TableroProjectPeer::NUM_COLUMNS - TableroProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para dependencia
		AffiliatePeer::addSelectColumns($c);

		$c->addJoin(AffiliatePeer::ID, TableroObjectivePeer::AFFILIATEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroObjectivePeer::ID, TableroProjectPeer::OBJECTIVEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID, Criteria::LEFT_JOIN);

		$rs = BasePeer::doSelect($c, $con);

		$results = array();

		$indicators = array();
		$projects = array();
		$objectives = array();
		$affiliates = array();

		while($rs->next()) {

			//Hidratamos el Objeto Indicator
			$omClass = TableroIndicatorPeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$indicator = new $cls();
			$indicator->hydrate($rs);

			// Hidratamos el Objeto Project
			$omClass = TableroProjectPeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$project = new $cls();
			$project->hydrate($rs, $startcol2);

			// Hidratamos el Objeto Objective
			$omClass = TableroObjectivePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$objective = new $cls();
			$objective->hydrate($rs, $startcol3);

			// Hidratamos el Objeto Affiliate
			$omClass = AffiliatePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$affiliate = new $cls();
			$affiliate->hydrate($rs, $startcol4);

			//armamos las relaciones a la inversa

			if (in_array($indicator->getId(),array_keys($indicators))) {
				//recupero la referencia
				$indicator = $indicators[$indicator->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$indicators[$indicator->getId()] =& $indicator;
			}

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

			if (in_array($affiliate->getId(),array_keys($affiliate))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones
			$objective->setAffiliate($affiliate);
			$project->setObjective($objective);
			$indicator->setProject($project);

			//y las inversas

			$affiliate->addObjective($objective);
			$objective->addProject($project);
			$project->addIndicator($indicator);

		}
		return $affiliates;
	}

	public static function doSelectJoinIndicatorMilestone(Criteria $c, $con = null) {

		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		$startcol = 0;
		//agregamos las columnas de milestone
		TableroMilestonePeer::addSelectColumns($c);
		$startcol1 = (TableroMilestonePeer::NUM_COLUMNS - TableroMilestonePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		//agregamos las columnas de milestone
		TableroIndicatorPeer::addSelectColumns($c);
		$startcol2 = $startcol1 + (TableroIndicatorPeer::NUM_COLUMNS - TableroIndicatorPeer::NUM_LAZY_LOAD_COLUMNS);
		// agregamos las columnas de Projecto
		TableroProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TableroProjectPeer::NUM_COLUMNS - TableroProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para dependencia
		AffiliatePeer::addSelectColumns($c);

		$c->addJoin(AffiliatePeer::ID, TableroObjectivePeer::AFFILIATEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroObjectivePeer::ID, TableroProjectPeer::OBJECTIVEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroProjectPeer::ID,TableroIndicatorPeer::PROJECTID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroProjectPeer::ID,TableroMilestonePeer::PROJECTID, Criteria::LEFT_JOIN);

		$stmt = BasePeer::doSelect($c, $con);

		$results = array();

		$milestones = array();
		$indicators = array();
		$projects = array();
		$objectives = array();
		$affiliates = array();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {

			//Hidratamos el Objeto Milestone
			$omClass = TableroMilestonePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			try {
				$milestone = new $cls();
				$milestone->hydrate($rs);
			}
			catch( PropelException $exp) {
				$milestone = null;
			}
			//Hidratamos el Objeto Indicator
			$omClass = TableroIndicatorPeer::getOMClass();
			$cls = Propel::importClass($omClass);

			try {
				$indicator = new $cls();
				$indicator->hydrate($rs, $startcol1);
			}
			catch (PropelException $exp) {
				$indicator = null;
			}

			// Hidratamos el Objeto Project
			$omClass = TableroProjectPeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$project = new $cls();
			$project->hydrate($rs, $startcol2);

			// Hidratamos el Objeto Objective
			$omClass = TableroObjectivePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$objective = new $cls();
			$objective->hydrate($rs, $startcol3);

			// Hidratamos el Objeto Affiliate
			$omClass = AffiliatePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$affiliate = new $cls();
			$affiliate->hydrate($rs, $startcol4);

			//armamos las relaciones a la inversa
			if ($milestone != null) {
				if (in_array($milestone->getId(),array_keys($milestones))) {
					//recupero la referencia
					$milestone = $milestones[$milestone->getId()];
				}
				else {
					//no esta en el array
					//guardo una referencia
					$milestones[$milestone->getId()] =& $milestone;
				}
			}
			if ($indicator != null) {
				if (in_array($indicator->getId(),array_keys($indicators))) {
					//recupero la referencia
					$indicator = $indicators[$indicator->getId()];
				}
				else {
					//no esta en el array
					//guardo una referencia
					$indicators[$indicator->getId()] =& $indicator;
				}
			}
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

			if (in_array($affiliate->getId(),array_keys($affiliate))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones
			$objective->setAffiliate($affiliate);
			$project->setTableroObjective($objective);
			if ($indicator != null)
				$indicator->setTableroProject($project);
			if ($milestone != null)
				$milestone->setTableroProject($project);

			//y las inversas
			$affiliate->addTableroObjective($objective);
			$objective->addTableroProject($project);
			if ($indicator != null)
				$project->addTableroIndicator($indicator);
			if ($milestone != null)
				$project->addTableroMilestone($milestone);
		}
		return $affiliates;
	}

  public static function doSelectJoinProject(Criteria $c, $con = null) {

		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		$startcol2 = 0;
		// agregamos las columnas de Projecto
		TableroProjectPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TableroProjectPeer::NUM_COLUMNS - TableroProjectPeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS);

		// agregamos la columnas para dependencia
		AffiliatePeer::addSelectColumns($c);

		$c->addJoin(AffiliatePeer::ID,TableroObjectivePeer::AFFILIATEID, Criteria::LEFT_JOIN);
		$c->addJoin(TableroObjectivePeer::ID, TableroProjectPeer::OBJECTIVEID, Criteria::LEFT_JOIN);


		//$stmt = AffiliatePeer::doSelectStmt($c, $con);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		$projects = array();
		$objectives = array();
		$affiliates = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AffiliatePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($affiliate = AffiliatePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$cls = AffiliatePeer::getOMClass(false);

				$affiliate = new $cls();
				$affiliate->hydrate($row);
				AffiliatePeer::addInstanceToPool($affiliate, $key1);
			} // if $obj1 already loaded



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

			if (in_array($affiliate->getId(),array_keys($affiliate))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones

			$objective->setAffiliate($affiliate);
			$project->setTableroObjective($objective);


			//y las inversas

			$affiliate->addTableroObjective($objective);
			$objective->addTableroProject($project);

		}
		$stmt->closeCursor();

		return $affiliates;


		$projects = TableroProjectPeer::populateObjects($stmt);
		$objectives = TableroObjectivePeer::populateObjects($stmt);
		$affiliates = AffiliatePeer::populateObjects($stmt);

		$results = array();

		$projects = array();
		$objectives = array();
		$affiliates = array();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {


			// Hidratamos el Objeto Project
			$omClass = TableroProjectPeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$project = new $cls();
			$project->hydrate($stmt);

			// Hidratamos el Objeto Objective
			$omClass = TableroObjectivePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$objective = new $cls();
			$objective->hydrate($stmt, $startcol3);

			// Hidratamos el Objeto Affiliate
			$omClass = AffiliatePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$affiliate = new $cls();
			$affiliate->hydrate($stmt, $startcol4);

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

			if (in_array($affiliate->getId(),array_keys($affiliate))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones
			$objective->setAffiliate($affiliate);
			$project->setObjective($objective);

			//y las inversas
			$affiliate->addObjective($objective);
			$objective->addProject($project);

		}
		return $affiliates;
	}

  public static function doSelectJoinObjective(Criteria $c, $con = null) {

		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		$startcol3 = 0;

		// agregamos la columnas para Objective
		TableroObjectivePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TableroObjectivePeer::NUM_COLUMNS - TableroObjectivePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		// agregamos la columnas para dependencia
		AffiliatePeer::addSelectColumns($c);

		$c->addJoin(AffiliatePeer::ID, TableroObjectivePeer::AFFILIATEID, Criteria::LEFT_JOIN);

		$stmt = BasePeer::doSelect($c, $con);

		$results = array();

		$objectives = array();
		$affiliates = array();

		while($row = $stmt->fetch(PDO::FETCH_NUM)) {


			// Hidratamos el Objeto Objective
			$omClass = TableroObjectivePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$objective = new $cls();
			$objective->hydrate($rs);

			// Hidratamos el Objeto Affiliate
			$omClass = AffiliatePeer::getOMClass();

			$cls = Propel::importClass($omClass);
			$affiliate = new $cls();
			$affiliate->hydrate($rs, $startcol4);
			//armamos las relaciones a la inversa

			if (in_array($objective->getId(),array_keys($objectives))) {
				//recupero la referencia
				$objective = $objectives[$objective->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$objectives[$objective->getId()] =& $objective;
			}

			if (in_array($affiliate->getId(),array_keys($affiliates))) {
				//recupero la referencia
				$affiliate = $affiliates[$affiliate->getId()];
			}
			else {
				//no esta en el array
				//guardo una referencia
				$affiliates[$affiliate->getId()] =& $affiliate;
			}

			//establezco las relaciones
			$objective->setAffiliate($affiliate);

			//y las inversas
			$affiliate->addObjective($objective);

		}

		return $affiliates;

	}



} // DependencyPeer
