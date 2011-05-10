<?php

require_once("BaseAction.php");
require_once("CalendarMediaPeer.php");
class CalendarMediasDoEditXAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function CalendarMediasDoEditXAction() {
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
	*/
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
		$section = "Media";
		$smarty->assign("section",$section);				

		//por ser un action ajax
		$this->template->template = 'TemplateAjax.tpl';
		
		//obtenemos las variables del request
		list($code,$id) = explode('_',$_POST['editorId']);
		$value = $_POST['value'];
		
		
		$calendarMedia = CalendarMediaPeer::get($id);
		
		if ($code == 'descriptionEdit') {
			//estamos editando la descripcion
			try {
				$calendarMedia->setDescription($value);
				$calendarMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}

		if ($code == 'titleEdit') {
			//estamos editando el titulo
			try {
				$calendarMedia->setTitle($value);
				$calendarMedia->save();
			}
			catch (PropelException $e) {
				;
			}
		}
	
		//seteamos la respuesta de smarty
		$smarty->assign('value',$value);
	
		return $mapping->findForwardConfig('success');
	}

}
