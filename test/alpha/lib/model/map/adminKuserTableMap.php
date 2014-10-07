<?php


/**
 * This class defines the structure of the 'admin_kuser' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package Core
 * @subpackage model.map
 */
class adminKuserTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'Core.adminKuserTableMap';

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
		$this->setName('admin_kuser');
		$this->setPhpName('adminKuser');
		$this->setClassname('adminKuser');
		$this->setPackage('Core');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('SCREEN_NAME', 'ScreenName', 'VARCHAR', false, 20, null);
		$this->addColumn('FULL_NAME', 'FullName', 'VARCHAR', false, 40, null);
		$this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 50, null);
		$this->addColumn('SHA1_PASSWORD', 'Sha1Password', 'VARCHAR', false, 40, null);
		$this->addColumn('SALT', 'Salt', 'VARCHAR', false, 32, null);
		$this->addColumn('PICTURE', 'Picture', 'VARCHAR', false, 48, null);
		$this->addColumn('ICON', 'Icon', 'TINYINT', false, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		$this->addForeignKey('PARTNER_ID', 'PartnerId', 'INTEGER', 'partner', 'ID', false, null, null);
		$this->addColumn('LOGIN_BLOCKED_UNTIL', 'LoginBlockedUntil', 'TIMESTAMP', false, null, null);
		$this->addColumn('CUSTOM_DATA', 'CustomData', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Partner', 'Partner', RelationMap::MANY_TO_ONE, array('partner_id' => 'id', ), null, null);
	} // buildRelations()

} // adminKuserTableMap
