<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2024
 */


return array(
	'manager' => array(
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
