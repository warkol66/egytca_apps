<?php

function smarty_function_module_include($params, &$smarty)
{  
    $entity = $params['entity'];
    $module = $params['module'];
    $action = $params['action'];
    parse_str($params['options'],$options);

    //include la clase include correspondiente y obtengo su resultado en $result

		if (!empty($entity)) {
			$objectPeer = $entity . "Peer";
	    $object = new $objectPeer();
	    $method = "get".$action;
	    $result = $object->$method($options);
	    $smarty->assign("result",$result);
  	}
  	else{
	    $include = $params['module']."Include";	    
	    require_once($include.".php");
	    $includeObject = new $include();
	    $method = "get".$action;
	    $result = $includeObject->$method($options);
	    $smarty->assign("result",$result);
  	}

    //Debo cambiarle el outputfilter para poder usar otro external
    $smartyOutputFilter = new SmartyOutputFilter();
    $smartyOutputFilter->template = 'TemplateInclude.tpl';
    $smartyFilters = $smarty->getRegisteredFilters();
    $oldSmartyOutputFilter = $smartyFilters['output']['SmartyOutputFilter_smarty_add_template'][0];
    $smarty->registerFilter('output', array($smartyOutputFilter,"smarty_add_template"));
    
    //Si esta vacio el template opcional, debo buscar el template en el forward del action
    if (empty($options['template'])) {
      $vars = $smarty->getTemplateVars();
      $mapping = $vars["mapping"];
      $applicationConfig = $mapping->getApplicationConfig();
      $actionPath = $module.$action;
			if (function_exists('lcfirst') === false)
	      $actionPath = strtolower(substr($actionPath,0,1)).substr($actionPath,1);
	     else
      	$actionPath = lcfirst($actionPath);
      
      $actionConfig = $applicationConfig->findActionConfig($actionPath);

			if (is_object($actionConfig)) {

	      if (!empty($_SESSION["loginUser"])) {
	        $smarty->assign("loginUser",$_SESSION["loginUser"]);
	        $forwardConfig = $actionConfig->findForwardConfig("includeLogged"); 
	      }
	      else if (!empty($_SESSION["loginAffiliateUser"])) {
	        $smarty->assign("loginAffiliateUser",$_SESSION["loginAffiliateUser"]);
	        $forwardConfig = $actionConfig->findForwardConfig("includeAffiliateUserLogged"); 
	      }
	      else if (!empty($_SESSION["loginRegistrationUser"])) {
	        $smarty->assign("loginRegistrationUser",$_SESSION["loginRegistrationUser"]);
	        $forwardConfig = $actionConfig->findForwardConfig("includeRegistrationUserLogged"); 
	      }
	      else
	        $forwardConfig = $actionConfig->findForwardConfig("includeNotLogged"); 
	 
	      if (empty($forwardConfig))
	        $forwardConfig = $actionConfig->findForwardConfig("include"); 
	 
	      //obtengo el template
	      $template = $forwardConfig->getPath();
    	}
    } 
    else
      $template = $options['template'];


    $html_result = $smarty->fetch($template); 
    
    //vuelvo a poner el viejo outputfilter de antes
    $smarty->registerFilter('output', array($oldSmartyOutputFilter, 'smarty_add_template'));

    return $html_result;
}
