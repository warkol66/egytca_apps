<?php

class CalendarEditAction extends BaseEditAction {

	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		$this->smarty->assign("actualAction", "calendarEventsEdit");

		$moduleConfig = Common::getModuleConfiguration($module);
		$this->smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$this->smarty->assign("calendarEventsConfig",$calendarEventsConfig);
		
		/* Descomentar cuando se use regions
		 * if ($calendarEventsConfig['useRegions']['value'] == "YES") {
			$this->smarty->assign("regionIdValues",RegionQuery::create()->find());
		}*/
		if ($calendarEventsConfig['useCategories']['value'] == "YES") {	
			$this->smarty->assign("categoryIdValues",CategoryQuery::create()->find());
		}
		//obtengo usuarios, estados y medias
		$this->smarty->assign("userIdValues",UserQuery::create()->find());
		$this->smarty->assign("calendarEventStatus",CalendarEvent::getStatuses());
		$calendarMediasTypes = CalendarMedia::getMediaTypes();
		
		//si estoy editando, obtengo los medias
		if (!empty($_GET["id"])){
			$this->smarty->assign("calendarMedias",CalendarMediaQuery::create()->filterByCalendarEventId($_GET['id'])->find());
			$this->smarty->assign("images",$this->entity->getImages());
		}
		
		//mediaTypes
		$types = array();
		if ($moduleConfig["image"]["useImages"]["value"] == "NO")
			$types[CalendarMedia::CALENDARMEDIA_IMAGE] = 'Imagen';

		$this->smarty->assign("calendarMediasTypes",array_diff_assoc($calendarMediasTypes, $types));

		$this->smarty->assign("message",$_GET["message"]);

	}

}
