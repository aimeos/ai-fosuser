<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018-2024
 */


 namespace Aimeos\Upscheme\Task;


/**
 * Adds the new type columns
 */
class TypesMigrateColumnsFosuser extends TypesMigrateColumns
{
	private $tables = [
		'db-customer' => ['fos_user_list', 'fos_user_property'],
	];

	private $constraints = [
		'db-customer' => ['fos_user_list' => 'unq_mcusli_sid_dm_rid_tid_pid', 'fos_user_property' => 'unq_mcuspr_sid_tid_lid_value'],
	];

	private $migrations = [
		'db-customer' => [
			'fos_user_list' => 'UPDATE fos_user_list SET type = ( SELECT code FROM fos_user_list_type AS t WHERE t.id = typeid AND t.domain = domain ) WHERE type = \'\'',
			'fos_user_property' => 'UPDATE fos_user_property SET type = ( SELECT code FROM fos_user_property_type AS t WHERE t.id = typeid AND t.domain = domain ) WHERE type = \'\'',
		],
	];

	private $drops = [
		'db-customer' => ['fos_user_list' => 'fk_fosusli_typeid', 'fos_user_property' => 'fk_fosuspr_typeid'],
	];


	/**
	 * Executes the task
	 */
	public function up()
	{
		$db = $this->db( 'db-customer' );

		if( !$db->hasTable( 'fos_user' ) ) {
			return;
		}

		$this->info( 'Migrate typeid to type for FosUser', 'vv' );

		$this->info( 'Add new type columns for FosUser', 'vv', 1 );

		foreach( $this->tables as $rname => $list ) {
			$this->addColumn( $rname, $list );
		}

		$this->info( 'Drop old unique indexes for FosUser', 'vv', 1 );

		foreach( $this->constraints as $rname => $list ) {
			$this->dropIndex( $rname, $list );
		}

		$this->info( 'Migrate typeid to type for FosUser', 'vv', 1 );

		foreach( $this->migrations as $rname => $list ) {
			$this->migrateData( $rname, $list );
		}

		$this->info( 'Drop typeid columns for FosUser', 'vv', 1 );

		foreach( $this->drops as $rname => $list ) {
			$this->dropColumn( $rname, $list );
		}
	}
}
