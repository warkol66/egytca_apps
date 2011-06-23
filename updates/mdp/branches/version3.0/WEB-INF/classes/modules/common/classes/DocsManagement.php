<?php

/**
* Wrapper de funcionalidades para obtener el full text de un documento
*
*/
class DocsManagement
{

	private $file;
	private $extension;
	private $fullText;

	public function __construct() {
		
	}
	
	/*
	 * Setea el archivo.
	 * 
	 * @param file $file Archivo
	 * @return void
	 */
	public function setFile($file) {
		$this->file = $file;
	}
	
	/*
	 * Setea la extensión, y por ende el tipo de parser a utilizar
	 * 
	 * @param string $extension Extension del archivo
	 * @return void
	 */
	public function setExtension($extension) {
		$this->extension = $extension;
	}	
	
	/*
	 * Setea la matriz con los datos. 
	 * 
	 * @param array $data Matriz con los datos, primer indice las filas
	 * @return void
	 */
	public function setFullText($fullText) {
		$this->fullText = $fullText;
	}
	
	/*
	 * Envia la cliente el archivo xls, a partir del contenido de un archivo xml.
	 * 
	 * @param string $xml XML
	 * @param string $filename Nombre del archivo enviado al cliente
	 * @return void
	 */	
	public function getFullText($file) {

			$this->setFile($file);
			$path_parts = pathinfo($file['name']);
			$extension = $path_parts['extension'];
      $this->setExtension($extension);

	  if ( is_array($file) and $file['size'] > 0) {
			switch  ($extension) {
				case "pdf":
					//Obtener el TN
					// $tn ="/usr/bin/gs -q -dNOPAUSE -dBATCH -sDEVICE=jpeg -r300 -dLastPage=1 -sOutputFile=test150.jpg test.pdf";

					//Usa librería xpdf
					$xpdf = "";
					exec('pdftotext -nopgbrk ' . $path_parts); 
					$outpath = str_replace(".pdf",".txt", $path_parts);
					$xpdf = file_get_contents($outpath);
					unlink($outpath);
					$this->setFullText($xpdf);
					break;

				case "doc":
					//Usa librería catdoc
					$catdoc = "";
					exec('catdoc ' . $path_parts,$catdoc); 
					$this->setFullText($catdoc);
					break;

				case "xls":
					//Usa librería catdoc
					$xlscsv = "";
					exec('xls2csv ' . $path_parts,$xlscsv); 
					$this->setFullText($xlscsv);
					break;

				case "ppt":
					//Usa librería catdoc
					$catdoc = "";
					exec('catdoc ' . $path_parts,$catdoc); 
					$this->setFullText($catdoc);
					break;

				default:
					break;
				
			}
	
		}
		
	}

}
