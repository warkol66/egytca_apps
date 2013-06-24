<?php


// The parent class
require_once 'infocivica/map/NewsletterScheduleMapBuilder.php';
require_once 'om/BaseNewsletterSchedulePeer.php';

// The object class
include_once 'NewsletterSchedule.php';

/**
 * Class NewsletterSchedulePeer
 *
 * @package NewsletterSchedule
 */
class NewsletterSchedulePeer extends BaseNewsletterSchedulePeer {

	 const EVERY_DAY_MODE = 'ED';
	 const ONCE_A_WEEK_MODE = 'OW';
	 const ONCE_A_MONTH_MODE = 'OM';
	 const ONCE_MODE = 'O';

  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }
  
  /**
  * Crea un newsletter schedule nuevo.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se creo correctamente, false sino
  */  
  function create($params) {
    try {
      $newsletterscheduleObj = new NewsletterSchedule();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletterscheduleObj,$setMethod) ) {          
          if (!empty($value))
            $newsletterscheduleObj->$setMethod($value);
          else
            $newsletterscheduleObj->$setMethod(null);
        }
      }
      $newsletterscheduleObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }  
  
  /**
  * Actualiza la informacion de un newsletter schedule.
  *
  * @param array $params Array asociativo con los atributos del objeto
  * @return boolean true si se actualizo la informacion correctamente, false sino
  */  
  function update($params) {
    try {
      $newsletterscheduleObj = NewsletterSchedulePeer::retrieveByPK($params["id"]);    
      if (empty($newsletterscheduleObj))
        throw new Exception();
      foreach ($params as $key => $value) {
        $setMethod = "set".$key;
        if ( method_exists($newsletterscheduleObj,$setMethod) ) {          
          if (!empty($value))
            $newsletterscheduleObj->$setMethod($value);
          else
            $newsletterscheduleObj->$setMethod(null);
        }
      }
      $newsletterscheduleObj->save();
      return true;
    } catch (Exception $exp) {
      return false;
    }         
  }    

	/**
	* Elimina un newsletter schedule a partir de los valores de la clave.
	*
  * @param int $id id del newsletterschedule
	*	@return boolean true si se elimino correctamente el newsletterschedule, false sino
	*/
  function delete($id) {
  	$newsletterscheduleObj = NewsletterSchedulePeer::retrieveByPK($id);
    $newsletterscheduleObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un newsletter schedule.
  *
  * @param int $id id del newsletterschedule
  * @return array Informacion del newsletterschedule
  */
  function get($id) {
		$newsletterscheduleObj = NewsletterSchedulePeer::retrieveByPK($id);
    return $newsletterscheduleObj;
  }

  /**
  * Obtiene todos los newsletter schedules.
	*
	*	@return array Informacion sobre todos los newsletterschedules
  */
	function getAll() {
		$cond = new Criteria();
		$alls = NewsletterSchedulePeer::doSelect($cond);
		return $alls;
  }
  
  /**
  * Obtiene todos los newsletter schedules paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los newsletterschedules
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	NewsletterSchedulePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    require_once("propel/util/PropelPager.php");
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"NewsletterSchedulePeer", "doSelect",$page,$perPage);
    return $pager;
   }

	/**
	 * Devuelve los dias de la semana codificados como en el sistema
	 *
	 * @return array con clave de dia de la semana y nombre del dia de la semana
	 */
	public function getWeekdays() {
		$weekdays = array();
		$weekdays['Mon'] = 'Lunes';
		$weekdays['Tue'] = 'Martes';
		$weekdays['Wed'] = 'Miercoles';
		$weekdays['Thu'] = 'Jueves';
		$weekdays['Fri'] = 'Viernes';
		$weekdays['Sat'] = 'Sabado';
		$weekdays['Sun'] = 'Domingo';
		
		return $weekdays;
	}
	
	/**
	 * Obtiene los envios programados para una cierta fecha de todos los tipos
	 *
	 * @param string YYYY-MM-DD
	 * @return array de instancia de Newsletter Schedule
	 */
	public function getNewsletterSchedulesForDate($date) {
		
		$result = array();
		$result = array_merge($result,NewsletterSchedulePeer::getOnceNewsletterSchedulesForDate($date));
		$result = array_merge($result,NewsletterSchedulePeer::getEveryDayNewsletterSchedulesForDate($date));
		$result = array_merge($result,NewsletterSchedulePeer::getOnceAWeekNewsletterSchedulesForDate($date));
		$result = array_merge($result,NewsletterSchedulePeer::getOnceAMonthNewsletterSchedulesForDate($date));
				
		return $result;
		
	}
	
	/**
     * Obtiene los envios programados de envio por unica vez para una cierta fecha
	 * @param string YYYY-MM-DD
	 * @return array de instancia de Newsletter Schedule	 
	 */
	public function getOnceNewsletterSchedulesForDate($date) {
		
		$criteria = new Criteria();
		$criteria->add(NewsletterSchedulePeer::DELIVERYDATE,$date);
		$criteria->add(NewsletterSchedulePeer::ACTIVE,1);		
		$criteria->add(NewsletterSchedulePeer::DELIVERYMODE,NewsletterSchedulePeer::ONCE_MODE);
		
		return NewsletterSchedulePeer::doSelect($criteria);
		
	}
	
	/**
     * Obtiene los envios programados de envio de todos los dias para una cierta fecha
	 * @param string YYYY-MM-DD
	 * @return array de instancia de Newsletter Schedule	 
	 */	
	public function getEveryDayNewsletterSchedulesForDate($date) {
		
		$criteria = new Criteria();
		$criteria->add(NewsletterSchedulePeer::DELIVERYMODE,NewsletterSchedulePeer::EVERY_DAY_MODE);
		$criteria->add(NewsletterSchedulePeer::ACTIVE,1);		
		return NewsletterSchedulePeer::doSelect($criteria);
		
	}

	/**
     * Obtiene los envios programados de envio de una vez por mes para una cierta fecha
	 * @param string YYYY-MM-DD
	 * @return array de instancia de Newsletter Schedule	 
	 */
	public function getOnceAMonthNewsletterSchedulesForDate($date) {
		
		//obtenemos el dia en el cual se debe realizar el envio
		$timestamp = strtotime($date);
		$day = date("d",$timestamp);
		
		$criteria = new Criteria();
		$criteria->add(NewsletterSchedulePeer::DELIVERYDAYNUMBER,$day);
		$criteria->add(NewsletterSchedulePeer::ACTIVE,1);		
		$criteria->add(NewsletterSchedulePeer::DELIVERYMODE,NewsletterSchedulePeer::ONCE_A_MONTH_MODE);
		return NewsletterSchedulePeer::doSelect($criteria);
		
	}

	/**
     * Obtiene los envios programados de envio de una vez por semana para una cierta fecha
	 * @param string YYYY-MM-DD
	 * @return array de instancia de Newsletter Schedule	 
	 */
	public function getOnceAWeekNewsletterSchedulesForDate($date) {
		
		//obtenemos el dia de la semana en el cual se debe realizar el envio
		$timestamp = strtotime($date);
		$day = date("D",$timestamp);
		$criteria = new Criteria();
		$criteria->add(NewsletterSchedulePeer::DELIVERYDAY,$day);
		$criteria->add(NewsletterSchedulePeer::ACTIVE,1);		
		$criteria->add(NewsletterSchedulePeer::DELIVERYMODE,NewsletterSchedulePeer::ONCE_A_WEEK_MODE);
		return NewsletterSchedulePeer::doSelect($criteria);
		
	}	

}
?>
