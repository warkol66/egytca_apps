<?php


/**
 * Skeleton subclass for performing query and update operations on the 'positions_positionTenure' table.
 *
 * Ejercicio del cargo
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.positions.classes
 */
class PositionTenurePeer extends BasePositionTenurePeer {

	public static function create($params)
	{
		$obj = PositionTenurePeer::getObjectFromParams($params);

		try {
			$obj->save();
			return $obj;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	public static function update($id,$params)
	{
		$obj = PositionTenureQuery::create()->findPk($id);
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}

		try {
			$obj->save();

			return true;
		} catch (PropelException $exp) {
			if (ConfigModule::get("global","showPropelExceptions")) 
				print_r($exp->getMessage());
			return false;
		}
	}

	public function delete($id) {
		$obj = PositionTenureQuery::create()->findPk($id);
		$obj->delete();
		return true;
	}

	/**
	* Obtiene un objeto PositionTenure a partir de un array de valores de sus atributos
	*
	* @param array $params Valores
	* @return Position 
	*/
	public static function getObjectFromParams($params) {
		$obj = new PositionTenure();
		foreach ($params as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {          
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}
			
		return $obj;		
	}

} // PositionTenurePeer
