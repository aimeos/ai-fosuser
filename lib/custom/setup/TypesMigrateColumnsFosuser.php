<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Adds the new type columns
 */
class TypesMigrateColumnsFosuser extends \Aimeos\MW\Setup\Task\TypesMigrateColumns
{
	private $tables = [
		'db-customer' => ['fos_user_list', 'fos_user_property'],
	];

	private $constraints = [
		'db-customer' => ['fos_user_list' => 'unq_fosli_sid_dm_rid_tid_pid', 'fos_user_property' => 'unq_fospr_sid_tid_lid_value'],
	];

	private $migrations = [
		'db-customer' => [
			'fos_user_list' => 'UPDATE "fos_user_list" SET "type" = ( SELECT "code" FROM "fos_user_list_type" AS t WHERE t."id" = "typeid" AND t."domain" = "domain" LIMIT 1 ) WHERE "type" IS NULL',
			'fos_user_property' => 'UPDATE "fos_user_property" SET "type" = ( SELECT "code" FROM "fos_user_property_type" AS t WHERE t."id" = "typeid" AND t."domain" = "domain" LIMIT 1 ) WHERE "type" IS NULL',
		],
	];


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return array List of task names
	 */
	public function getPostDependencies()
	{
		return ['TablesCreateMShop'];
	}


	/**
	 * Executes the task
	 */
	public function migrate()
	{
		$this->msg( sprintf( 'Add new type columns for FosUser' ), 0 );
		$this->status( '' );

		foreach( $this->tables as $rname => $list ) {
			$this->addColumn( $rname, $list );
		}

		$this->msg( sprintf( 'Drop old unique indexes for FosUser' ), 0 );
		$this->status( '' );

		foreach( $this->constraints as $rname => $list ) {
			$this->dropIndex( $rname, $list );
		}

		$this->msg( sprintf( 'Migrate typeid to type for FosUser' ), 0 );
		$this->status( '' );

		foreach( $this->migrations as $rname => $list ) {
			$this->migrateData( $rname, $list );
		}
	}
}
