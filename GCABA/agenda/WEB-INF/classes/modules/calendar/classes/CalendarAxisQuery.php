<?php



/**
 * Skeleton subclass for performing query and update operations on the 'calendar_axis' table.
 *
 * Base de Ejes
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarAxisQuery extends BaseCalendarAxisQuery {
    
    /**
     * Devuelve un mapeo:
     *  name => cssClass
     * 
     * @return array
     */
    public function findAxisMap($key = 'name', $value = 'cssClass') {
        $getKey = 'get' . ucfirst($key);
	$getValue = 'get' . ucfirst($value);
        $map = array();
        foreach ($this->find() as $axis)
            $map[$axis->$getKey()] = $axis->$getValue();
        
        return $map;
    }

} // CalendarAxisQuery
