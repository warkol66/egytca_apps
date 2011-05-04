<?php



/**
 * This class defines the structure of the 'MER_document' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.documents.classes.map
 */
class DocumentTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'documents.classes.map.DocumentTableMap';

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
		$this->setName('MER_document');
		$this->setPhpName('Document');
		$this->setClassname('Document');
		$this->setPackage('documents.classes');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('FILENAME', 'Filename', 'VARCHAR', false, 255, null);
		$this->addColumn('REALFILENAME', 'Realfilename', 'VARCHAR', false, 255, null);
		$this->addColumn('DATE', 'Date', 'DATE', false, null, null);
		$this->addForeignKey('CATEGORYID', 'Categoryid', 'INTEGER', 'MER_category', 'ID', false, null, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('DOCUMENT_DATE', 'DocumentDate', 'DATE', false, null, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 32, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('categoryId' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // DocumentTableMap
