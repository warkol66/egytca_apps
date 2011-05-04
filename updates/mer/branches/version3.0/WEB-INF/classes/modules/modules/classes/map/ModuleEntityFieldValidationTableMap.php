<?php



/**
 * This class defines the structure of the 'modules_entityFieldValidation' table.
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
class ModuleEntityFieldValidationTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'modules.classes.map.ModuleEntityFieldValidationTableMap';

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
		$this->setName('modules_entityFieldValidation');
		$this->setPhpName('ModuleEntityFieldValidation');
		$this->setClassname('ModuleEntityFieldValidation');
		$this->setPackage('modules.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ENTITYFIELDUNIQUENAME', 'Entityfielduniquename', 'VARCHAR' , 'modules_entityField', 'UNIQUENAME', true, 100, null);
		$this->addPrimaryKey('NAME', 'Name', 'VARCHAR', true, 50, null);
		$this->addColumn('VALUE', 'Value', 'VARCHAR', false, 50, null);
		$this->addColumn('MESSAGE', 'Message', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ModuleEntityField', 'ModuleEntityField', RelationMap::MANY_TO_ONE, array('entityFieldUniqueName' => 'uniqueName', ), 'CASCADE', null);
	} // buildRelations()

} // ModuleEntityFieldValidationTableMap
