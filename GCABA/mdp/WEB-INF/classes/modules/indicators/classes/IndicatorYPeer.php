<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_y' table.
 *
 * Valores del eje Y
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorYPeer extends BaseIndicatorYPeer {
/**
	* Crea una Y nueva.
	*
	* @param array $valueParam arreglo asociativo con los parametros de la Y
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo la Y correctamente, false sino
	*/
	function create($valueParams)
	{
		$yObj = new IndicatorY();
		foreach ($valueParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($yObj,$setMethod) ) {          
				if ( !empty($value) || $value == "0")
					$yObj->$setMethod($value);
				else
					$yObj->$setMethod(null);
			}
		}

		try {
			$yObj->save();
			return $yObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de una Y.
	*
	* @param int $id id de la Y
	* @param array $valueParam arreglo asociativo con los parametros de la Y
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$valueParam)
	{
		$yObj = IndicatorYQuery::create()->findPk($id);
		foreach ($valueParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($yObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$yObj->$setMethod($value);
				else
					$yObj->$setMethod(null);
			}
		}

		try {
			$yObj->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina una Y a partir de los valores de la clave.
	*
	* @param int $id id de la Y
	*	@return boolean true si se elimino correctamente la Y, false sino
	*/
	function delete($id) {
		try {
			$yObj = IndicatorYQuery::create()->findPk($id);
			$yObj->delete();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}
	
	/**
	 * Elimina todos los valores Y de una serie.
	 * 
	 * @param $serieId id de la serie.
	 * @return boolean true si se eliminaron correctamente los valores Y de la serie.
	 */
	function deleteAllBySerie($serieId) {
		try {
			$yObj = IndicatorYQuery::create()
						->filterBySerieid($serieId)
						->delete();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}
	
/**
	 * Elimina todos los valores Y de una X.
	 * 
	 * @param $xId id de la X.
	 * @return boolean true si se eliminaron correctamente los valores Y de la X.
	 */
	function deleteAllByX($xId) {
		try {
			$yObj = IndicatorYQuery::create()
						->filterByXid($xId)
						->delete();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene la informacion de una Y.
	*
	* @param int $id id de la Y
	* @return array Informacion de la Y
	*/
	function get($id)
	{
		$yObj = IndicatorYQuery::create()->findPk($id);
		return $yObj;
	}

	/**
	* Obtiene todos las Y.
	*
	*	@return array con todas las Y
	*/
	function getAll()
	{
		$yObj = IndicatorYQuery::create()->find();
		return $yObj;
	}

	/**
	* Obtiene todas las Ys para una X.
	*
	* @return array con todas las Ys para una X ordenadas de la misma
	* forma en que esten ordenadas sus respectivas series.
	*/
	function getYsByX($xId)
	{
		return IndicatorYQuery::create()->join('IndicatorSerie')
										->join('IndicatorX')
										->useQuery('IndicatorX')
    										->filterById($xId)
  										->endUse()
  										->useQuery('IndicatorSerie')
    										->orderByOrder()
  										->endUse()
  										->find();
	}

	/**
	* Obtiene todas las Y para una serie.
	*
	* @return array con todas las Y para una serie ordenadas de la misma
	* forma en que esten ordenadas sus respectivas X.
	*/
	function getYsBySerie($serieId)
	{
		return IndicatorYQuery::create()->join('IndicatorSerie')
										->join('IndicatorX')
										->useQuery('IndicatorSerie')
    										->filterById($serieId)
  										->endUse()
  										->useQuery('IndicatorX')
    										->orderByOrder()
  										->endUse()
  										->find();
	}
	
} // IndicatorYPeer
