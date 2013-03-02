<?php
	// Test de conectividad con SIGAF
	header("Content-type: text/html; charset=UTF-8");
	echo "<h2>Test de conectividad con SIGAF</h2>";

	// Muestro todos los errores
	error_reporting(E_ALL - E_STRICT - E_NOTICE - E_WARNING);
	ini_set('display_errors',1);
require_once('WEB-INF/classes/includes/NuSOAP/nusoap.php');

$bodyxml = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">
			<s:Header />
			<s:Body>
				<ConsultarPartidaPresupuestaria xmlns="http://tempuri.org/">
					<cp xmlns:d4p1="http://schemas.datacontract.org/2004/07/WCF_ENTIDADES" xmlns:i="http://www.w3.org/2001/XMLSchema-instance">
						<d4p1:Actividad>1</d4p1:Actividad>
						<d4p1:Ejercicio>2011</d4p1:Ejercicio>
						<d4p1:Entidad>0</d4p1:Entidad>
						<d4p1:FueFin>11</d4p1:FueFin>
						<d4p1:Inciso>2</d4p1:Inciso>
						<d4p1:Jurisdiccion>21</d4p1:Jurisdiccion>
						<d4p1:Moneda>1</d4p1:Moneda>
						<d4p1:Obra>0</d4p1:Obra>
						<d4p1:Parcial>2</d4p1:Parcial>
						<d4p1:Principal>9</d4p1:Principal>
						<d4p1:Programa>1</d4p1:Programa>
						<d4p1:Proyecto>0</d4p1:Proyecto>
						<d4p1:SubJurisdiccion>0</d4p1:SubJurisdiccion>
						<d4p1:SubParcial>0</d4p1:SubParcial>
						<d4p1:SubPrograma>0</d4p1:SubPrograma>
						<d4p1:UbicaGeo>1</d4p1:UbicaGeo>
					</cp>
				</ConsultarPartidaPresupuestaria>
			</s:Body>
		</s:Envelope>';

// Testing
$budget = new nusoap_client("http://172.17.7.8:83/wcftest/Servicio.svc?wsdl",true);
// Producción
//$budget = new nusoap_client("http://10.73.2.136:83/wcfroot/servicio.svc?wsdl",true);
$err = $budget->getError();
if ($err) {
 echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
 exit();
}

$budget->soap_defencoding = 'utf-8';
$budget->useHTTPPersistentConnection();
$budget->setUseCurl($useCURL);
$bsoapaction = "http://tempuri.org/IServicio/ConsultarPartidaPresupuestaria";
$result = $budget->send($bodyxml, $bsoapaction);
// Check for a fault
if ($budget->fault) {
 echo '<h2>Fault</h2><pre>';
 print_r($result);
 echo '</pre>';
} else {
 // Check for errors
 $err = $budget->getError();
 if ($err) {
  // Display the error
  echo '<h2>Error</h2><pre>' . $err . '</pre>';
 } else {
  // Display the result
  echo '<h2>Result</h2><pre>';
  print_r($result);
  echo '</pre>';
 }
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($budget->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($budget->response, ENT_QUOTES) . '</pre>';
echo '<h2>Client Debug</h2><pre>' . htmlspecialchars($budget->debug_str, ENT_QUOTES) . '</pre>';
echo '<h2>Proxy Debug</h2><pre>' . htmlspecialchars($proxy->debug_str, ENT_QUOTES) . '</pre>';
?>