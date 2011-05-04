<?php
/*
* $Header$
* $Revision$
* $Date$
*
* ====================================================================
*
* License:	GNU Lesser General Public License (LGPL)
*
* Copyright (c) 2003 John C.Wildenauer.  All rights reserved.
*
* This file is part of the php.MVC Web applications framework
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU Lesser General Public
* License as published by the Free Software Foundation; either
* version 2.1 of the License, or (at your option) any later version.

* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
* Lesser General Public License for more details.

* You should have received a copy of the GNU Lesser General Public
* License along with this library; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/**
* <p>The SET of Digester rules required to parse a php.MVC application
* configuration file (<code>phpmvc-config.xml</code>).</p>
*
* @author John C. Wildenauer (php.MVC port)<br>
*  Craig R. McClanahan (original Struts class)
* @version $Revision$
*/ 
class ConfigRuleSet extends RuleSetBase {

	// ----- Public Methods --------------------------------------------- //

	/**
	* <p>Add the SET of Rule instances defined in this RuleSet to the
	* specified <code>Digester</code> instance, associating them with
	*
	* @param digester Digester, an XML digester object
	* @access public
	* @return void
	*/

	function addRuleInstances(&$digester) {

		$applicationPattern		= 'phpmvc-config';

		// DataSourceConfig
		$dataSourcesPattern		= 'phpmvc-config/data-sources';
		$dataSourcePattern		= 'phpmvc-config/data-sources/data-source';

		// ActionConfig
		$actionMappingsPattern	= 'phpmvc-config/action-mappings';
		$actionMappingPattern	= 'phpmvc-config/action-mappings/action';
		$actionForwardPattern	= 'phpmvc-config/action-mappings/action/forward';

		// FormBean
		$formBeansPattern			= 'phpmvc-config/form-beans';
		$formBeanPattern			= 'phpmvc-config/form-beans/form-bean';

		// ControllerConfig
		$controllerConfigpattern= 'phpmvc-config/controller';

		// PlugIns
		$plugInPattern				= 'phpmvc-config/plug-in';
		$setPlugInPropPattern	= 'phpmvc-config/plug-in/set-property';

		// GlobForwards
		#$globForwardsPattern	= 'star/global-forwards';	// star = *
		#$setPropertyPattern		= 'phpmvc-config/my-object/property';


		// DataSourceConfig <data-source ...>
		// ----------------------------------- //
		// Create a new configuration object ('DataSourceConfig')
		$digester->addObjectCreate(
							$dataSourcePattern,	// <data-source ...>
							'DataSourceConfig',	// config class to build
							'className');			// [optional] specify an alternate to 
														// the default 'DataSourceConfig' config 
														// file, if this attribute is present in
														// the phpmvc-config xml descriptor file
														// Eg: 
														// <data-source ... className="MyDataSourceConfig">
		// SET the configuration objects properties
		// phpmvc-config xml descriptor file attributes must match the target object methods
	 	// Eg: "driverClassName" maps to "BasicDataSource->setDriverClassName"
		$digester->addSetProperties($dataSourcePattern);
		// Add a back reference to bind the configuration object to its parent
		// (ApplicationConfig) object.
		// Eg: Rule(pattern-to-match, ApplicationConfig->addDataSourceConfig(dataSourceConfig))
		$digester->addSetNext($dataSourcePattern, 'addDataSourceConfig');		


		// ActionConfig
		// ----------------------------------- //
		$digester->addObjectCreate($actionMappingPattern, 'ActionConfig');
		$digester->addSetProperties($actionMappingPattern);
		$digester->addSetNext($actionMappingPattern, 'addActionConfig');	

		$digester->addObjectCreate($actionForwardPattern, 'ForwardConfig');
		$digester->addSetProperties($actionForwardPattern);
		$digester->addSetNext($actionForwardPattern, 'addForwardConfig');	


		// FormBeanConfig
		// ----------------------------------- //
		$digester->addObjectCreate($formBeanPattern, 'FormBeanConfig');
		$digester->addSetProperties($formBeanPattern);
		$digester->addSetNext($formBeanPattern, 'addFormBeanConfig');	


		// ControllerConfig
		// ----------------------------------- //
        $digester->addObjectCreate($controllerConfigpattern, 'ControllerConfig', 'className');
        $digester->addSetProperties($controllerConfigpattern);
        $digester->addSetNext($controllerConfigpattern, 'setControllerConfig', 'ControllerConfig');


		// PlugIns Config
		// ----------------------------------- //
			// Class (NULL) name MUST be specified in the xml element (<plug-in classname="MyPluginClass" ...>
        $digester->addObjectCreate('phpmvc-config/plug-in', NULL, 'className');
        $digester->addSetProperties('phpmvc-config/plug-in');
        $digester->addSetNext('phpmvc-config/plug-in', 'addPlugIn', 'phpmvc.action.PlugIn');
        $digester->addSetProperty($setPlugInPropPattern, 'property', 'value');

    }

} // end class ConfigRuleSet


?>