<?php



/**
 * This class defines the structure of the 'MER_form' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.mer.classes.map
 */
class FormTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.FormTableMap';

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
		$this->setName('MER_form');
		$this->setPhpName('Form');
		$this->setClassname('Form');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('RELATIONSHIP', 'Relationship', 'BOOLEAN', true, null, false);
		$this->addForeignKey('ROOTSECTIONID', 'Rootsectionid', 'INTEGER', 'MER_formSection', 'ID', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('FormSection', 'FormSection', RelationMap::MANY_TO_ONE, array('rootSectionId' => 'id', ), null, null);
	} // buildRelations()

} // FormTableMap
