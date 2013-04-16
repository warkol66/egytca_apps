<?php

class NewsArticlesPreviewAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function NewsArticlesPreviewAction() {
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

		$module = "News";
		$smarty->assign("module",$module);
		
		if (!empty($_POST['id']))
			$_POST['params']['id'] = $_POST['id'];

		$preview = NewsArticle::createPreview($_POST['params']);
		
		//calculo la fecha en español
		$day = date('N',strtotime($preview->getCreationDate()));
		$month = date('m',strtotime($preview->getCreationDate()));

		switch ($day){
			case "01"; $day = "Lunes"; break;
			case "02"; $day = "Martes"; break;
			case "03"; $day = "Miercoles"; break;
			case "04"; $day = "Jueves"; break;
			case "05"; $day = "Viernes"; break;
			case "06"; $day = "Sabado"; break;
			case "07"; $day = "Domingo"; break;
		}
		switch ($month){
			case "01"; $month = "Enero"; break;
			case "02"; $month = "Febrero"; break;
			case "03"; $month = "Marzo"; break;
			case "04"; $month = "Abril"; break;
			case "05"; $month = "Mayo"; break;
			case "06"; $month = "Junio"; break;
			case "07"; $month = "Julio"; break;
			case "08"; $month = "Agosto"; break;
			case "09"; $month = "Septiembre"; break;
			case "10"; $month = "Octubre"; break;
			case "11"; $month = "Noviembre"; break;
			case "12"; $month = "Diciembre"; break;
		}
		$date = $day . " " . date('d',strtotime($preview->getCreationDate())) . " de " . $month . " de " . date('Y',strtotime($preview->getCreationDate()));
		
		//caso de preview en Home
		if ($_POST['mode'] == 'home') {
			
			$this->template->template = "TemplateNewsHome.tpl";
			$articles = array();
			array_push($articles,$preview);
			$smarty->assign("newsarticles",$articles);

			return $mapping->findForwardConfig('success-home');
		}
		
		//caso de preview detallado
		if ($_POST['mode'] == 'detailed') {

			$this->template->template = "TemplateNewsPublic.tpl";
			$smarty->assign('newsarticle',$preview);
			return $mapping->findForwardConfig('success-detailed');

		}

	}

}
