<?php



/**
 * This class defines the structure of the 'MER_graphModelJudgement' table.
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
class GraphModelJudgementTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'mer.classes.map.GraphModelJudgementTableMap';

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
		$this->setName('MER_graphModelJudgement');
		$this->setPhpName('GraphModelJudgement');
		$this->setClassname('GraphModelJudgement');
		$this->setPackage('mer.classes');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('GRAPHID', 'Graphid', 'INTEGER' , 'MER_graphModel', 'ID', true, null, null);
		$this->addPrimaryKey('QUADRANT', 'Quadrant', 'INTEGER', true, null, null);
		$this->addColumn('JUDGEMENT', 'Judgement', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('GraphModel', 'GraphModel', RelationMap::MANY_TO_ONE, array('graphId' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // GraphModelJudgementTableMap
