<?php

require_once("BaseAction.php");

class ModulesDoCreateXmlForAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function ModulesDoCreateXmlForAction() {
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

		$module = "Config";

		$smarty->assign("module",$module);

		$selectedModule=$_POST["module"];
	/*global $system;
		if (empty($_POST["module"]))
			$system["config"] = $_POST["config"];
		else*/
			//$system["config"][$_POST["module"]] = $_POST["config"][$_POST["module"]];
		//	print_r($_POST["configb"]);
		require_once('includes/assoc_array2xml.php');
		$converter= new assoc_array2xml;

		$config=$_POST["config"];
		$newActionArray=$_POST["configb"];

		$originalActionArray=$config["$selectedModule"]["moduleInstalation"]["moduleInstalation:actions"];

		if(empty ( $originalActionArray ) ) 
			$originalActionArray= array();

		$fusionActionArray=array_merge ($originalActionArray,$newActionArray );

		$config["$selectedModule"]["moduleInstalation"]["moduleInstalation:actions"]=$fusionActionArray;
		//print_r($c); //$_POST["configb"]);

		$xml = $converter->array2xml($config);


		//////////
		// incluir este path en la version final en file_put_contents
		$path = "WEB-INF/classes/modules/$selectedModule/$selectedModule.xml";

		file_put_contents("config/configXX.xml",$xml);


		return $mapping->findForwardConfig('success');
	}

}
?>
