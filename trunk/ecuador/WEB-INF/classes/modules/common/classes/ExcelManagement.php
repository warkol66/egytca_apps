<?php

require_once('Spreadsheet/Excel/Writer.php');

/**
* Wrapper de la funcionalidades basicas de SpreadsheetExcelWriter.
*
* Encapsulamiento de los aspectos basicos de generación de xls.
*/
class ExcelManagement
{

	private $workbook;
	private $worksheet;
	private $headers;
	private $tableHeaders;	
	private $data;

	public function __construct() {
		$this->workbook = new Spreadsheet_Excel_Writer();
		$this->worksheet =& $this->workbook->addWorksheet('Export');
		//Problemas con utf8, se estan decodeando los contenidos ahora
		//$this->workbook->setVersion(8);
        //$this->worksheet->setInputEncoding('UTF-8');
		
	}
	
	/*
	 * Setea el array con los headers (titulos/subtitulos) del excel.
	 * 
	 * @param array $headers Array con los header
	 * @return void
	 */
	public function setHeaders($headers) {
		$this->headers = $headers;
	}
	
	/*
	 * Setea el array con los headers de cada columna.
	 * 
	 * @param array $headers Array con los header
	 * @return void
	 */
	public function setTableHeaders($headers) {
		$this->tableHeaders = $headers;
	}	
	
	/*
	 * Setea la matriz con los datos. 
	 * 
	 * @param array $data Matriz con los datos, primer indice las filas
	 * @return void
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/*
	 * Envia la cliente el archivo xls, a partir de los headers y datos seteados previamente.
	 * 
	 * @param string $filename Nombre del archivo
	 * @return void
	 */
	public function sendToClient($filename="export.xls") {
		$this->workbook->send($filename);
		for ($i=0;$i<count($this->headers);$i++) {
			$this->worksheet->write($i,0,utf8_decode($this->headers[$i]));
		}		
		$initRow = count($this->headers);		
		for ($i=0;$i<count($this->tableHeaders);$i++) {
			$this->worksheet->write($initRow,$i,utf8_decode($this->tableHeaders[$i]));
		}		
		if (!empty($this->tableHeaders))
			$initRow++;
		for ($i=0;$i<count($this->data);$i++) {
			for ($j=0;$j<count($this->data[$i]);$j++) {
				$this->worksheet->write($i+$initRow,$j,utf8_decode($this->data[$i][$j]));
			}
		}
		$this->workbook->close();
	}	
	
	/*
	 * Envia la cliente el archivo xls, a partir del contenido de un archivo xml.
	 * 
	 * @param string $xml XML
	 * @param string $filename Nombre del archivo enviado al cliente
	 * @return void
	 */	
	public function sendXlsFromXml($xml,$filename="export.xls") {
		require_once("xml2ary.php");
		$xml2ary = new Xml2ary();
		$array = $xml2ary->getArray($xml);
		$tableHeadersElement = $array['xls']['_c']['tableHeaders']['_c']['header'];
		$tableHeaders = array();
		foreach ($tableHeadersElement as $header) {
			$tableHeaders[] = $header['_v'];
		}
		$this->setTableHeaders($tableHeaders);
		$headersElement = $array['xls']['_c']['headers']['_c']['header'];
		$headers = array();
		foreach ($headersElement as $header) {
			$headers[] = $header['_v'];
		}
		$this->setHeaders($headers);				
		$dataElements = $array['xls']['_c']['tableValues']['_c']['row'];
		$data = array();
		foreach ($dataElements as $dataElement) {
			$itemData = array();
			foreach ($dataElement['_c'] as $cell) {
				$itemData[] = $cell['_v'];
			}
			$data[] = $itemData;
		}
		$this->setData($data);
		$this->sendToClient($filename);
	}

}
