<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014-2016
 */

return array(
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
			INSERT INTO "fos_user_list"( "parentid", "siteid", "typeid", "domain", "refid", "start", "end",
			"config", "pos", "status", "mtime", "editor", "ctime" )
			VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )
		',
	),
	'update' => array(
		'ansi' => '
			UPDATE "fos_user_list"
			SET "parentid"=?, "siteid" = ?, "typeid" = ?, "domain" = ?, "refid" = ?, "start" = ?, "end" = ?,
				"config" = ?, "pos" = ?, "status" = ?, "mtime" = ?, "editor" = ?
			WHERE "id" = ?
		',
	),
	'updatepos' => array(
		'ansi' => '
			UPDATE "fos_user_list"
				SET "pos" = ?, "mtime" = ?, "editor" = ?
			WHERE "id" = ?
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
);
