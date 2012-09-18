<?php
 
/**
 *
 * @package    users
 * @subpackage groups
 */

class UserGroupPeer extends BaseUserGroupPeer {

	/**
	* Obtiene la informacion de un grupo.
	*
	* @param int $id Id del grupo
	* @return array Grupo
	*/
	function get($id){
		$group = GroupPeer::retrieveByPK($id);
		return $group;
	}

}
