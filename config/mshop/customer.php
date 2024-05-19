<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2024
 */


return array(
	'manager' => array(
		'address' => array(
			'fosuser' => array(
				'clear' => array(
					'ansi' => '
						DELETE FROM "fos_user_address"
						WHERE :cond AND "siteid" LIKE ?
					',
				),
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_address"
						WHERE :cond AND ( "siteid" LIKE ? OR "siteid" = ? )
					',
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_address" ( :names
							"parentid", "type", "company", "vatid", "salutation", "title",
							"firstname", "lastname", "address1", "address2", "address3",
							"postal", "city", "state", "countryid", "langid", "telephone",
							"mobile", "email", "telefax", "website", "longitude", "latitude",
							"pos", "birthday", "mtime", "editor", "siteid", "ctime"
						) VALUES ( :values
							?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					',
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_address"
						SET :names
							"parentid" = ?, "type" = ?, "company" = ?, "vatid" = ?, "salutation" = ?,
							"title" = ?, "firstname" = ?, "lastname" = ?, "address1" = ?,
							"address2" = ?, "address3" = ?, "postal" = ?, "city" = ?,
							"state" = ?, "countryid" = ?, "langid" = ?, "telephone" = ?,
							"mobile" = ?, "email" = ?, "telefax" = ?, "website" = ?,
							"longitude" = ?, "latitude" = ?, "pos" = ?, "birthday" = ?,
							"mtime" = ?, "editor" = ?
						WHERE ( "siteid" LIKE ? OR "siteid" = ? ) AND "id" = ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
						FROM "fos_user_address" AS mcusad
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
					'mysql' => '
						SELECT :columns
						FROM "fos_user_address" AS mcusad
						:joins
						WHERE :cond
						ORDER BY :order
						LIMIT :size OFFSET :start
					',
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcusad."id"
							FROM "fos_user_address" AS mcusad
							:joins
							WHERE :cond
							OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
						) AS list
					',
					'mysql' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcusad."id"
							FROM "fos_user_address" AS mcusad
							:joins
							WHERE :cond
							LIMIT 10000 OFFSET 0
						) AS list
					',
				),
				'newid' => array(
					'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
					'mysql' => 'SELECT LAST_INSERT_ID()',
					'oracle' => 'SELECT fos_user_address.CURRVAL FROM DUAL',
					'pgsql' => 'SELECT lastval()',
					'sqlite' => 'SELECT last_insert_rowid()',
					'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
					'sqlanywhere' => 'SELECT @@IDENTITY',
				),
			),
		),
		'lists' => array(
			'type' => array(
				'fosuser' => array(
					'insert' => array(
						'ansi' => '
							INSERT INTO "fos_user_list_type" ( :names
								"code", "domain", "label", "i18n", "pos", "status",
								"mtime","editor", "siteid", "ctime"
							) VALUES ( :values
								?, ?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						',
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_list_type"
							SET :names
								"code" = ?, "domain" = ?, "label" = ?, "i18n" = ?,
								"pos" = ?, "status" = ?, "mtime" = ?, "editor" = ?
							WHERE "siteid" LIKE ? AND "id" = ?
						',
					),
					'delete' => array(
						'ansi' => '
							DELETE FROM "fos_user_list_type"
							WHERE :cond AND "siteid" LIKE ?
						',
					),
					'search' => array(
						'ansi' => '
							SELECT :columns
							FROM "fos_user_list_type" AS mcuslity
							:joins
							WHERE :cond
							ORDER BY :order
							OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
						'mysql' => '
							SELECT :columns
							FROM "fos_user_list_type" AS mcuslity
							:joins
							WHERE :cond
							ORDER BY :order
							LIMIT :size OFFSET :start
						',
					),
					'count' => array(
						'ansi' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT mcuslity."id"
								FROM "fos_user_list_type" AS mcuslity
								:joins
								WHERE :cond
								OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
							) AS LIST
						',
						'mysql' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT mcuslity."id"
								FROM "fos_user_list_type" AS mcuslity
								:joins
								WHERE :cond
								LIMIT 10000 OFFSET 0
							) AS LIST
						',
					),
					'newid' => array(
						'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
						'mysql' => 'SELECT LAST_INSERT_ID()',
						'oracle' => 'SELECT fos_user_list_type.CURRVAL FROM DUAL',
						'pgsql' => 'SELECT lastval()',
						'sqlite' => 'SELECT last_insert_rowid()',
						'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
						'sqlanywhere' => 'SELECT @@IDENTITY',
					),
				),
			),
			'fosuser' => array(
				'aggregate' => array(
					'ansi' => '
						SELECT :keys, COUNT("id") AS "count"
						FROM (
							SELECT :acols, mcusli."id" AS "id"
							FROM "fos_user_list" AS mcusli
							:joins
							WHERE :cond
							ORDER BY :order
							OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						) AS list
						GROUP BY :keys
					',
					'mysql' => '
						SELECT :keys, COUNT("id") AS "count"
						FROM (
							SELECT :acols, mcusli."id" AS "id"
							FROM "fos_user_list" AS mcusli
							:joins
							WHERE :cond
							ORDER BY :order
							LIMIT :size OFFSET :start
						) AS list
						GROUP BY :keys
					',
				),
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_list"
						WHERE :cond AND "siteid" LIKE ?
					',
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_list" ( :names
							"parentid", "key", "type", "domain", "refid", "start", "end",
							"config", "pos", "status", "mtime", "editor", "siteid", "ctime"
						) VALUES ( :values
							?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					',
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_list"
						SET :names
							"parentid"=?, "key" = ?, "type" = ?, "domain" = ?, "refid" = ?, "start" = ?,
							"end" = ?, "config" = ?, "pos" = ?, "status" = ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" LIKE ? AND "id" = ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
						FROM "fos_user_list" AS mcusli
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
					'mysql' => '
						SELECT :columns
						FROM "fos_user_list" AS mcusli
						:joins
						WHERE :cond
						ORDER BY :order
						LIMIT :size OFFSET :start
					',
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcusli."id"
							FROM "fos_user_list" AS mcusli
							:joins
							WHERE :cond
							OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
						) AS list
					',
					'mysql' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcusli."id"
							FROM "fos_user_list" AS mcusli
							:joins
							WHERE :cond
							LIMIT 10000 OFFSET 0
						) AS list
					',
				),
				'newid' => array(
					'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
					'mysql' => 'SELECT LAST_INSERT_ID()',
					'oracle' => 'SELECT fos_user_list.CURRVAL FROM DUAL',
					'pgsql' => 'SELECT lastval()',
					'sqlite' => 'SELECT last_insert_rowid()',
					'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
					'sqlanywhere' => 'SELECT @@IDENTITY',
				),
			),
		),
		'property' => array(
			'type' => array(
				'fosuser' => array(
					'delete' => array(
						'ansi' => '
							DELETE FROM "fos_user_property_type"
							WHERE :cond AND "siteid" LIKE ?
						'
					),
					'insert' => array(
						'ansi' => '
							INSERT INTO "fos_user_property_type" ( :names
								"code", "domain", "label", "i18n", "pos", "status",
								"mtime","editor", "siteid", "ctime"
							) VALUES ( :values
								?, ?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						'
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_property_type"
							SET :names
								"code" = ?, "domain" = ?, "label" = ?, "i18n" = ?,
								"pos" = ?, "status" = ?, "mtime" = ?, "editor" = ?
							WHERE "siteid" LIKE ? AND "id" = ?
						'
					),
					'search' => array(
						'ansi' => '
							SELECT :columns
							FROM "fos_user_property_type" mcusprty
							:joins
							WHERE :cond
							ORDER BY :order
							OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
						'mysql' => '
							SELECT :columns
							FROM "fos_user_property_type" mcusprty
							:joins
							WHERE :cond
							ORDER BY :order
							LIMIT :size OFFSET :start
						'
					),
					'count' => array(
						'ansi' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT mcusprty."id"
								FROM "fos_user_property_type" mcusprty
								:joins
								WHERE :cond
								OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
							) AS list
						',
						'mysql' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT mcusprty."id"
								FROM "fos_user_property_type" mcusprty
								:joins
								WHERE :cond
								LIMIT 10000 OFFSET 0
							) AS list
						'
					),
					'newid' => array(
						'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
						'mysql' => 'SELECT LAST_INSERT_ID()',
						'oracle' => 'SELECT fos_user_property_type_seq.CURRVAL FROM DUAL',
						'pgsql' => 'SELECT lastval()',
						'sqlite' => 'SELECT last_insert_rowid()',
						'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
						'sqlanywhere' => 'SELECT @@IDENTITY',
					),
				),
			),
			'fosuser' => array(
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_property"
						WHERE :cond AND "siteid" LIKE ?
					'
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_property" ( :names
							"parentid", "key", "type", "langid", "value",
							"mtime", "editor", "siteid", "ctime"
						) VALUES ( :values
							?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					'
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_property"
						SET :names
							"parentid" = ?, "key" = ?, "type" = ?, "langid" = ?,
							"value" = ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" LIKE ? AND "id" = ?
					'
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
						FROM "fos_user_property" AS mcuspr
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
					',
					'mysql' => '
						SELECT :columns
						FROM "fos_user_property" AS mcuspr
						:joins
						WHERE :cond
						ORDER BY :order
						LIMIT :size OFFSET :start
					'
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcuspr."id"
							FROM "fos_user_property" AS mcuspr
							:joins
							WHERE :cond
							OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
						) AS list
					',
					'mysql' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT mcuspr."id"
							FROM "fos_user_property" AS mcuspr
							:joins
							WHERE :cond
							LIMIT 10000 OFFSET 0
						) AS list
					'
				),
				'newid' => array(
					'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
					'mysql' => 'SELECT LAST_INSERT_ID()',
					'oracle' => 'SELECT fos_user_property_seq.CURRVAL FROM DUAL',
					'pgsql' => 'SELECT lastval()',
					'sqlite' => 'SELECT last_insert_rowid()',
					'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
					'sqlanywhere' => 'SELECT @@IDENTITY',
				),
			),
		),
		'fosuser' => array(
			'clear' => array(
				'ansi' => '
					DELETE FROM "fos_user"
					WHERE :cond AND "siteid" LIKE ?
				',
			),
			'delete' => array(
				'ansi' => '
					DELETE FROM "fos_user"
					WHERE :cond AND ( "siteid" LIKE ? OR "siteid" = ? )
				',
			),
			'insert' => array(
				'ansi' => '
					INSERT INTO "fos_user" ( :names
						"username_canonical", "username", "company", "vatid", "salutation", "title",
						"firstname", "lastname", "address1", "address2", "address3",
						"postal", "city", "state", "countryid", "langid", "telephone", "mobile",
						"email_canonical", "email", "telefax", "website", "longitude", "latitude",
						"birthday", "enabled", "vdate", "password", "mtime", "editor", "roles", "salt",
						"siteid", "ctime"
					) VALUES ( :values
						?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
					)
				',
			),
			'update' => array(
				'ansi' => '
					UPDATE "fos_user"
					SET :names
						"username_canonical" = ?, "username" = ?, "company" = ?, "vatid" = ?,
						"salutation" = ?, "title" = ?, "firstname" = ?, "lastname" = ?,
						"address1" = ?, "address2" = ?, "address3" = ?, "postal" = ?,
						"city" = ?, "state" = ?, "countryid" = ?, "langid" = ?,
						"telephone" = ?, "mobile" = ?, "email_canonical" = ?, "email" = ?, "telefax" = ?,
						"website" = ?, "longitude" = ?, "latitude" = ?, "birthday" = ?, "enabled" = ?,
						"vdate" = ?, "password" = ?, "mtime" = ?, "editor" = ?, "roles" = ?, "salt" = ?
					WHERE ( "siteid" LIKE ? OR "siteid" = ? ) AND "id" = ?
				',
			),
			'search' => array(
				'ansi' => '
					SELECT :columns
					FROM "fos_user" AS mcus
					:joins
					WHERE :cond
					GROUP BY :group
					ORDER BY :order
					OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
				',
				'mysql' => '
					SELECT :columns
					FROM "fos_user" AS mcus
					:joins
					WHERE :cond
					GROUP BY :group
					ORDER BY :order
					LIMIT :size OFFSET :start
				',
			),
			'count' => array(
				'ansi' => '
					SELECT COUNT(*) AS "count"
					FROM (
						SELECT mcus."id"
						FROM "fos_user" AS mcus
						:joins
						WHERE :cond
						GROUP BY mcus."id"
						OFFSET 0 ROWS FETCH NEXT 10000 ROWS ONLY
					) AS list
				',
				'mysql' => '
					SELECT COUNT(*) AS "count"
					FROM (
						SELECT mcus."id"
						FROM "fos_user" AS mcus
						:joins
						WHERE :cond
						GROUP BY mcus."id"
						LIMIT 10000 OFFSET 0
					) AS list
				',
			),
			'newid' => array(
				'db2' => 'SELECT IDENTITY_VAL_LOCAL()',
				'mysql' => 'SELECT LAST_INSERT_ID()',
				'oracle' => 'SELECT fos_user.CURRVAL FROM DUAL',
				'pgsql' => 'SELECT lastval()',
				'sqlite' => 'SELECT last_insert_rowid()',
				'sqlsrv' => 'SELECT SCOPE_IDENTITY()',
				'sqlanywhere' => 'SELECT @@IDENTITY',
			),
		),
	),
);
