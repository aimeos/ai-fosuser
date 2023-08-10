<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2023
 */


return array(
	'table' => array(
		'fos_user' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->id()->primary( 'pk_fosus_id' );
			$table->string( 'siteid' )->default( '' );

			$table->string( 'email', 180 );
			$table->string( 'email_canonical', 180 );
			$table->string( 'username', 180 );
			$table->string( 'username_canonical', 180 );
			$table->string( 'password' );
			$table->string( 'salt' )->null( true );
			$table->string( 'confirmation_token', 180 )->null( true );
			$table->datetime( 'password_requested_at' )->null( true );
			$table->datetime( 'last_login' )->null( true );
			$table->text( 'roles' )->comment( '(DC2Type:array)' );
			$table->bool( 'enabled' )->default( 1 );
			$table->string( 'company', 100 )->default( '' );
			$table->string( 'vatid', 32 )->default( '' );
			$table->string( 'salutation', 8 )->default( '' );
			$table->string( 'title', 64 )->default( '' );
			$table->string( 'firstname', 64 )->default( '' );
			$table->string( 'lastname', 64 )->default( '' );
			$table->string( 'address1', 200 )->default( '' );
			$table->string( 'address2', 200 )->default( '' );
			$table->string( 'address3', 200 )->default( '' );
			$table->string( 'postal', 16 )->default( '' );
			$table->string( 'city', 200 )->default( '' );
			$table->string( 'state', 200 )->default( '' );
			$table->string( 'langid', 5 )->null( true );
			$table->string( 'countryid', 2 )->null( true );
			$table->string( 'telephone', 32 )->default( '' );
			$table->string( 'telefax', 32 )->default( '' );
			$table->string( 'website' )->default( '' );
			$table->float( 'longitude' )->null( true );
			$table->float( 'latitude' )->null( true );
			$table->date( 'birthday' )->null( true );
			$table->date( 'vdate' )->null( true );
			$table->datetime( 'mtime' );
			$table->datetime( 'ctime' );
			$table->string( 'editor' )->default( '' );

			$table->unique( ['confirmation_token'], 'unq_fosus_confirmtoken' );
			$table->unique( ['username_canonical'], 'unq_fosus_username' );
			$table->unique( ['email_canonical'], 'unq_fosus_email' );
			$table->index( ['langid', 'siteid'], 'idx_fosus_langid_sid' );
			$table->index( ['lastname', 'firstname'], 'idx_fosus_last_first' );
			$table->index( ['postal', 'address1'], 'idx_fosus_post_addr1' );
			$table->index( ['postal', 'city'], 'idx_fosus_post_city' );
			$table->index( ['city'], 'idx_fosus_city' );
		},

		'fos_user_address' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->id()->primary( 'pk_fosad_id' );
			$table->string( 'siteid' );
			$table->bigint( 'parentid' )->unsigned( true );
			$table->string( 'company', 100 );
			$table->string( 'vatid', 32 );
			$table->string( 'salutation', 8 );
			$table->string( 'title', 64 );
			$table->string( 'firstname', 64 );
			$table->string( 'lastname', 64 );
			$table->string( 'address1', 200 );
			$table->string( 'address2', 200 );
			$table->string( 'address3', 200 );
			$table->string( 'postal', 16 );
			$table->string( 'city', 200 );
			$table->string( 'state', 200 );
			$table->string( 'langid', 5 )->null( true );
			$table->string( 'countryid', 2 )->null( true );
			$table->string( 'telephone', 32 );
			$table->string( 'telefax', 32 );
			$table->string( 'email' );
			$table->string( 'website' );
			$table->float( 'longitude' )->null( true );
			$table->float( 'latitude' )->null( true );
			$table->date( 'birthday' )->null( true );
			$table->smallint( 'pos' );
			$table->meta();

			$table->index( ['langid', 'siteid'], 'idx_fosad_langid_sid' );
			$table->index( ['lastname', 'firstname'], 'idx_fosad_last_first' );
			$table->index( ['postal', 'address1'], 'idx_fosad_post_addr1' );
			$table->index( ['postal', 'city'], 'idx_fosad_post_ci' );
			$table->index( ['city'], 'idx_fosad_city' );
			$table->index( ['email'], 'idx_fosad_email' );

			$table->foreign( 'parentid', 'fos_user', 'id', 'fk_fosad_pid' );
		},

		'fos_user_list_type' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->id()->primary( 'pk_foslity_id' );
			$table->string( 'siteid' );
			$table->string( 'domain', 32 );
			$table->code();
			$table->string( 'label' );
			$table->int( 'pos' )->default( 0 );
			$table->smallint( 'status' );
			$table->meta();

			$table->unique( ['domain', 'code', 'siteid'], 'unq_foslity_dom_code_sid' );
			$table->index( ['status', 'siteid', 'pos'], 'idx_foslity_status_sid_pos' );
			$table->index( ['label', 'siteid'], 'idx_foslity_label_sid' );
			$table->index( ['code', 'siteid'], 'idx_foslity_code_sid' );
		},

		'fos_user_list' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->id()->primary( 'pk_fosli_id' );
			$table->string( 'siteid' );
			$table->bigint( 'parentid' )->unsigned( true );
			$table->string( 'key', 134 )->default( '' );
			$table->type( 'type' );
			$table->string( 'domain', 32 );
			$table->refid();
			$table->startend();
			$table->config();
			$table->int( 'pos' );
			$table->smallint( 'status' );
			$table->meta();

			$table->unique( ['parentid', 'domain', 'type', 'refid', 'siteid'], 'unq_fosli_pid_dm_ty_rid_sid' );
			$table->index( ['key', 'siteid'], 'idx_fosli_key_sid' );

			$table->foreign( 'parentid', 'fos_user', 'id', 'fk_fosli_pid' );
		},

		'fos_user_property_type' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->id()->primary( 'pk_fosprty_id' );
			$table->string( 'siteid' );
			$table->string( 'domain', 32 );
			$table->code();
			$table->string( 'label' );
			$table->int( 'pos' )->default( 0 );
			$table->smallint( 'status' );
			$table->meta();

			$table->unique( ['domain', 'code', 'siteid'], 'unq_fosprty_dom_code_sid' );
			$table->index( ['status', 'siteid', 'pos'], 'idx_fosprty_status_sid_pos' );
			$table->index( ['label', 'siteid'], 'idx_fosprty_label_sid' );
			$table->index( ['code', 'siteid'], 'idx_fosprty_code_sid' );
		},

		'fos_user_property' => function( \Aimeos\Upscheme\Schema\Table $table ) {

			$table->engine = 'InnoDB';

			$table->bigid()->primary( 'pk_fosuspr_id' );
			$table->string( 'siteid' );
			$table->bigint( 'parentid' )->unsigned( true );
			$table->string( 'key', 255 )->default( '' );
			$table->type();
			$table->string( 'langid', 5 )->null( true );
			$table->string( 'value' );
			$table->meta();

			$table->unique( ['parentid', 'type', 'langid', 'value', 'siteid'], 'unq_fospr_pid_ty_lid_val_sid' );
			$table->index( ['key', 'siteid'], 'idx_fosuspr_key_sid' );

			$table->foreign( 'parentid', 'fos_user', 'id', 'fk_fospr_pid' );
		},
	),
);
