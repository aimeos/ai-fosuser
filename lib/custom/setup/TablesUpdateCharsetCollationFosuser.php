<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2019
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Updates the charset and collations
 */
class TablesUpdateCharsetCollationFosuser extends \Aimeos\MW\Setup\Task\TablesUpdateCharsetCollation
{
	private $tables = [
		'db-customer' => [
			'fos_user' => 'code', 'fos_user_address' => 'email',
			'fos_user_list_type' => 'code', 'fos_user_list' => 'refid',
			'fos_user_property_type' => 'code', 'fos_user_property' => 'value',
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
		$this->msg( 'Update charset and collation for FosUser tables', 0 );
		$this->status( '' );

		foreach( $this->tables as $rname => $list ) {
			$this->checkTables( $list, $rname );
		}
	}
}
