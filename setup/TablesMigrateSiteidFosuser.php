<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019-2023
 */


 namespace Aimeos\Upscheme\Task;


/**
 * Updates site ID columns
 */
class TablesMigrateSiteidFosuser extends TablesMigrateSiteid
{
	private $resources = [
		'db-customer' => [
			'fosuser_list_type', 'fosuser_property_type',
			'fosuser_property', 'fosuser_list', 'fosuser_address', 'fosuser',
		],
	];


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return string[] List of task names
	 */
	public function before() : array
	{
		return ['Customer', 'TablesMigrateSiteid'];
	}


	/**
	 * Executes the task
	 */
	public function up()
	{
		$db = $this->db( 'db-locale' );

		if( !$db->hasTable( 'mshop_locale_site' ) || $db->hasColumn( 'mshop_locale_site', 'siteid' ) ) {
			return;
		}

		$this->info( 'Update FosUser "siteid" columns', 'vv' );

		$this->process( $this->resources );

		$db = $this->db( 'db-customer' );

		if( $db->hasColumn( 'users', 'siteid' ) ) {
			$db->exec( 'UPDATE users SET siteid=\'\' WHERE siteid IS NULL' );
		}
	}
}
