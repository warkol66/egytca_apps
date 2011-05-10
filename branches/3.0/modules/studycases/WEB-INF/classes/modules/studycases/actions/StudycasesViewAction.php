<?php

class StudycasesViewAction extends BaseAction {

	function StudycasesViewAction() {
		;
	}

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

		// Use a different template
		$this->template->template = "TemplateContent.tpl";

		$module = "Studycases";
		$smarty->assign("module",$module);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		$studycase = StudyCasePeer::get($_GET["id"]);

		$smarty->assign("studycase",$studycase);

		if ($_GET["toPdf"] || $_GET["toPrint"]) {
			// Use a different template
			$this->template->template = "TemplateReport.tpl";
			$smarty->assign("toPdf",true);
			$forwardConfig = $mapping->findForwardConfig('success'); 
			//obtengo el template
			$template = $forwardConfig->getPath();	
   
			$html_result = $smarty->fetch($template);

			if ($_GET["getSource"]) {
				print_r($html_result);
				exit;
			}

			if ($_GET["version"])
				require_once($_GET["version"]."/dompdf_config.inc.php");
			else
				require_once("dompdf/dompdf_config.inc.php");

			if ($_GET["debug"])
				$_dompdf_debug = TRUE;

			$dompdf = new DOMPDF();
			$dompdf->set_paper('A4','Portrait');
			$dompdf->load_html($html_result);
			
			if ($_GET["outputHtml"])
				print_r($dompdf->output_html());
			else
				$dompdf->render();

			$docName = $studycase->getTitle() . ".pdf";

			if ($_GET["toDownload"])
				$dompdf->stream($docName, array("Attachment" => 1));
			else
				$dompdf->stream($docName, array("Attachment" => 0));
		
			exit;
			
		}

		$smarty->assign("url","studycasesShow");

		return $mapping->findForwardConfig('success');
	}

}
