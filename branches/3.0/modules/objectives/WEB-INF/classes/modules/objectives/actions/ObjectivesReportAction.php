<?php

class ObjectivesReportAction extends BaseAction {

	function ObjectivesReportAction() {
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

		$module = "Objectives";
		$section = "Objectives";

    $smarty->assign("module",$module);
    $smarty->assign("section",$section);

		$moduleConfig = Common::getModuleConfiguration($module);
		$smarty->assign("moduleConfig",$moduleConfig);

		if ($_GET["toPrint"]) {
			$this->template->template = "TemplateReport.tpl";
			$smarty->assign("toPrint",true);
		}

		$positionsLatetsVersion = PositionPeer::getLatestVersion();
		$positionPeer = new PositionPeer();
		$positionPeer->setSearchType(11);
		$positionPeer->setSearchVersion($positionsLatetsVersion);
		$positions = $positionPeer->getAllFiltered();
		$smarty->assign("positions",$positions);

		if ($_GET["toPdf"]) {
			$this->template->template = "TemplateReport.tpl";
			$smarty->assign("toPdf",true);
			$forwardConfig = $mapping->findForwardConfig('success'); 
			//obtengo el template
			$template = $forwardConfig->getPath();	
   
			$html_result = $smarty->fetch($template);

			//html2pdf
/*			require_once('html2pdf_v4.01/html2pdf.class.php');
			$html2pdf = new HTML2PDF('P','A2', 'es');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($html_result, isset($_GET['vuehtml']));
			$html2pdf->Output('exemple05.pdf');
*/
			//tcpdf
/*			require_once('tcpdf/config/lang/eng.php');
			require_once('tcpdf/tcpdf.php');
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 
			$pdf->AddPage();
			// output the HTML content
			$pdf->writeHTML($html_result, true, 0, true, 0);
			$pdf->Output('example_006.pdf', 'I');
*/
			//dompdf
			//require_once("dompdf/dompdf.php");
				
			require_once("dompdf/dompdf_config.inc.php");

			$dompdf = new DOMPDF();
			$dompdf->set_paper('A4','landscape');
			$dompdf->load_html($html_result);
			$dompdf->render();
			$dompdf->stream("sample.pdf", array("Attachment" => 0));
			
			exit;
			
		}

		return $mapping->findForwardConfig('success');
	}

}
