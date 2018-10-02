<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2018
 */


return array(
	'manager' => array(
		'address' => array(
			'fosuser' => array(
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_address"
						WHERE :cond AND siteid = ?
					',
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_address" (
							"parentid", "company", "vatid", "salutation", "title",
							"firstname", "lastname", "address1", "address2", "address3",
							"postal", "city", "state", "countryid", "langid", "telephone",
							"email", "telefax", "website", "longitude", "latitude", "flag",
							"pos", "mtime", "editor", "siteid", "ctime"
						) VALUES (
							?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					',
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_address"
						SET "parentid" = ?, "company" = ?, "vatid" = ?, "salutation" = ?,
							"title" = ?, "firstname" = ?, "lastname" = ?, "address1" = ?,
							"address2" = ?, "address3" = ?, "postal" = ?, "city" = ?,
							"state" = ?, "countryid" = ?, "langid" = ?, "telephone" = ?,
							"email" = ?, "telefax" = ?, "website" = ?, "longitude" = ?, "latitude" = ?,
							"flag" = ?, "pos" = ?, "mtime" = ?, "editor" = ?, "siteid" = ?
						WHERE "id" = ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT fosad."id" AS "customer.address.id", fosad."parentid" AS "customer.address.parentid",
							fosad."company" AS "customer.address.company", fosad."vatid" AS "customer.address.vatid",
							fosad."salutation" AS "customer.address.salutation", fosad."title" AS "customer.address.title",
							fosad."firstname" AS "customer.address.firstname", fosad."lastname" AS "customer.address.lastname",
							fosad."address1" AS "customer.address.address1", fosad."address2" AS "customer.address.address2",
							fosad."address3" AS "customer.address.address3", fosad."postal" AS "customer.address.postal",
							fosad."city" AS "customer.address.city", fosad."state" AS "customer.address.state",
							fosad."countryid" AS "customer.address.countryid", fosad."langid" AS "customer.address.languageid",
							fosad."telephone" AS "customer.address.telephone", fosad."email" AS "customer.address.email",
							fosad."telefax" AS "customer.address.telefax", fosad."website" AS "customer.address.website",
							fosad."longitude" AS "customer.address.longitude", fosad."latitude" AS "customer.address.latitude",
							fosad."flag" AS "customer.address.flag", fosad."pos" AS "customer.address.position",
							fosad."mtime" AS "customer.address.mtime", fosad."editor" AS "customer.address.editor",
							fosad."ctime" AS "customer.address.ctime", fosad."siteid" AS "customer.address.siteid"
						FROM "fos_user_address" AS fosad
						:joins
						WHERE :cond
						GROUP BY fosad."id", fosad."parentid",fosad."company", fosad."vatid",
							fosad."salutation", fosad."title", fosad."firstname", fosad."lastname",
							fosad."address1", fosad."address2", fosad."address3", fosad."postal",
							fosad."city", fosad."state", fosad."countryid", fosad."langid",
							fosad."telephone", fosad."email", fosad."telefax", fosad."website",
							fosad."longitude", fosad."latitude", fosad."flag", fosad."pos",
							fosad."mtime", fosad."editor", fosad."ctime"
						/*-orderby*/ ORDER BY :order /*orderby-*/
						LIMIT :size OFFSET :start
					',
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT DISTINCT fosad."id"
							FROM "fos_user_address" AS fosad
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
							INSERT INTO "fos_user_list_type"(
								"code", "domain", "label", "pos", "status",
								"mtime", "editor", "siteid", "ctime"
							) VALUES (
								?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						',
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_list_type"
							SET "code" = ?, "domain" = ?, "label" = ?, "pos" = ?,
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
							SELECT foslity."id" AS "customer.lists.type.id", foslity."siteid" AS "customer.lists.type.siteid",
								foslity."code" AS "customer.lists.type.code", foslity."domain" AS "customer.lists.type.domain",
								foslity."label" AS "customer.lists.type.label", foslity."status" AS "customer.lists.type.status",
								foslity."mtime" AS "customer.lists.type.mtime", foslity."editor" AS "customer.lists.type.editor",
								foslity."ctime" AS "customer.lists.type.ctime", foslity."pos" AS "customer.lists.type.position"
							FROM "fos_user_list_type" AS foslity
							:joins
							WHERE :cond
							GROUP BY foslity."id", foslity."siteid", foslity."code", foslity."domain",
								foslity."label", foslity."status", foslity."mtime", foslity."editor",
								foslity."ctime", foslity."pos" /*-columns*/ , :columns /*columns-*/
							/*-orderby*/ ORDER BY :order /*orderby-*/
							LIMIT :size OFFSET :start
						',
					),
					'count' => array(
						'ansi' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT DISTINCT foslity."id"
								FROM "fos_user_list_type" AS foslity
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
						SELECT "key", COUNT(DISTINCT "id") AS "count"
						FROM (
							SELECT :key AS "key", fosli."id" AS "id"
							FROM "fos_user_list" AS fosli
							:joins
							WHERE :cond
							/*-orderby*/ ORDER BY :order /*orderby-*/
							LIMIT :size OFFSET :start
						) AS list
						GROUP BY "key"
					',
				),
				'getposmax' => array(
					'ansi' => '
						SELECT MAX( "pos" ) AS pos
						FROM "fos_user_list"
						WHERE "siteid" = ?
							AND "parentid" = ?
							AND "typeid" = ?
							AND "domain" = ?
					',
				),
				'insert' => array(
					'ansi' => '
						INSERT INTO "fos_user_list"(
							"parentid", "typeid", "domain", "refid", "start", "end",
							"config", "pos", "status", "mtime", "editor", "siteid", "ctime"
						) VALUES (
							?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
						)
					',
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_list"
						SET "parentid"=?, "typeid" = ?, "domain" = ?, "refid" = ?, "start" = ?, "end" = ?,
							"config" = ?, "pos" = ?, "status" = ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" = ? AND "id" = ?
					',
				),
				'updatepos' => array(
					'ansi' => '
						UPDATE "fos_user_list"
							SET "pos" = ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" = ? AND "id" = ?
					',
				),
				'delete' => array(
					'ansi' => '
						DELETE FROM "fos_user_list"
						WHERE :cond AND siteid = ?
					',
				),
				'move' => array(
					'ansi' => '
						UPDATE "fos_user_list"
							SET "pos" = "pos" + ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" = ?
							AND "parentid" = ?
							AND "typeid" = ?
							AND "domain" = ?
							AND "pos" >= ?
					',
				),
				'search' => array(
					'ansi' => '
						SELECT fosli."id" AS "customer.lists.id", fosli."siteid" AS "customer.lists.siteid",
							fosli."parentid" AS "customer.lists.parentid", fosli."typeid" AS "customer.lists.typeid",
							fosli."domain" AS "customer.lists.domain", fosli."refid" AS "customer.lists.refid",
							fosli."start" AS "customer.lists.datestart", fosli."end" AS "customer.lists.dateend",
							fosli."config" AS "customer.lists.config", fosli."pos" AS "customer.lists.position",
							fosli."status" AS "customer.lists.status", fosli."mtime" AS "customer.lists.mtime",
							fosli."editor" AS "customer.lists.editor", fosli."ctime" AS "customer.lists.ctime"
						FROM "fos_user_list" AS fosli
						:joins
						WHERE :cond
						GROUP BY fosli."id", fosli."parentid", fosli."siteid", fosli."typeid",
							fosli."domain", fosli."refid", fosli."start", fosli."end",
							fosli."config", fosli."pos", fosli."status", fosli."mtime",
							fosli."editor", fosli."ctime" /*-columns*/ , :columns /*columns-*/
						/*-orderby*/ ORDER BY :order /*orderby-*/
						LIMIT :size OFFSET :start
					',
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT DISTINCT fosli."id"
							FROM "fos_user_list" AS fosli
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
							INSERT INTO "fos_user_property_type" (
								"code", "domain", "label", "pos", "status",
								"mtime", "editor", "siteid", "ctime"
							) VALUES (
								?, ?, ?, ?, ?, ?, ?, ?, ?
							)
						'
					),
					'update' => array(
						'ansi' => '
							UPDATE "fos_user_property_type"
							SET "code" = ?, "domain" = ?, "label" = ?, "pos" = ?,
								"status" = ?, "mtime" = ?, "editor" = ?
							WHERE "siteid" = ? AND "id" = ?
						'
					),
					'search' => array(
						'ansi' => '
							SELECT fosprty."id" AS "customer.property.type.id", fosprty."siteid" AS "customer.property.type.siteid",
								fosprty."code" AS "customer.property.type.code", fosprty."domain" AS "customer.property.type.domain",
								fosprty."label" AS "customer.property.type.label", fosprty."status" AS "customer.property.type.status",
								fosprty."mtime" AS "customer.property.type.mtime", fosprty."editor" AS "customer.property.type.editor",
								fosprty."ctime" AS "customer.property.type.ctime", fosprty."pos" AS "customer.property.type.position"
							FROM "fos_user_property_type" fosprty
							:joins
							WHERE :cond
							GROUP BY fosprty."id", fosprty."siteid", fosprty."code", fosprty."domain",
								fosprty."label", fosprty."status", fosprty."mtime", fosprty."editor",
								fosprty."ctime", fosprty."pos" /*-columns*/ , :columns /*columns-*/
							/*-orderby*/ ORDER BY :order /*orderby-*/
							LIMIT :size OFFSET :start
						'
					),
					'count' => array(
						'ansi' => '
							SELECT COUNT(*) AS "count"
							FROM (
								SELECT DISTINCT fosprty."id"
								FROM "fos_user_property_type" fosprty
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
						INSERT INTO "fos_user_property" (
							"parentid", "typeid", "langid", "value",
							"mtime", "editor", "siteid", "ctime"
						) VALUES (
							?, ?, ?, ?, ?, ?, ?, ?
						)
					'
				),
				'update' => array(
					'ansi' => '
						UPDATE "fos_user_property"
						SET "parentid" = ?, "typeid" = ?, "langid" = ?,
							"value" = ?, "mtime" = ?, "editor" = ?
						WHERE "siteid" = ? AND "id" = ?
					'
				),
				'search' => array(
					'ansi' => '
						SELECT fospr."id" AS "customer.property.id", fospr."parentid" AS "customer.property.parentid",
							fospr."siteid" AS "customer.property.siteid", fospr."typeid" AS "customer.property.typeid",
							fospr."langid" AS "customer.property.languageid", fospr."value" AS "customer.property.value",
							fospr."mtime" AS "customer.property.mtime", fospr."editor" AS "customer.property.editor",
							fospr."ctime" AS "customer.property.ctime"
						FROM "fos_user_property" AS fospr
						:joins
						WHERE :cond
						GROUP BY fospr."id", fospr."parentid", fospr."siteid", fospr."typeid",
							fospr."langid", fospr."value", fospr."mtime", fospr."editor",
							fospr."ctime" /*-columns*/ , :columns /*columns-*/
						/*-orderby*/ ORDER BY :order /*orderby-*/
						LIMIT :size OFFSET :start
					'
				),
				'count' => array(
					'ansi' => '
						SELECT COUNT(*) AS "count"
						FROM (
							SELECT DISTINCT fospr."id"
							FROM "fos_user_property" AS fospr
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
			'delete' => array(
				'ansi' => '
					DELETE FROM "fos_user"
					WHERE :cond
				',
			),
			'insert' => array(
				'ansi' => '
					INSERT INTO "fos_user" (
						"siteid", "username_canonical", "username", "company", "vatid", "salutation", "title",
						"firstname", "lastname", "address1", "address2", "address3",
						"postal", "city", "state", "countryid", "langid", "telephone",
						"email_canonical", "email", "telefax", "website", "longitude", "latitude",
						"birthday", "enabled", "vdate", "password", "mtime", "editor", "roles", "salt",
						"ctime"
					) VALUES (
						?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
					)
				',
			),
			'update' => array(
				'ansi' => '
					UPDATE "fos_user"
					SET "siteid" = ?, "username_canonical" = ?, "username" = ?, "company" = ?, "vatid" = ?,
						"salutation" = ?, "title" = ?, "firstname" = ?, "lastname" = ?,
						"address1" = ?, "address2" = ?, "address3" = ?, "postal" = ?,
						"city" = ?, "state" = ?, "countryid" = ?, "langid" = ?,
						"telephone" = ?, "email_canonical" = ?, "email" = ?, "telefax" = ?,
						"website" = ?, "longitude" = ?, "latitude" = ?, "birthday" = ?, "enabled" = ?,
						"vdate" = ?, "password" = ?, "mtime" = ?, "editor" = ?, "roles" = ?, "salt" = ?
					WHERE "id" = ?
				',
			),
			'search' => array(
				'ansi' => '
					SELECT fos."id" AS "customer.id", fos."siteid" AS "customer.siteid",
						fos."username_canonical" as "customer.code", fos."username" as "customer.label",
						fos."company" AS "customer.company", fos."vatid" AS "customer.vatid",
						fos."salutation" AS "customer.salutation", fos."title" AS "customer.title",
						fos."firstname" AS "customer.firstname", fos."lastname" AS "customer.lastname",
						fos."address1" AS "customer.address1", fos."address2" AS "customer.address2",
						fos."address3" AS "customer.address3", fos."postal" AS "customer.postal",
						fos."city" AS "customer.city", fos."state" AS "customer.state",
						fos."countryid" AS "customer.countryid", fos."langid" AS "customer.languageid",
						fos."telephone" AS "customer.telephone", fos."email_canonical" AS "customer.email",
						fos."telefax" AS "customer.telefax", fos."website" AS "customer.website",
						fos."longitude" AS "customer.longitude", fos."latitude" AS "customer.latitude",
						fos."birthday" AS "customer.birthday", fos."enabled" AS "customer.status",
						fos."vdate" AS "customer.vdate", fos."password" AS "customer.password",
						fos."ctime" AS "customer.ctime", fos."mtime" AS "customer.mtime",
						fos."editor" AS "customer.editor", fos."roles", fos."salt"
					FROM "fos_user" AS fos
					:joins
					WHERE :cond
					GROUP BY fos."id", fos."siteid", fos."username_canonical", fos."username",
						fos."company", fos."vatid", fos."salutation", fos."title",
						fos."firstname", fos."lastname", fos."address1", fos."address2",
						fos."address3", fos."postal", fos."city", fos."state",
						fos."countryid", fos."langid", fos."telephone", fos."email_canonical",
						fos."telefax", fos."website", fos."longitude", fos."latitude",
						fos."birthday", fos."enabled", fos."vdate", fos."password",
						fos."ctime", fos."mtime", fos."editor", fos."roles", fos."salt"
					/*-orderby*/ ORDER BY :order /*orderby-*/
					LIMIT :size OFFSET :start
				',
			),
			'count' => array(
				'ansi' => '
					SELECT COUNT(*) AS "count"
					FROM (
						SELECT DISTINCT fos."id"
						FROM "fos_user" AS fos
						:joins
						WHERE :cond
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