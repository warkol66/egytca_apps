<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_serie' table.
 *
 * Series
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorSeriePeer extends BaseIndicatorSeriePeer {

	/**
	* Crea una serie nueva.
	*
	* @param array $variableParams array asociativo con los parametros de la serie
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo el indicator correctamente, false sino
	*/
	function create($serieParams) {
		$serieObj = new IndicatorSerie();
		foreach ($serieParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($serieObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$serieObj->$setMethod($value);
				else
					$serieObj->$setMethod(null);
			}
		}

		try {
			$serieObj->save();
			return $serieObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de una serie.
	*
	* @param int $id id de la serie
	* @param array $variableParams array asociativo con los parametros de la serie
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$serieParams) {
		$serieObj = IndicatorSerieQuery::create()->findPk($id);
		foreach ($serieParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($serieObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$serieObj->$setMethod($value);
				else
					$serieObj->$setMethod(null);
			}
		}

		try {
			$serieObj->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}
	
	 /**
	* Actualiza el orden de una serie.
	*
	* @param int $serieId ID de la serie
	* @param int $order nueva posicion de la serie en el ordenamiento
	* @return boolean true si pudo actualizar sino false
	*/
	function updateOrder($serieId, $order) {
		try {
			$serie = IndicatorSeriePeer::retrieveByPK($serieId);
			$serie->setOrder($order);
			$serie->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina una serie a partir de los valores de la clave.
	*
	* @param int $id id de la serie
	*	@return boolean true si se elimino correctamente la serie, false sino
	*/
	function delete($id) {
		try {
			$serieObj = IndicatorSerieQuery::create()->findPk($id);
			$serieObj->delete();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene la informacion de una serie.
	*
	* @param int $id id de la serie
	* @return array Informacion de la serie
	*/
	function get($id) {
		$serieObj = IndicatorSerieQuery::create()->findPk($id);
		return $serieObj;
	}

	/**
	* Obtiene todas las series.
	*
	*	@return array Informacion sobre todas las series
	*/
	function getAll() {
		$series = IndicatorSerieQuery::create()->find();
		return $series;
	}

	/**
	* Obtiene todas las series para un indicador.
	*
	*	@return array todas las series para un indicador.
	*/
	function getSeriesByIndicator($indicatorId) {
		$criteria = New Criteria();
		$criteria->addAscendingOrderByColumn(IndicatorSeriePeer::ORDER);
		$criteria->add(IndicatorSeriePeer::INDICATORID, $indicatorId);
		return IndicatorSeriePeer::doSelect($criteria);
	}

	/**
	* Obtiene todas las Y para una serie.
	*
	*	@return array todals las Y para la serie.
	*/
	function getYsBySerie($serieId) {
		$criteria = New Criteria();
		$criteria->addAscendingOrderByColumn(IndicatorYPeer::ORDER);
		$criteria->add(IndicatorYPeer::SERIEID, $serieId);
		return IndicatorYPeer::doSelect($criteria);
	}

} // IndicatorSeriePeer
