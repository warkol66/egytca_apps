<?php


/**
 * Skeleton subclass for performing query and update operations on the 'actionLogs_label' table.
 *
 * Etiquetas de logueo
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.common.classes
 */
class ActionLogLabelPeer extends BaseActionLogLabelPeer {

  /**
	* Agrega una etiqueta
	* @param string $actionName nombre del action
	* @param string $language idioma
	* @param string $label etiqueta
	* @param string $forward tipo de forward
	* @return true si salio todo ok
	*/
	
	function add($actionName,$language,$label,$forward) {
		
		$actionLogLabelObj = new ActionLogLabel();
		$actionLogLabelObj->setAction($actionName);
		if ($label != 'label') $actionLogLabelObj ->setLabel($label);
		$actionLogLabelObj ->setLanguage($language);
		$actionLogLabelObj ->setForward($forward);
		$actionLogLabelObj ->save();
		return true;

  }

	/**
	* Obtiene una etiqueta
	* @param string $action nombre del action
	* @param string $forward tipo de forward
	* @param string $language idioma
	* @return object $obj objeto encontrado
	*/

	function getByInfo($action,$forward,$language) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->add(ActionLogLabelPeer::ACTION, $action);
		$criteria->add(ActionLogLabelPeer::LANGUAGE, $language);
		$criteria->add(ActionLogLabelPeer::FORWARD, $forward);
    $obj = ActionLogLabelPeer::doSelectOne($criteria);
    return $obj;
	}

	/**
	* Obtiene una etiqueta
	* @param string $action nombre del action
	* @param string $forward tipo de forward
	* @param string $language idioma
	* @return object $obj objeto encontrado
	*/

	function getAllByInfo($action,$forward,$language) {
		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->add(ActionLogLabelPeer::ACTION, $action);
		$criteria->add(ActionLogLabelPeer::LANGUAGE, $language);
		$criteria->add(ActionLogLabelPeer::FORWARD, $forward);
    $obj = ActionLogLabelPeer::doSelectOne($criteria);
    return $obj;
	}

	/**
	* Obtiene el sql para eliminar los una etiqueta dependiendo el nombre del action y el forward
	* @param string $module nombre del modulo
	* @param string $language código del idioma
	* @return string $sql para eliminar registros
	*/

	function getSQLCleanup($module,$language) {
		$sql = "DELETE FROM `actionLogs_label` WHERE `action` LIKE '" . ucfirst($module) . "%' AND `language` = '" . $language . "';\n";
		$sql .= "OPTIMIZE TABLE `actionLogs_label`;";
		return $sql;
	}

} // ActionLogLabelPeer
