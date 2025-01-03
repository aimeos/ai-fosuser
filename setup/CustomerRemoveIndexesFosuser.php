<?php

/**
 * @license LGPLv3, https://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2022-2025
 */


namespace Aimeos\Upscheme\Task;


class CustomerRemoveIndexesFosuser extends Base
{
	public function after() : array
	{
		return ['Customer'];
	}


	public function up()
	{
		$this->info( 'Remove customer indexes with siteid column first', 'vv' );

		$this->db( 'db-customer' )
			->dropIndex( 'fos_user', 'idx_fosus_langid' )
			->dropIndex( 'fos_user', 'idx_fosus_lastname' )
			->dropIndex( 'fos_user', 'idx_fosus_address1' )
			->dropIndex( 'fos_user_address', 'idx_fosad_pid' )
			->dropIndex( 'fos_user_address', 'idx_fosad_address1' )
			->dropIndex( 'fos_user_address', 'idx_fosad_langid' )
			->dropIndex( 'fos_user_address', 'idx_fosad_langid' )
			->dropIndex( 'fos_user_address', 'idx_fosad_langid' )
			->dropIndex( 'fos_user_list', 'unq_fosli_pid_dm_sid_ty_rid' )
			->dropIndex( 'fos_user_list_type', 'unq_foslity_sid_dom_code' )
			->dropIndex( 'fos_user_list_type', 'idx_foslity_sid_status_pos' )
			->dropIndex( 'fos_user_list_type', 'idx_foslity_sid_label' )
			->dropIndex( 'fos_user_list_type', 'idx_foslity_sid_code' )
			->dropIndex( 'fos_user_property', 'fk_fospr_key_sid' )
			->dropIndex( 'fos_user_property', 'unq_fospr_sid_ty_lid_value' )
			->dropIndex( 'fos_user_property_type', 'unq_fosprty_sid_dom_code' )
			->dropIndex( 'fos_user_property_type', 'idx_fosprty_sid_status_pos' )
			->dropIndex( 'fos_user_property_type', 'idx_fosprty_sid_label' )
			->dropIndex( 'fos_user_property_type', 'idx_fosprty_sid_code' )
			->dropIndex( 'fos_user_property_type', 'fk_fospr_key_sid' );
	}
}
