<?php


/**
 * Skeleton subclass for performing query and update operations on the 'indicators_x' table.
 *
 * Valores del eje x
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.indicators.classes
 */
class IndicatorXPeer extends BaseIndicatorXPeer {
	/**
	* Crea un X nuevo.
	*
	* @param array $variableParams array asociativo con los parametros de la X 
	* @param Connection $con [optional] Conexion a la db
	* @return boolean true si se creo la X correctamente, false sino
	*/
	function create($variableParams) {
		$variableObj = new IndicatorX();
		foreach ($variableParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($variableObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$variableObj->$setMethod($value);
				else
					$variableObj->$setMethod(null);
			}
		}

		try {
			$variableObj->save();
			return $variableObj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Actualiza la informacion de una X.
	*
	* @param int $id id de la X
	* @param array $xParams parametros de la X.
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$xParams) {
		$xObj = IndicatorXQuery::create()->findPk($id);
		foreach ($xParams as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($xObj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$xObj->$setMethod($value);
				else
					$xObj->$setMethod(null);
			}
		}

		try {
			$xObj->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}
	
	 /**
	* Actualiza el orden de una X.
	*
	* @param int $xId ID de la X
	* @param int $order nueva posicion de la X en el ordenamiento
	* @return boolean true si pudo actualizar sino false
	*/
	function updateOrder($xId, $order) {
		try {
			$x = IndicatorXPeer::retrieveByPK($xId);
			$x->setOrder($order);
			$x->save();
			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions"))
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Elimina una X a partir de los valores de la clave.
	*
	* @param int $id id de la X
	*	@return boolean true si se elimino correctamente la X, false sino
	*/
	function delete($id) {
		try {
			$xObj = IndicatorXQuery::create()->findPk($id);
			$xObj->delete();
			return true;
		}  catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	/**
	* Obtiene la informacion de una X.
	*
	* @param int $id id de la X
	* @return array Informacion de la X
	*/
	function get($id) {
		$xObj = IndicatorXQuery::create()->findPk($id);
		return $xObj;
	}

	/**
	* Obtiene todas las X.
	*
	*	@return array Informacion sobre todas las X.
	*/
	function getAll() {
		$xObj = IndicatorXQuery::create()->find();
		return $xObj;
	}

	/**
	* Obtiene todos las X para un Indicator.
	*
	*	@return array Informacion sobre todas las X para un Indicator
	*/
	function getXsByIndicator($indicatorId) {
		return IndicatorXQuery::create()
					->filterByIndicatorid($indicatorId)
					->orderByOrder()
					->find();
	}
	
} // IndicatorXPeer

