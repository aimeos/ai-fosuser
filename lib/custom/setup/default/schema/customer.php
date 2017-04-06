<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016
 */


return array(
	'table' => array(
		'fos_user' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {

			$table = $schema->createTable( 'fos_user' );

			$table->addColumn( 'id', 'integer', array( 'autoincrement' => true ) );
			$table->addColumn( 'username', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'username_canonical', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'email', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'email_canonical', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'enabled', 'smallint', [] );
			$table->addColumn( 'salt', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'password', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'last_login', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'locked', 'smallint', [] );
			$table->addColumn( 'expired', 'smallint', [] );
			$table->addColumn( 'expires_at', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'confirmation_token', 'string', array( 'length' => 255, 'notnull' => false ) );
			$table->addColumn( 'password_requested_at', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'roles', 'text', array( 'length' => 0x7fffffff, 'comment' => '(DC2Type:array)' ) );
			$table->addColumn( 'credentials_expired', 'smallint', [] );
			$table->addColumn( 'credentials_expire_at', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'salutation', 'string', array( 'length' => 8, 'default' => '' ) );
			$table->addColumn( 'company', 'string', array( 'length' => 100, 'default' => '' ) );
			$table->addColumn( 'vatid', 'string', array( 'length' => 32, 'default' => '' ) );
			$table->addColumn( 'title', 'string', array( 'length' => 64, 'default' => '' ) );
			$table->addColumn( 'firstname', 'string', array( 'length' => 64, 'default' => '' ) );
			$table->addColumn( 'lastname', 'string', array( 'length' => 64, 'default' => '' ) );
			$table->addColumn( 'address1', 'string', array( 'length' => 200, 'default' => '' ) );
			$table->addColumn( 'address2', 'string', array( 'length' => 200, 'default' => '' ) );
			$table->addColumn( 'address3', 'string', array( 'length' => 200, 'default' => '' ) );
			$table->addColumn( 'postal', 'string', array( 'length' => 16, 'default' => '' ) );
			$table->addColumn( 'city', 'string', array( 'length' => 200, 'default' => '' ) );
			$table->addColumn( 'state', 'string', array( 'length' => 200, 'default' => '' ) );
			$table->addColumn( 'langid', 'string', array( 'length' => 5, 'notnull' => false ) );
			$table->addColumn( 'countryid', 'string', array( 'length' => 2, 'notnull' => false, 'fixed' => true ) );
			$table->addColumn( 'telephone', 'string', array( 'length' => 32, 'default' => '' ) );
			$table->addColumn( 'telefax', 'string', array( 'length' => 32, 'default' => '' ) );
			$table->addColumn( 'website', 'string', array( 'length' => 255, 'default' => '' ) );
			$table->addColumn( 'longitude', 'decimal', array( 'precision' => 8, 'scale' => 6, 'notnull' => false ) );
			$table->addColumn( 'latitude', 'decimal', array( 'precision' => 8, 'scale' => 6, 'notnull' => false ) );
			$table->addColumn( 'birthday', 'date', array( 'notnull' => false ) );
			$table->addColumn( 'vdate', 'date', array( 'notnull' => false ) );
			$table->addColumn( 'mtime', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'ctime', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'editor', 'string', array('length' => 255, 'default' => '' ) );

			$table->setPrimaryKey( array( 'id' ), 'pk_fosus_id' );
			$table->addUniqueIndex( array( 'username_canonical' ), 'unq_fosus_username' );
			$table->addUniqueIndex( array( 'email_canonical' ), 'unq_fosus_email' );
			$table->addIndex( array( 'langid' ), 'idx_fosus_langid' );
			$table->addIndex( array( 'lastname', 'firstname' ), 'idx_fosus_last_first' );
			$table->addIndex( array( 'postal', 'address1' ), 'idx_fosus_post_addr1' );
			$table->addIndex( array( 'postal', 'city' ), 'idx_fosus_post_city' );
			$table->addIndex( array( 'lastname' ), 'idx_fosus_lastname' );
			$table->addIndex( array( 'address1' ), 'idx_fosus_address1' );
			$table->addIndex( array( 'city' ), 'idx_fosus_city' );

			return $schema;
		},

		'fos_user_address' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {

			$table = $schema->createTable( 'fos_user_address' );

			$table->addColumn( 'id', 'integer', array( 'autoincrement' => true ) );
			$table->addColumn( 'siteid', 'integer', [] );
			$table->addColumn( 'parentid', 'integer', [] );
			$table->addColumn( 'company', 'string', array( 'length' => 100 ) );
			$table->addColumn( 'vatid', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'salutation', 'string', array( 'length' => 8 ) );
			$table->addColumn( 'title', 'string', array( 'length' => 64 ) );
			$table->addColumn( 'firstname', 'string', array( 'length' => 64 ) );
			$table->addColumn( 'lastname', 'string', array( 'length' => 64 ) );
			$table->addColumn( 'address1', 'string', array( 'length' => 200 ) );
			$table->addColumn( 'address2', 'string', array( 'length' => 200 ) );
			$table->addColumn( 'address3', 'string', array( 'length' => 200 ) );
			$table->addColumn( 'postal', 'string', array( 'length' => 16 ) );
			$table->addColumn( 'city', 'string', array( 'length' => 200 ) );
			$table->addColumn( 'state', 'string', array( 'length' => 200 ) );
			$table->addColumn( 'langid', 'string', array( 'length' => 5, 'notnull' => false ) );
			$table->addColumn( 'countryid', 'string', array( 'length' => 2, 'notnull' => false, 'fixed' => true ) );
			$table->addColumn( 'telephone', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'email', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'telefax', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'website', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'longitude', 'decimal', array( 'precision' => 8, 'scale' => 6, 'notnull' => false ) );
			$table->addColumn( 'latitude', 'decimal', array( 'precision' => 8, 'scale' => 6, 'notnull' => false ) );
			$table->addColumn( 'flag', 'integer', [] );
			$table->addColumn( 'pos', 'smallint', [] );
			$table->addColumn( 'mtime', 'datetime', [] );
			$table->addColumn( 'ctime', 'datetime', [] );
			$table->addColumn( 'editor', 'string', array('length' => 255 ) );

			$table->setPrimaryKey( array( 'id' ), 'pk_fosad_id' );
			$table->addIndex( array( 'parentid' ), 'idx_fosad_pid' );
			$table->addIndex( array( 'lastname', 'firstname' ), 'idx_fosad_last_first' );
			$table->addIndex( array( 'postal', 'address1' ), 'idx_fosad_post_addr1' );
			$table->addIndex( array( 'postal', 'city' ), 'idx_fosad_post_city' );
			$table->addIndex( array( 'address1' ), 'idx_fosad_address1' );
			$table->addIndex( array( 'city' ), 'idx_fosad_city' );
			$table->addIndex( array( 'email' ), 'idx_fosad_email' );

			$table->addForeignKeyConstraint( 'fos_user', array( 'parentid' ), array( 'id' ),
				array( 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE' ), 'fk_fosad_pid' );

			return $schema;
		},

		'fos_user_list_type' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {

			$table = $schema->createTable( 'fos_user_list_type' );

			$table->addColumn( 'id', 'integer', array( 'autoincrement' => true ) );
			$table->addColumn( 'siteid', 'integer', [] );
			$table->addColumn( 'domain', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'code', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'label', 'string', array( 'length' => 255 ) );
			$table->addColumn( 'status', 'smallint', [] );
			$table->addColumn( 'mtime', 'datetime', [] );
			$table->addColumn( 'ctime', 'datetime', [] );
			$table->addColumn( 'editor', 'string', array( 'length' => 255 ) );

			$table->setPrimaryKey( array( 'id' ), 'pk_foslity_id' );
			$table->addUniqueIndex( array( 'siteid', 'domain', 'code' ), 'unq_foslity_sid_dom_code' );
			$table->addIndex( array( 'siteid', 'status' ), 'idx_foslity_sid_status' );
			$table->addIndex( array( 'siteid', 'label' ), 'idx_foslity_sid_label' );
			$table->addIndex( array( 'siteid', 'code' ), 'idx_foslity_sid_code' );

			return $schema;
		},

		'fos_user_list' => function ( \Doctrine\DBAL\Schema\Schema $schema ) {

			$table = $schema->createTable( 'fos_user_list' );

			$table->addColumn( 'id', 'integer', array( 'autoincrement' => true ) );
			$table->addColumn( 'parentid', 'integer', [] );
			$table->addColumn( 'siteid', 'integer', [] );
			$table->addColumn( 'typeid', 'integer', [] );
			$table->addColumn( 'domain', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'refid', 'string', array( 'length' => 32 ) );
			$table->addColumn( 'start', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'end', 'datetime', array( 'notnull' => false ) );
			$table->addColumn( 'config', 'text', array( 'length' => 0xffff ) );
			$table->addColumn( 'pos', 'integer', [] );
			$table->addColumn( 'status', 'smallint', [] );
			$table->addColumn( 'mtime', 'datetime', [] );
			$table->addColumn( 'ctime', 'datetime', [] );
			$table->addColumn( 'editor', 'string', array( 'length' => 255 ) );

			$table->setPrimaryKey( array( 'id' ), 'pk_fosli_id' );
			$table->addUniqueIndex( array( 'siteid', 'domain', 'refid', 'typeid', 'parentid' ), 'unq_fosli_sid_dm_rid_tid_pid' );
			$table->addIndex( array( 'siteid', 'status', 'start', 'end' ), 'idx_fosli_sid_stat_start_end' );
			$table->addIndex( array( 'parentid', 'siteid', 'refid', 'domain', 'typeid' ), 'idx_fosli_pid_sid_rid_dom_tid' );
			$table->addIndex( array( 'parentid', 'siteid', 'start' ), 'idx_fosli_pid_sid_start' );
			$table->addIndex( array( 'parentid', 'siteid', 'end' ), 'idx_fosli_pid_sid_end' );
			$table->addIndex( array( 'parentid', 'siteid', 'pos' ), 'idx_fosli_pid_sid_pos' );

			$table->addForeignKeyConstraint( 'fos_user', array( 'parentid' ), array( 'id' ),
				array( 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE' ), 'fk_fosli_pid' );

			$table->addForeignKeyConstraint( 'fos_user_list_type', array( 'typeid' ), array( 'id' ),
				array( 'onUpdate' => 'CASCADE', 'onDelete' => 'CASCADE' ), 'fk_fosli_typeid' );

			return $schema;
		},
	),
);
