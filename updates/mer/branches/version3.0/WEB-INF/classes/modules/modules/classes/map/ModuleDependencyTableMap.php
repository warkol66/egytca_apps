<?php



/**
 * This class defines the structure of the 'modules_dependency' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.modules.classes.map
 */
class ModuleDependencyTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'modules.classes.map.ModuleDependencyTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('modules_dependency');
		$this->setPhpName('ModuleDependency');
		$this->setClassname('ModuleDependency');
		$this->setPackage('modules.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('MODULENAME', 'Modulename', 'VARCHAR' , 'modules_module', 'NAME', true, 50, null);
		$this->addPrimaryKey('DEPENDENCE', 'Dependence', 'VARCHAR', true, 50, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Module', 'Module', RelationMap::MANY_TO_ONE, array('moduleName' => 'name', ), 'CASCADE', null);
	} // buildRelations()

} // ModuleDependencyTableMap
