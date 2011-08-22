<?php



/**
 * Skeleton subclass for performing query and update operations on the 'clients_group' table.
 *
 * Groups
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.clients.classes
 */
class ClientGroupPeer extends BaseClientGroupPeer {

	/**
	* Obtiene todos los grupos de usuarios.
	*
	*	@return array Informacion sobre todos los grupos de usuarios
	*/
	function getAll() {
		return ClientGroupQuery::create()->find();
	}

	/**
	* Crea un grupo de usuarios nuevo.
	*
	* @param string $name Nombre del grupo de usuarios
	* @return boolean true si se creo el grupo de usuarios correctamente, false sino
	*/
	function create($params) {
		$group = new ClientGroup();
		Common::setObjectFromParams($group, $params);
		return $group->save();
	}

	/**
	* Elimina un grupo de usuarios a partir del id.
	*
		* @param int $id Id del grupo de usuarios
	*	@return cantidad de registros eliminados
	*/
	function delete($id) {
		return ClientGroupQuery::create()->filterByPrimaryKey($id)->delete();
	}

	/**
	* Obtiene la informacion de un grupo de usuarios.
	*
	* @param int $id Id del grupo de usuarios
	* @return array Informacion del grupo de usuarios
	*/
	function get($id) {
		return ClientGroupQuery::create()->findPK($id);
	}

	/**
	* Actualiza la informacion de un grupo de usuarios.
	*
	* @param int $id Id del grupo de usuarios
	* @param string $name Nombre del grupo de usuarios
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$name) {
		$group = ClientGroupPeer::get($id);
		Common::setObjectFromParams($group, $params);
		return $group->save();
	}

	/**
	* Obtiene las categorias que puede acceder un grupos de usuarios.
	*
	* @param int $id Id del grupo
	* @return array Categorias
	*/
	function getCategoriesByGroup($id) {
		$group = ClientGroupPeer::get($id);
		return CategoryQuery::create()->filterByClientGroup($group)->find();
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
	* @return cantidad de registros eliminados.
	*/
	function removeCategoryFromGroup($category,$group) {
		return ClientGroupCategoryQuery::create()->filterByCategoryId($category)
													->filterByGroupId($group)
													->delete();
	}

} // ClientGroupPeer
