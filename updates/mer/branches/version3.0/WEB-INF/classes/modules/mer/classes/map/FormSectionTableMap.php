<?php



/**
 * This class defines the structure of the 'MER_formSection' table.
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
class FormSectionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.FormSectionTableMap';

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
		$this->setName('MER_formSection');
		$this->setPhpName('FormSection');
		$this->setClassname('FormSection');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('PARENTSECTIONID', 'Parentsectionid', 'INTEGER', 'MER_formSection', 'ID', false, null, null);
		$this->addColumn('POSITION', 'Position', 'INTEGER', true, null, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('FormSectionRelatedByParentsectionid', 'FormSection', RelationMap::MANY_TO_ONE, array('parentSectionId' => 'id', ), 'CASCADE', null);
    $this->addRelation('Form', 'Form', RelationMap::ONE_TO_MANY, array('id' => 'rootSectionId', ), null, null);
    $this->addRelation('FormSectionRelatedById', 'FormSection', RelationMap::ONE_TO_MANY, array('id' => 'parentSectionId', ), 'CASCADE', null);
    $this->addRelation('Question', 'Question', RelationMap::ONE_TO_MANY, array('id' => 'sectionId', ), 'CASCADE', null);
	} // buildRelations()

} // FormSectionTableMap
