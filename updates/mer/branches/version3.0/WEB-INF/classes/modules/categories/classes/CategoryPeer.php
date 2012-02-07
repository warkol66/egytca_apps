<?php



/**
 * Skeleton subclass for performing query and update operations on the 'MER_category' table.
 *
 * Categorias
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.categories.classes
 */
class CategoryPeer extends BaseCategoryPeer {

  /**
  * Crea una categoria nueva.
  *
  * @param string $name Nombre de la categoria
  * @return boolean true si se creo la categoria correctamente, false sino
	*/
	function create($name) {
		$category = new Category();
		$category->setName($name);
		$category->setActive(1);
		$category->setHierarchyActors(8);
		$category->save();
		return $category->getId();
	}

  /**
  * Actualiza la informacion de una categoria.
  *
  * @param int $id Id de la categoria
  * @param string $name Nombre de la categoria
  * @param int $hierarchyActors Cantidad maxima de actores clave de la categoria
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$hierarchyActors) {
		$category = CategoryPeer::retrieveByPK($id);
		$category->setName($name);
		$category->setHierarchyActors($hierarchyActors);
		$category->save();
		return true;
  }

	/**
	* Indica si existe un categoria con un id especifico.
	*
  * @param int $id Id del category
	*	@return boolean true si existe la category, false sino
	*/
  function exists($id) {
		$obj = CategoryPeer::retrieveByPK($id);
		if (empty($obj))
			return false;
		else return true;
  }
  
	/**
	* Elimina una categoria a partir del id.
	*
  * @param int $id Id del category
	*	@return boolean true si se elimino correctamente el category, false sino
	*/
  function delete($id) {
		require("ActorPeer.php");
		$actorPeer = new ActorPeer();
		$actors = $actorPeer->getByCategory($id);
		if ( empty($actors) ) {
			$category = CategoryPeer::retrieveByPk($id);
			$category->setActive(0);
			$category->save();
			return true;
		}
		else
    	return false;
  }

  /**
  * Obtiene la informacion de un categoria.
  *
  * @param int $id Id de la categoria
  * @return Category Informacion de la categoria
  */
  function get($id) {
   	$obj = CategoryPeer::retrieveByPK($id);
		return $obj;
  }

  /**
  * Obtiene todas las categorias.
	*
	*	@return array Informacion sobre todas las categories
  */
	function getAll() {
		$cond = new Criteria();
		$cond->add(CategoryPeer::ACTIVE, 1);
		$todosObj = CategoryPeer::doSelect($cond);
		return $todosObj;
  }

   /**
    * Return an array with all the actors this user can access
    *
    * @param User $user
    * @return array of Actor
    */
  function getUserCategories($user){
  	if ($user->isAdmin() || $user->isSupervisor())
  		return CategoryPeer::getAll();
  	$sql = "SELECT ".CategoryPeer::TABLE_NAME.".* FROM ".UserGroupPeer::TABLE_NAME ." ,".
						GroupCategoryPeer::TABLE_NAME .", ".CategoryPeer::TABLE_NAME .
						" where ".UserGroupPeer::USERID ." = '".$user->getId()."' and ".
						UserGroupPeer::GROUPID ." = ".GroupCategoryPeer::GROUPID ." and ".
						GroupCategoryPeer::CATEGORYID ." = ".CategoryPeer::ID ." and ".
						CategoryPeer::ACTIVE ." = 1";
  	
  	$con = Propel::getConnection(parent::DATABASE_NAME);
    $stmt = $con->createStatement();
    $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);    
    return parent::populateObjects($rs);	  	
  }

} // CategoryPeer
