<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'calendar_event' table.
 *
 * Eventos del Calendario
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.calendar.classes
 */
class CalendarContextEvent extends CalendarEvent {

	/**
	 * Constructs a new CalendarContextEvent class, setting the class_key column to CalendarEventPeer::CLASSKEY_3.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClassKey(CalendarEventPeer::CLASSKEY_3);
	}

	/**
	 * Devuelve el nobre del tipo de contexto
	 * 
	 * @return string nombre del tipo de contexto
	 */
	public function getContextTypeName() {
		$contextTypes = CalendarContextEvent::getContextType();
		return $contextTypes[$this->getContextType()];
	}

	/**
	 * Devuelve array con tipos de contexto
	 *  id => Tipo de contexto
	 *
	 * @return array tipos de contexto
	 */
	public static function getContextTypes() {
		$contextTypes = array(
			1 => 'Nacional',
			2 => 'Campaña',
			3 => 'Crisis',
			4 => 'Coyuntura'
		);
		return $contextTypes;
	}

} // CalendarContextEvent
