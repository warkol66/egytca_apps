<?php

//TODO: Probar
class CalendarGetThumbnailAction extends BaseEditAction {

	function __construct() {
		parent::__construct('CalendarEvent');
	}
	
	protected function postEdit(){
		parent::postEdit();
		
		$module = "Calendar";
		$this->smarty->assign("module",$module);
		
		if (is_object($this->entity)) {
			$image = $this->entity->getFirstImage();
			if (!empty($image)) {
				$file = $moduleRootDir."/WEB-INF/classes/modules/calendar/files/images/";
				$file .= "thumbnails";
				$file .= "/".$image->getId();//print_r($file);die;
				//header('Content-Type: image/jpeg');
				readfile($file);
				die;				
			}
		}
	}
}


/*class CalendarEventsGetThumbnailAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarEventsGetThumbnailAction() {
		;
	}


	// ----- Public Methods ------------------------------------------------- //

	/**
	* Process the specified HTTP request, and create the corresponding HTTP
	* response (or forward to another web component that will create it).
	* Return an <code>ActionForward</code> instance describing where and how
	* control should be forwarded, or <code>NULL</code> if the response has
	* already been completed.
	*
	* @param ActionConfig		The ActionConfig (mapping) used to select this instance
	* @param ActionForm			The optional ActionForm bean for this request (if any)
	* @param HttpRequestBase	The HTTP request we are processing
	* @param HttpRequestBase	The HTTP response we are creating
	* @public
	* @returns ActionForward
	*
	function execute($mapping, $form, &$request, &$response) {

    BaseAction::execute($mapping, $form, $request, $response);

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}

		$module = "Calendar";
		$smarty->assign("module",$module);

		global $moduleRootDir;


		if ( !empty($_GET["id"]) ) {
			$calendarEvent = CalendarEventQuery::create()->find($_GET["id"]);
			if (!empty($calendarEvent)) {
				$image = $calendarEvent->getFirstImage();
				if (!empty($image)) {
					$file = $moduleRootDir."/WEB-INF/classes/modules/calendar/files/images/";
					$file .= "thumbnails";
					$file .= "/".$image->getId();//print_r($file);die;
					//header('Content-Type: image/jpeg');
					readfile($file);
					die;				
				}
			}
		}

	}

}*/
