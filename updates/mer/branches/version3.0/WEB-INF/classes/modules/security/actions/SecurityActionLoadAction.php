<?php


require_once("BaseAction.php");
require_once("mer/SecurityActionPeer.php");
require_once("mer/GroupPeer.php");
require_once("mer/GroupCategoryPeer.php");


/**
* Implementation of <strong>Action</strong> that demonstrates the use of the Smarty
* compiling PHP template engine within php.MVC.
*
* @author John C Wildenauer
* @version 1.0
* @public
*/
class SecurityActionLoadAction extends BaseAction {


	// ----- Constructor ---------------------------------------------------- //

	function SecurityActionLoadAction() {
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
		global $PHP_SELF;
		//////////
		// Call our business logic from here

		//////////
		// Access the Smarty PlugIn instance
		// Note the reference "=&"
		$plugInKey = 'SMARTY_PLUGIN';
		$smarty =& $this->actionServer->getPlugIn($plugInKey);
		if($smarty == NULL) {
			echo 'No PlugIn found matching key: '.$plugInKey."<br>\n";
		}
		
		//asigno modulo y seccion
		$modulo = "Security";
		$section = "action list";

		$smarty->assign("modulo",$modulo);
		$smarty->assign("section",$section);


		/*
		* Busco todos los actions existentes en mis directorios para agregarlos luego en una lista
		*
		* @var string $modulos que contendra los actions
		*/
		
		$dir = "WEB-INF/classes/modules/";
				$dh  = opendir($dir);
				while (false !== ($nombre_modulo = readdir($dh))) 
				{
					if ($nombre_modulo[0]!='.')
					{	$modulesName[$i]=$nombre_modulo;
						$i++;
						$dh2 = opendir($dir.$nombre_modulo."/actions/");
						while (false!== ($nombre_action = readdir($dh2)) )
						{
							if (ereg("(.*)Action.php$",$nombre_action,$campos))
							{	$modulos[$nombre_modulo][] = $campos[1];
								//los ordeno
								array_multisort($modulos[$nombre_modulo]);
							}
						}
					}
				}

			//creo un nuevo elemento de la clase Security
			$securityPeer = new SecurityActionPeer();
			
			// Obtengo todos los actions existentes
			$securities = $securityPeer->getAll();
		
		
			$i=0;
			$actionArray = array ();
		/*
		* Junto los actions que poseen par en un mismo array, el resultado final es una matriz en donde
		* contiene el nombre de cada modulo y los actions de cada modulo, ordenados en pares Action, doAction.
		*
		*/
		foreach ($modulos as $name => $module){
			$actionArray[$name] = array () ;
			foreach ($module as $action){
				$pareAction= array ();

				if(ereg("(.*)([a-z]Do[A-Z])(.*)",$action,$parts)){

					$actionsWithoutDo=$parts[1].$parts[2][0].$parts[2][3].$parts[3];
					
					//si existe el action sin do
					if(in_array($actionsWithoutDo,$module)){
						$pareAction[0]=$actionsWithoutDo;
						$pareAction[1]=$action;
					}
					else 	$pareAction[0]=$action;
				}
				else 	$pareAction[0]=$action;

				$actionArray[$name][] = $pareAction;
			}
			
			foreach ($actionArray[$name] as $eachAction){

				if (!empty($eachAction[1])) {	
					unset($eachAction[1]);
					$actionSearch=(array_search($eachAction,$actionArray[$name]));
					
					if(!empty($actionSearch)){
						unset($actionArray[$name][$actionSearch]);
					}
				}
				
			}
		}

		// asigno los actions totales, y lo s actions seleccionados
		$smarty->assign("modulos",$actionArray);
		$smarty->assign("security",$securities);

		return $mapping->findForwardConfig('success');
	}

}
?>
