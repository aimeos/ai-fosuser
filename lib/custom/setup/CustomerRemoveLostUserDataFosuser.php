<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018
 */


namespace Aimeos\MW\Setup\Task;


/**
 * Removes address and list records without user entry
 */
class CustomerRemoveLostUserDataFosuser extends \Aimeos\MW\Setup\Task\Base
{
	private $sql = [
		'fos_user_address' => 'DELETE FROM "fos_user_address" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )',
		'fos_user_list' => 'DELETE FROM "fos_user_list" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )',
		'fos_user_property' => 'DELETE FROM "fos_user_property" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )',
	];


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function getPostDependencies()
	{
		return ['TablesCreateMShop'];
	}


	/**
	 * Migrate database schema
	 */
	public function migrate()
	{
		$this->msg( 'Remove left over FOS user references', 0, '' );

		foreach( $this->sql as $table => $stmt )
		{
			$this->msg( sprintf( 'Remove unused %1$s records', $table ), 1 );

			if( $this->schema->tableExists( 'fos_user' ) && $this->schema->tableExists( $table ) )
			{
				$this->execute( $stmt );
				$this->status( 'done' );
			}
			else
			{
				$this->status( 'OK' );
			}
		}
	}
}
