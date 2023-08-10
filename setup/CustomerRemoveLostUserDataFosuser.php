<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018-2023
 */


 namespace Aimeos\Upscheme\Task;


/**
 * Removes address and list records without user entry
 */
class CustomerRemoveLostUserDataFosuser extends Base
{
	private $sql = [
		'fos_user_address' => [
			'fk_fosad_pid' => 'DELETE FROM "fos_user_address" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
		'fos_user_list' => [
			'fk_fosli_pid' => 'DELETE FROM "fos_user_list" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
		'fos_user_property' => [
			'fk_fospr_pid' => 'DELETE FROM "fos_user_property" WHERE NOT EXISTS ( SELECT "id" FROM "fos_user" AS u WHERE "parentid"=u."id" )'
		],
	];


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return string[] List of task names
	 */
	public function before() : array
	{
		return ['Customer'];
	}


	/**
	 * Migrate database schema
	 */
	public function up()
	{
		$db = $this->db( 'db-customer' );

		if( !$db->hasTable( 'fos_user' ) ) {
			return;
		}

		$this->info( 'Remove left over FosUser references', 'vv' );

		foreach( $this->sql as $table => $map )
		{
			foreach( $map as $constraint => $sql )
			{
				if( $db->hasTable( $table ) && !$db->hasForeign( $table, $constraint ) )
				{
					$this->info( sprintf( 'Remove records from %1$s', $table ), 'vv', 1 );
					$db->exec( $sql );
				}
			}
		}
	}
}
