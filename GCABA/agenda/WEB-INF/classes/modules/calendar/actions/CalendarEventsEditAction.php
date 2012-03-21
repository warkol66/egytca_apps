<?php

class CalendarEventsEditAction extends BaseAction {

	function CalendarEventsEditAction() {
		;
	}

	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);
		$smarty->assign("actualAction", "calendarEventsEdit");

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);
		$calendarEventsConfig = $moduleConfig["calendarEvents"];
		$smarty->assign("calendarEventsConfig",$calendarEventsConfig);
				
    if ( !empty($_GET["id"]) ) {
			//voy a editar un evento
			$calendarEvent = CalendarEventPeer::get($_GET["id"]);
			
			$smarty->assign("calendarEvent",$calendarEvent);
			if ($calendarEventsConfig['useRegions']['value'] == "YES") {
				require_once("RegionPeer.php");		
				$smarty->assign("regionIdValues",RegionPeer::getAll());
			}
			if ($calendarEventsConfig['useCategories']['value'] == "YES") {
				require_once("CategoryPeer.php");		
				$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			}
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());
			//buscamos las medias de articulo para listarlas
			$smarty->assign("calendarMedias",CalendarMediaPeer::getAll($_GET['id']));
			
			$smarty->assign("images",$calendarEvent->getImages());
/*			$smarty->assign("sounds",$newsarticle->getSounds());
			$smarty->assign("videos",$newsarticle->getVideos());
*/
    	$smarty->assign("action","edit");
		}
		else {
			//voy a crear un calendarevent nuevo
			$calendarEvent = new CalendarEvent();
			$smarty->assign("calendarEvent",$calendarEvent);			
			if ($calendarEventsConfig['useRegions']['value'] == "YES") {
				require_once("RegionPeer.php");		
				$smarty->assign("regionIdValues",RegionPeer::getAll());
			}
			if ($calendarEventsConfig['useCategories']['value'] == "YES") {
				require_once("CategoryPeer.php");		
				$smarty->assign("categoryIdValues",CategoryPeer::getAll());
			}
			require_once("UserPeer.php");		
			$smarty->assign("userIdValues",UserPeer::getAll());

			$smarty->assign("action","create");
		}

		$smarty->assign("calendarEventStatus",CalendarEventPeer::getStatus());
		$calendarMediasTypes = CalendarMediaPeer::getMediaTypes();
		
		$types = array();
		if ($moduleConfig["image"]["useImages"]["value"] == "NO")
			$types[CalendarMediaPeer::CALENDARMEDIA_IMAGE] = 'Imagen';
/*		if ($moduleConfig["video"]["useVideo"]["value"] == "NO")
			$types[CalendarMediaPeer::CALENDARMEDIA_VIDEO] = 'Video';
		if ($moduleConfig["audio"]["useAudio"]["value"] == "NO")
			$types[CalendarMediaPeer::CALENDARMEDIA_SOUND] = 'Sonido';
*/
		$smarty->assign("calendarMediasTypes",array_diff_assoc($calendarMediasTypes, $types));

		$smarty->assign("message",$_GET["message"]);

		if (!empty($_GET['filters'])) {
			$smarty->assign('filters',$_GET['filters']);
		}

		return $mapping->findForwardConfig('success');
	}

}


