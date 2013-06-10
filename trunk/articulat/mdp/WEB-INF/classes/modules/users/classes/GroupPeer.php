<?php

/**
 *
 * @package    users
 * @subpackage groups
 */
class GroupPeer extends BaseGroupPeer {

  /**
  * Obtiene todos los grupos de usuarios.
	*
	*	@return array Informacion sobre todos los grupos de usuarios
  */
	function getAll() {
		$cond = new Criteria();
		$todosObj = GroupPeer::doSelect($cond);
		return $todosObj;
  }
  
  /**
  * Crea un grupo de usuarios nuevo.
  *
  * @param string $name Nombre del grupo de usuarios
  * @return boolean true si se creo el grupo de usuarios correctamente, false sino
	*/
  function create($name) {
		$group = new Group();
		$group->setName($name);
		$group->setCreated(time());
		$group->setUpdated(time());
		$group->save();
		return true;
  }
  
	/**
	* Elimina un grupo de usuarios a partir del id.
	*
  * @param int $id Id del grupo de usuarios
	*	@return boolean true si se elimino correctamente el grupo de usuarios, false sino
	*/
  function delete($id) {
		$group = GroupPeer::retrieveByPk($id);
		$group->delete();
		return true;
  }
  
  /**
  * Obtiene la informacion de un grupo de usuarios.
  *
  * @param int $id Id del grupo de usuarios
  * @return array Informacion del grupo de usuarios
  */
  function get($id) {
		$cond = new Criteria();
		$cond->add(GroupPeer::ID, $id);
		$group = GroupPeer::doSelectOne($cond);
		return $group;
  }

  /**
  * Actualiza la informacion de un grupo de usuarios.
  *
  * @param int $id Id del grupo de usuarios
  * @param string $name Nombre del grupo de usuarios
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name) {
		$group = GroupPeer::retrieveByPK($id);
		$group->setName($name);
		$group->setUpdated(time());
		$group->save();
		return true;
  }
  
  /**
  * Obtiene las categorias que puede acceder un grupos de usuarios.
  *
  * @param int $id Id del grupo
  * @return array Categorias
  */
  function getCategoriesByGroup($id) {
		$cond = new Criteria();
		$cond->add(GroupCategoryPeer::GROUPID, $id);
		$todosObj = GroupCategoryPeer::doSelectJoinCategory($cond);
		return $todosObj;
  }
  
  /**
  * Agrega una categoria a un grupo de usuarios.
  *
  * @param int $category Id de la categoria
  * @param int $group Id del grupo de usuarios
  * @return boolean true si se agrego correctamente, false sino
  */
	function addCategoryToGroup($category,$group) {
		try {
			$groupCategory = new GroupCategory();
			$groupCategory->setCategoryId($category);
			$groupCategory->setGroupId($group);
			$groupCategory->save();
			return true;
		}
		catch (PropelException $e) {
			return false;
		}
	}

  /**
  * Elimina una categoria de un grupo de usuarios.
  *
  * @param int $category Id de la categoria
  * @param int $group Id del grupo de usuarios
  * @return boolean true si se elimino correctamente, false sino
  */
	function removeCategoryFromGroup($category,$group) {
		try {
			$cond = new Criteria();
			$cond->add(GroupCategoryPeer::CATEGORYID, $category);
			$cond->add(GroupCategoryPeer::GROUPID, $group);
			$categoryGroup = GroupCategoryPeer::doSelectOne($cond);
			$categoryGroup->delete();
			return true;
		}
		catch (PropelException $e) {
			return false;
		}
	}
	
	/**
	 * Obtains a group by its name
	 * @param string name
	 * @return Group instance
	 */
	public function getByName($name) {
		
		$criteria = new Criteria();
		$criteria->add(GroupPeer::NAME,$name);
		$result = GroupPeer::doSelectOne($criteria);
		if (!empty($result))
			return $result;
		else
			return null;
		
	}

}
