<?php



/**
 * Skeleton subclass for performing query and update operations on the 'clients_userGroup' table.
 *
 * Users / Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientUserGroupPeer extends BaseClientUserGroupPeer {

	/**
	* Obtiene todos los grupos de usuarios.
	*
	*	@return array Informacion sobre todos los grupos de usuarios
	*/
	function getAll() {
		$cond = new Criteria();
		$todosObj = ClientGroupPeer::doSelect($cond);
		return $todosObj;
	}

	/**
	* Crea un grupo de usuarios nuevo.
	*
	* @param string $name Nombre del grupo de usuarios
	* @return boolean true si se creo el grupo de usuarios correctamente, false sino
	*/
	function create($name) {
		$group = new ClientGroup();
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
		$group = ClientGroupPeer::retrieveByPk($id);
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
		$cond->add(ClientGroupPeer::ID, $id);
		$todosObj = ClientGroupPeer::doSelect($cond);
		return $todosObj[0];
	}

	/**
	* Actualiza la informacion de un grupo de usuarios.
	*
	* @param int $id Id del grupo de usuarios
	* @param string $name Nombre del grupo de usuarios
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$name) {
		$group = ClientGroupPeer::retrieveByPK($id);
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
		$cond->add(ClientGroupCategoryPeer::GROUPID, $id);
		$todosObj = ClientGroupCategoryPeer::doSelectJoinCategory($cond);
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
			$groupCategory = new ClientGroupCategory();
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
			$cond->add(ClientGroupCategoryPeer::CATEGORYID, $category);
			$cond->add(ClientGroupCategoryPeer::GROUPID, $group);
			$todosObj = ClientGroupCategoryPeer::doSelect($cond);
			$obj = $todosObj[0];
			$obj->delete();
			return true;
		}
		catch (PropelException $e) {
			return false;
		}
	}

} // ClientUserGroupPeer
