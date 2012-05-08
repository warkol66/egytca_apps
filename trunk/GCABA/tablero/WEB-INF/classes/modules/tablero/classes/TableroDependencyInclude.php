<?php

include_once 'TableroDependencyPeer.php';

/**
 * Dependencias.
 *
 * @package tablero
 */
class TableroDependencyInclude extends TableroDependencyPeer {

	function getTableroDependenciesNav($options)
	{
		$dependencies[dependencies] = TableroDependencyPeer::getAllForIndex();
				$dependenciesToMap = array(
					"VIALIDAD",
					"IPRODHA",
					"ARQUITECTURA",
					"UEP-PROMEBA"
				);

		$i = 0;

		foreach ($dependenciesToMap as $dependency) {
			$depdendencyObjs[$i] = TableroDependencyPeer::getByName($dependency);
			$i ++;
		}
		$dependencies[depdendencyObjs] = $depdendencyObjs;
		return $dependencies;
	}

	function getTableroDependenciesConstruction($options)
	{

		$dependenciesToIndex = array(
					"VIALIDAD",
					"IPRODHA",
					"ARQUITECTURA",
					"UEP-PROMEBA"
				);

		$i = 0;

		foreach ($dependenciesToIndex as $dependency) {
			$depdendencyObjs[$i] = AffiliateQuery::create()->findOneByName($dependency);
			$i ++;
		}

		$dependencies = TableroDependencyPeer::getAllForConstruction($depdendencyObjs);
		return $dependencies;
	}

} // DependencyInclude
