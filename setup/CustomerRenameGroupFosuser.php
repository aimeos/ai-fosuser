<?php

/**
 * @license LGPLv3, https://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org)2023-2024
 */


namespace Aimeos\Upscheme\Task;


class CustomerRenameGroupFosuser extends CustomerRenameGroup
{
	public function before() : array
	{
		return ['Customer', 'Group'];
	}


	public function up()
	{
		$this->info( 'Migrate FOS user "customer/group" domain to "group"', 'vv' );

		$this->update( 'fos_user_list' );
	}
}
