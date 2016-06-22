<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015
 */

return array(
	'delete' => array(
		'ansi' => '
			DELETE FROM "fos_user"
			WHERE :cond
		',
	),
	'insert' => array(
		'ansi' => '
			INSERT INTO "fos_user" (
				"username_canonical", "username", "company", "vatid", "salutation", "title",
				"firstname", "lastname", "address1", "address2", "address3",
				"postal", "city", "state", "countryid", "langid", "telephone",
				"email_canonical", "email", "telefax", "website", "birthday", "enabled",
				"vdate", "password", "mtime", "editor", "roles", "ctime",
				"salt", "locked", "expired", "credentials_expired"
			) VALUES (
				?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, \'\', 0, 0, 0
			)
		',
	),
	'update' => array(
		'ansi' => '
			UPDATE "fos_user"
			SET "username_canonical" = ?, "username" = ?, "company" = ?, "vatid" = ?,
				"salutation" = ?, "title" = ?, "firstname" = ?, "lastname" = ?,
				"address1" = ?, "address2" = ?, "address3" = ?, "postal" = ?,
				"city" = ?, "state" = ?, "countryid" = ?, "langid" = ?,
				"telephone" = ?, "email_canonical" = ?, "email" = ?, "telefax" = ?,
				"website" = ?, "birthday" = ?, "enabled" = ?, "vdate" = ?, "password" = ?,
				"mtime" = ?, "editor" = ?, "roles" = ?
			WHERE "id" = ?
		',
	),
	'search' => array(
		'ansi' => '
			SELECT DISTINCT fos."id" AS "customer.id",
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
				fos."birthday" AS "customer.birthday", fos."enabled" as "customer.status",
				fos."vdate" AS "customer.vdate", fos."password" AS "customer.password",
				fos."ctime" AS "customer.ctime", fos."mtime" AS "customer.mtime",
				fos."editor" AS "customer.editor", fos."roles"
			FROM "fos_user" AS fos
			:joins
			WHERE :cond
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
);
