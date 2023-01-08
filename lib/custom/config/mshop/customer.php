<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2023
 */


return array(
	'manager' => array(
		'address' => array(
			'fosuser' => array(
				'clear' => array(
					'ansi' => '
						DELETE FROM "fos_user_address"
						WHERE :cond AND "siteid" = ?
					',
				),
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_address"
						WHERE :cond AND ( "siteid" = ? OR "siteid" = \'\' )
					',
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_address" ( :names
							"parentid", "company", "vatid", "salutation", "title",
							"firstname", "lastname", "address1", "address2", "address3",
							"postal", "city", "state", "countryid", "langid", "telephone",
							"email", "telefax", "website", "longitude", "latitude",
							"pos", "birthday", "mtime", "editor", "siteid", "ctime"
						) VALUES ( :values
							?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					',
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_address"
						SET :names
							"parentid" = ?, "company" = ?, "vatid" = ?, "salutation" = ?,
							"title" = ?, "firstname" = ?, "lastname" = ?, "address1" = ?,
							"address2" = ?, "address3" = ?, "postal" = ?, "city" = ?,
							"state" = ?, "countryid" = ?, "langid" = ?, "telephone" = ?,
							"email" = ?, "telefax" = ?, "website" = ?, "longitude" = ?, "latitude" = ?,
							"pos" = ?, "birthday" = ?, "mtime" = ?, "editor" = ?
						WHERE ( "siteid" = ? OR "siteid" = \'\' ) AND "id" = ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
							mcusad."id" AS "customer.address.id", mcusad."parentid" AS "customer.address.parentid",
							mcusad."company" AS "customer.address.company", mcusad."vatid" AS "customer.address.vatid",
							mcusad."salutation" AS "customer.address.salutation", mcusad."title" AS "customer.address.title",
							mcusad."firstname" AS "customer.address.firstname", mcusad."lastname" AS "customer.address.lastname",
							mcusad."address1" AS "customer.address.address1", mcusad."address2" AS "customer.address.address2",
							mcusad."address3" AS "customer.address.address3", mcusad."postal" AS "customer.address.postal",
							mcusad."city" AS "customer.address.city", mcusad."state" AS "customer.address.state",
							mcusad."countryid" AS "customer.address.countryid", mcusad."langid" AS "customer.address.languageid",
							mcusad."telephone" AS "customer.address.telephone", mcusad."email" AS "customer.address.email",
							mcusad."telefax" AS "customer.address.telefax", mcusad."website" AS "customer.address.website",
							mcusad."longitude" AS "customer.address.longitude", mcusad."latitude" AS "customer.address.latitude",
							mcusad."pos" AS "customer.address.position", mcusad."mtime" AS "customer.address.mtime",
							mcusad."editor" AS "customer.address.editor", mcusad."ctime" AS "customer.address.ctime",
							mcusad."siteid" AS "customer.address.siteid", mcusad."birthday" AS "customer.address.birthday"
						FROM "fos_user_address" AS mcusad
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
					'mysql' => '
						SELECT :columns
							mcusad."id" AS "customer.address.id", mcusad."parentid" AS "customer.address.parentid",
							mcusad."company" AS "customer.address.company", mcusad."vatid" AS "customer.address.vatid",
							mcusad."salutation" AS "customer.address.salutation", mcusad."title" AS "customer.address.title",
							mcusad."firstname" AS "customer.address.firstname", mcusad."lastname" AS "customer.address.lastname",
							mcusad."address1" AS "customer.address.address1", mcusad."address2" AS "customer.address.address2",
							mcusad."address3" AS "customer.address.address3", mcusad."postal" AS "customer.address.postal",
							mcusad."city" AS "customer.address.city", mcusad."state" AS "customer.address.state",
							mcusad."countryid" AS "customer.address.countryid", mcusad."langid" AS "customer.address.languageid",
							mcusad."telephone" AS "customer.address.telephone", mcusad."email" AS "customer.address.email",
							mcusad."telefax" AS "customer.address.telefax", mcusad."website" AS "customer.address.website",
							mcusad."longitude" AS "customer.address.longitude", mcusad."latitude" AS "customer.address.latitude",
							mcusad."pos" AS "customer.address.position", mcusad."mtime" AS "customer.address.mtime",
							mcusad."editor" AS "customer.address.editor", mcusad."ctime" AS "customer.address.ctime",
							mcusad."siteid" AS "customer.address.siteid", mcusad."birthday" AS "customer.address.birthday"
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
								"code", "domain", "label", "pos", "status",
								"mtime", "editor", "siteid", "ctime"
							) VALUES ( :values
								?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						',
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_list_type"
							SET :names
								"code" = ?, "domain" = ?, "label" = ?, "pos" = ?,
								"status" = ?, "mtime" = ?, "editor" = ?
							WHERE "siteid" = ? AND "id" = ?
						',
					),
					'delete' => array(
						'ansi' => '
							DELETE FROM "fos_user_list_type"
							WHERE :cond AND siteid = ?
						',
					),
					'search' => array(
						'ansi' => '
							SELECT :columns
								mcuslity."id" AS "customer.lists.type.id", mcuslity."siteid" AS "customer.lists.type.siteid",
								mcuslity."code" AS "customer.lists.type.code", mcuslity."domain" AS "customer.lists.type.domain",
								mcuslity."label" AS "customer.lists.type.label", mcuslity."status" AS "customer.lists.type.status",
								mcuslity."mtime" AS "customer.lists.type.mtime", mcuslity."editor" AS "customer.lists.type.editor",
								mcuslity."ctime" AS "customer.lists.type.ctime", mcuslity."pos" AS "customer.lists.type.position"
							FROM "fos_user_list_type" AS mcuslity
							:joins
							WHERE :cond
							ORDER BY :order
							OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
						'mysql' => '
							SELECT :columns
								mcuslity."id" AS "customer.lists.type.id", mcuslity."siteid" AS "customer.lists.type.siteid",
								mcuslity."code" AS "customer.lists.type.code", mcuslity."domain" AS "customer.lists.type.domain",
								mcuslity."label" AS "customer.lists.type.label", mcuslity."status" AS "customer.lists.type.status",
								mcuslity."mtime" AS "customer.lists.type.mtime", mcuslity."editor" AS "customer.lists.type.editor",
								mcuslity."ctime" AS "customer.lists.type.ctime", mcuslity."pos" AS "customer.lists.type.position"
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
						WHERE :cond AND siteid = ?
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
						WHERE "siteid" = ? AND "id" = ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
							mcusli."id" AS "customer.lists.id", mcusli."siteid" AS "customer.lists.siteid",
							mcusli."parentid" AS "customer.lists.parentid", mcusli."type" AS "customer.lists.type",
							mcusli."domain" AS "customer.lists.domain", mcusli."refid" AS "customer.lists.refid",
							mcusli."start" AS "customer.lists.datestart", mcusli."end" AS "customer.lists.dateend",
							mcusli."config" AS "customer.lists.config", mcusli."pos" AS "customer.lists.position",
							mcusli."status" AS "customer.lists.status", mcusli."mtime" AS "customer.lists.mtime",
							mcusli."editor" AS "customer.lists.editor", mcusli."ctime" AS "customer.lists.ctime"
						FROM "fos_user_list" AS mcusli
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
					'mysql' => '
						SELECT :columns
							mcusli."id" AS "customer.lists.id", mcusli."siteid" AS "customer.lists.siteid",
							mcusli."parentid" AS "customer.lists.parentid", mcusli."type" AS "customer.lists.type",
							mcusli."domain" AS "customer.lists.domain", mcusli."refid" AS "customer.lists.refid",
							mcusli."start" AS "customer.lists.datestart", mcusli."end" AS "customer.lists.dateend",
							mcusli."config" AS "customer.lists.config", mcusli."pos" AS "customer.lists.position",
							mcusli."status" AS "customer.lists.status", mcusli."mtime" AS "customer.lists.mtime",
							mcusli."editor" AS "customer.lists.editor", mcusli."ctime" AS "customer.lists.ctime"
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
							WHERE :cond AND siteid = ?
						'
					),
					'insert' => array(
						'ansi' => '
							INSERT INTO "fos_user_property_type" ( :names
								"code", "domain", "label", "pos", "status",
								"mtime", "editor", "siteid", "ctime"
							) VALUES ( :values
								?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						'
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_property_type"
							SET :names
								"code" = ?, "domain" = ?, "label" = ?, "pos" = ?,
								"status" = ?, "mtime" = ?, "editor" = ?
							WHERE "siteid" = ? AND "id" = ?
						'
					),
					'search' => array(
						'ansi' => '
							SELECT :columns
								mcusprty."id" AS "customer.property.type.id", mcusprty."siteid" AS "customer.property.type.siteid",
								mcusprty."code" AS "customer.property.type.code", mcusprty."domain" AS "customer.property.type.domain",
								mcusprty."label" AS "customer.property.type.label", mcusprty."status" AS "customer.property.type.status",
								mcusprty."mtime" AS "customer.property.type.mtime", mcusprty."editor" AS "customer.property.type.editor",
								mcusprty."ctime" AS "customer.property.type.ctime", mcusprty."pos" AS "customer.property.type.position"
							FROM "fos_user_property_type" mcusprty
							:joins
							WHERE :cond
							ORDER BY :order
							OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
						',
						'mysql' => '
							SELECT :columns
								mcusprty."id" AS "customer.property.type.id", mcusprty."siteid" AS "customer.property.type.siteid",
								mcusprty."code" AS "customer.property.type.code", mcusprty."domain" AS "customer.property.type.domain",
								mcusprty."label" AS "customer.property.type.label", mcusprty."status" AS "customer.property.type.status",
								mcusprty."mtime" AS "customer.property.type.mtime", mcusprty."editor" AS "customer.property.type.editor",
								mcusprty."ctime" AS "customer.property.type.ctime", mcusprty."pos" AS "customer.property.type.position"
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
						WHERE :cond AND siteid = ?
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
						WHERE "siteid" = ? AND "id" = ?
					'
				),
				'search' => array(
					'ansi' => '
						SELECT :columns
							mcuspr."id" AS "customer.property.id", mcuspr."parentid" AS "customer.property.parentid",
							mcuspr."siteid" AS "customer.property.siteid", mcuspr."type" AS "customer.property.type",
							mcuspr."langid" AS "customer.property.languageid", mcuspr."value" AS "customer.property.value",
							mcuspr."mtime" AS "customer.property.mtime", mcuspr."editor" AS "customer.property.editor",
							mcuspr."ctime" AS "customer.property.ctime"
						FROM "fos_user_property" AS mcuspr
						:joins
						WHERE :cond
						ORDER BY :order
						OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
					',
					'mysql' => '
						SELECT :columns
							mcuspr."id" AS "customer.property.id", mcuspr."parentid" AS "customer.property.parentid",
							mcuspr."siteid" AS "customer.property.siteid", mcuspr."type" AS "customer.property.type",
							mcuspr."langid" AS "customer.property.languageid", mcuspr."value" AS "customer.property.value",
							mcuspr."mtime" AS "customer.property.mtime", mcuspr."editor" AS "customer.property.editor",
							mcuspr."ctime" AS "customer.property.ctime"
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
					WHERE :cond AND "siteid" = ?
				',
			),
			'delete' => array(
				'ansi' => '
					DELETE FROM "fos_user"
					WHERE :cond AND ( "siteid" = ? OR "siteid" = \'\' )
				',
			),
			'insert' => array(
				'ansi' => '
					INSERT INTO "fos_user" ( :names
						"username_canonical", "username", "company", "vatid", "salutation", "title",
						"firstname", "lastname", "address1", "address2", "address3",
						"postal", "city", "state", "countryid", "langid", "telephone",
						"email_canonical", "email", "telefax", "website", "longitude", "latitude",
						"birthday", "enabled", "vdate", "password", "mtime", "editor", "roles", "salt",
						"siteid", "ctime"
					) VALUES ( :values
						?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
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
						"telephone" = ?, "email_canonical" = ?, "email" = ?, "telefax" = ?,
						"website" = ?, "longitude" = ?, "latitude" = ?, "birthday" = ?, "enabled" = ?,
						"vdate" = ?, "password" = ?, "mtime" = ?, "editor" = ?, "roles" = ?, "salt" = ?
					WHERE ( "siteid" = ? OR "siteid" = \'\' ) AND "id" = ?
				',
			),
			'search' => array(
				'ansi' => '
					SELECT :columns
						mcus."id" AS "customer.id", mcus."siteid" AS "customer.siteid",
						mcus."username_canonical" as "customer.code", mcus."username" as "customer.label",
						mcus."company" AS "customer.company", mcus."vatid" AS "customer.vatid",
						mcus."salutation" AS "customer.salutation", mcus."title" AS "customer.title",
						mcus."firstname" AS "customer.firstname", mcus."lastname" AS "customer.lastname",
						mcus."address1" AS "customer.address1", mcus."address2" AS "customer.address2",
						mcus."address3" AS "customer.address3", mcus."postal" AS "customer.postal",
						mcus."city" AS "customer.city", mcus."state" AS "customer.state",
						mcus."countryid" AS "customer.countryid", mcus."langid" AS "customer.languageid",
						mcus."telephone" AS "customer.telephone", mcus."email_canonical" AS "customer.email",
						mcus."telefax" AS "customer.telefax", mcus."website" AS "customer.website",
						mcus."longitude" AS "customer.longitude", mcus."latitude" AS "customer.latitude",
						mcus."birthday" AS "customer.birthday", mcus."enabled" AS "customer.status",
						mcus."vdate" AS "customer.vdate", mcus."password" AS "customer.password",
						mcus."ctime" AS "customer.ctime", mcus."mtime" AS "customer.mtime",
						mcus."editor" AS "customer.editor", mcus."roles", mcus."salt"
					FROM "fos_user" AS mcus
					:joins
					WHERE :cond
					GROUP BY :columns :group
						mcus."id", mcus."siteid", mcus."username_canonical", mcus."username", mcus."company", mcus."vatid",
						mcus."salutation", mcus."title", mcus."firstname", mcus."lastname", mcus."address1", mcus."address2",
						mcus."address3", mcus."postal", mcus."city", mcus."state", mcus."countryid", mcus."langid",
						mcus."telephone", mcus."email_canonical", mcus."telefax", mcus."website", mcus."longitude", mcus."latitude",
						mcus."birthday", mcus."enabled", mcus."vdate", mcus."password", mcus."ctime", mcus."mtime",
						mcus."editor", mcus."roles", mcus."salt"
					ORDER BY :order
					OFFSET :start ROWS FETCH NEXT :size ROWS ONLY
				',
				'mysql' => '
					SELECT :columns
						mcus."id" AS "customer.id", mcus."siteid" AS "customer.siteid",
						mcus."username_canonical" as "customer.code", mcus."username" as "customer.label",
						mcus."company" AS "customer.company", mcus."vatid" AS "customer.vatid",
						mcus."salutation" AS "customer.salutation", mcus."title" AS "customer.title",
						mcus."firstname" AS "customer.firstname", mcus."lastname" AS "customer.lastname",
						mcus."address1" AS "customer.address1", mcus."address2" AS "customer.address2",
						mcus."address3" AS "customer.address3", mcus."postal" AS "customer.postal",
						mcus."city" AS "customer.city", mcus."state" AS "customer.state",
						mcus."countryid" AS "customer.countryid", mcus."langid" AS "customer.languageid",
						mcus."telephone" AS "customer.telephone", mcus."email_canonical" AS "customer.email",
						mcus."telefax" AS "customer.telefax", mcus."website" AS "customer.website",
						mcus."longitude" AS "customer.longitude", mcus."latitude" AS "customer.latitude",
						mcus."birthday" AS "customer.birthday", mcus."enabled" AS "customer.status",
						mcus."vdate" AS "customer.vdate", mcus."password" AS "customer.password",
						mcus."ctime" AS "customer.ctime", mcus."mtime" AS "customer.mtime",
						mcus."editor" AS "customer.editor", mcus."roles", mcus."salt"
					FROM "fos_user" AS mcus
					:joins
					WHERE :cond
					GROUP BY :group mcus."id"
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
