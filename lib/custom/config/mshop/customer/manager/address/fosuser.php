<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

return array(
	'delete' => array(
		'ansi' => '
			DELETE FROM "fos_user_address"
			WHERE :cond
		',
	),
	'insert' => array(
		'ansi' => '
			INSERT INTO "fos_user_address" (
				"siteid", "parentid", "company", "vatid", "salutation", "title",
				"firstname", "lastname", "address1", "address2", "address3",
				"postal", "city", "state", "countryid", "langid", "telephone",
				"email", "telefax", "website", "longitude", "latitude", "flag", "pos", "mtime",
				"editor", "ctime"
			) VALUES (
				?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?
			)
		',
	),
	'update' => array(
		'ansi' => '
			UPDATE "fos_user_address"
			SET "siteid" = ?, "parentid" = ?, "company" = ?, "vatid" = ?, "salutation" = ?,
				"title" = ?, "firstname" = ?, "lastname" = ?, "address1" = ?,
				"address2" = ?, "address3" = ?, "postal" = ?, "city" = ?,
				"state" = ?, "countryid" = ?, "langid" = ?, "telephone" = ?,
				"email" = ?, "telefax" = ?, "website" = ?, "longitude" = ?, "latitude" = ?,
				"flag" = ?, "pos" = ?, "mtime" = ?, "editor" = ?
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
				fosad."ctime" AS "customer.address.ctime"
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
);
