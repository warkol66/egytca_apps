<?php



/**
 * This class defines the structure of the 'multilang_text' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.multilang.classes.map
 */
class MultilangTextTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'multilang.classes.map.MultilangTextTableMap';

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
		$this->setName('multilang_text');
		$this->setPhpName('MultilangText');
		$this->setClassname('MultilangText');
		$this->setPackage('multilang.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignPrimaryKey('MODULENAME', 'Modulename', 'VARCHAR' , 'modules_module', 'NAME', true, 255, null);
		$this->addForeignPrimaryKey('LANGUAGECODE', 'Languagecode', 'VARCHAR' , 'multilang_language', 'CODE', true, 30, null);
		$this->addColumn('TEXT', 'Text', 'LONGVARCHAR', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('MultilangLanguage', 'MultilangLanguage', RelationMap::MANY_TO_ONE, array('languageCode' => 'code', ), 'CASCADE', null);
    $this->addRelation('Module', 'Module', RelationMap::MANY_TO_ONE, array('moduleName' => 'name', ), null, null);
	} // buildRelations()

} // MultilangTextTableMap
