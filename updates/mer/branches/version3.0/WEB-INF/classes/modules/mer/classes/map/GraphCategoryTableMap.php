<?php



/**
 * This class defines the structure of the 'MER_graphCategory' table.
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
class GraphCategoryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.GraphCategoryTableMap';

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
		$this->setName('MER_graphCategory');
		$this->setPhpName('GraphCategory');
		$this->setClassname('GraphCategory');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('GRAPHID', 'Graphid', 'INTEGER' , 'MER_graphModel', 'ID', true, null, null);
		$this->addForeignPrimaryKey('CATEGORYID', 'Categoryid', 'INTEGER' , 'MER_category', 'ID', true, null, null);
		$this->addColumn('JUDGEMENT', 'Judgement', 'VARCHAR', false, 255, null);
		$this->addColumn('OLD', 'Old', 'INTEGER', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('GraphModel', 'GraphModel', RelationMap::MANY_TO_ONE, array('graphId' => 'id', ), 'CASCADE', null);
    $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('categoryId' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // GraphCategoryTableMap
