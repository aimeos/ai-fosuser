<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2025
 * @package MShop
 * @subpackage Customer
 */


namespace Aimeos\MShop\Customer\Manager;


/**
 * Customer class implementation for Friends of Symfony user bundle.
 *
 * @package MShop
 * @subpackage Customer
 */
class FosUser
	extends \Aimeos\MShop\Customer\Manager\Standard
{
	/**
	 * Removes old entries from the storage.
	 *
	 * @param iterable $siteids List of IDs for sites whose entries should be deleted
	 * @return \Aimeos\MShop\Common\Manager\Iface Same object for fluent interface
	 */
	public function clear( iterable $siteids ) : \Aimeos\MShop\Common\Manager\Iface
	{
		$path = 'mshop/customer/manager/submanagers';
		$default = ['address', 'lists', 'property'];

		foreach( $this->context()->config()->get( $path, $default ) as $domain ) {
			$this->object()->getSubManager( $domain )->clear( $siteids );
		}

		return $this->clearBase( $siteids, 'mshop/customer/manager/fosuser/clear' );
	}


	/**
	 * Creates a new empty item instance
	 *
	 * @param array $values Values the item should be initialized with
	 * @return \Aimeos\MShop\Customer\Item\Iface New customer item object
	 */
	public function create( array $values = [] ) : \Aimeos\MShop\Common\Item\Iface
	{
		$values['customer.siteid'] = $values['customer.siteid'] ?? $this->context()->locale()->getSiteId();

		$address = new \Aimeos\MShop\Common\Item\Address\Standard( 'customer.', $values );
		return new \Aimeos\MShop\Customer\Item\FosUser( $address, 'customer.', $values, $this->context()->password() );
	}


	/**
	 * Removes multiple items.
	 *
	 * @param \Aimeos\MShop\Common\Item\Iface[]|string[] $items List of item objects or IDs of the items
	 * @return \Aimeos\MShop\Common\Manager\Iface Manager object for chaining method calls
	 */
	public function delete( $items ) : \Aimeos\MShop\Common\Manager\Iface
	{
		return $this->deleteItemsBase( $items, 'mshop/customer/manager/fosuser/delete' );
	}


	/**
	 * Returns the list attributes that can be used for searching.
	 *
	 * @param bool $withsub Return also attributes of sub-managers if true
	 * @return array List of attribute items implementing \Aimeos\Base\Criteria\Attribute\Iface
	 */
	public function getSearchAttributes( bool $withsub = true ) : array
	{
		$level = \Aimeos\MShop\Locale\Manager\Base::SITE_ALL;
		$level = $this->context()->config()->get( 'mshop/customer/manager/sitemode', $level );

		return array_replace( parent::getSearchAttributes( $withsub ), $this->createAttributes( [
			'customer.code' => [
				'label' => 'Username',
				'internalcode' => 'username',
			],
			'customer.label' => [
				'label' => 'Label',
				'internalcode' => 'username_canonical',
			],
			'customer.status' => [
				'label' => 'Status',
				'internalcode' => 'enabled',
				'type' => 'int',
			],
			'customer:has' => [
				'code' => 'customer:has()',
				'internalcode' => ':site AND :key AND mcusli."id"',
				'internaldeps' => ['LEFT JOIN "fos_user_list" AS mcusli ON ( mcusli."parentid" = mcus."id" )'],
				'label' => 'Customer has list item, parameter(<domain>[,<list type>[,<reference ID>)]]',
				'type' => 'null',
				'public' => false,
				'function' => function( &$source, array $params ) use ( $level ) {
					$keys = [];

					foreach( (array) ( $params[1] ?? '' ) as $type ) {
						foreach( (array) ( $params[2] ?? '' ) as $id ) {
							$keys[] = $params[0] . '|' . ( $type ? $type . '|' : '' ) . $id;
						}
					}

					$sitestr = $this->siteString( 'mcusli."siteid"', $level );
					$keystr = $this->toExpression( 'mcusli."key"', $keys, ( $params[2] ?? null ) ? '==' : '=~' );
					$source = str_replace( [':site', ':key'], [$sitestr, $keystr], $source );

					return $params;
				}
			],
			'customer:prop' => [
				'code' => 'customer:prop()',
				'internalcode' => ':site AND :key AND mcuspr."id"',
				'internaldeps' => ['LEFT JOIN "fos_user_property" AS mcuspr ON ( mcuspr."parentid" = mcus."id" )'],
				'label' => 'Customer has property item, parameter(<property type>[,<language code>[,<property value>]])',
				'type' => 'null',
				'public' => false,
				'function' => function( &$source, array $params ) use ( $level ) {
					$keys = [];
					$langs = array_key_exists( 1, $params ) ? ( $params[1] ?? 'null' ) : '';

					foreach( (array) $langs as $lang ) {
						foreach( (array) ( $params[2] ?? '' ) as $val ) {
							$keys[] = substr( $params[0] . '|' . ( $lang === null ? 'null|' : ( $lang ? $lang . '|' : '' ) ) . $val, 0, 255 );
						}
					}

					$sitestr = $this->siteString( 'mcuspr."siteid"', $level );
					$keystr = $this->toExpression( 'mcuspr."key"', $keys, ( $params[2] ?? null ) ? '==' : '=~' );
					$source = str_replace( [':site', ':key'], [$sitestr, $keystr], $source );

					return $params;
				}
			],
		] ) );
	}


	/**
	 * Saves a customer item object.
	 *
	 * @param \Aimeos\MShop\Customer\Item\Iface $item Customer item object
	 * @param bool $fetch True if the new ID should be returned in the item
	 * @return \Aimeos\MShop\Customer\Item\Iface $item Updated item including the generated ID
	 */
	protected function saveItem( \Aimeos\MShop\Customer\Item\Iface $item, bool $fetch = true ) : \Aimeos\MShop\Customer\Item\Iface
	{
		$item = $this->addGroups( $item );

		if( !$item->isModified() ) {
			return $this->object()->saveRefs( $item, $fetch );
		}

		$context = $this->context();
		$conn = $context->db( $this->getResourceName() );

		$id = $item->getId();
		$billingAddress = $item->getPaymentAddress();
		$columns = $this->object()->getSaveAttributes();

		if( $id === null )
		{
			/** mshop/customer/manager/fosuser/insert
			 * Inserts a new customer record into the database table
			 *
			 * Items with no ID yet (i.e. the ID is NULL) will be created in
			 * the database and the newly created ID retrieved afterwards
			 * using the "newid" SQL statement.
			 *
			 * The SQL statement must be a string suitable for being used as
			 * prepared statement. It must include question marks for binding
			 * the values from the customer item to the statement before they are
			 * sent to the database server. The number of question marks must
			 * be the same as the number of columns listed in the INSERT
			 * statement. The order of the columns must correspond to the
			 * order in the save() method, so the correct values are
			 * bound to the columns.
			 *
			 * The SQL statement should conform to the ANSI standard to be
			 * compatible with most relational database systems. This also
			 * includes using double quotes for table and column names.
			 *
			 * @param string SQL statement for inserting records
			 * @since 2015.01
			 * @category Developer
			 * @see mshop/customer/manager/fosuser/update
			 * @see mshop/customer/manager/fosuser/newid
			 * @see mshop/customer/manager/fosuser/delete
			 * @see mshop/customer/manager/fosuser/search
			 * @see mshop/customer/manager/fosuser/count
			 */
			$path = 'mshop/customer/manager/fosuser/insert';
			$sql = $this->addSqlColumns( array_keys( $columns ), $this->getSqlConfig( $path ) );
		}
		else
		{
			/** mshop/customer/manager/fosuser/update
			 * Updates an existing customer record in the database
			 *
			 * Items which already have an ID (i.e. the ID is not NULL) will
			 * be updated in the database.
			 *
			 * The SQL statement must be a string suitable for being used as
			 * prepared statement. It must include question marks for binding
			 * the values from the customer item to the statement before they are
			 * sent to the database server. The order of the columns must
			 * correspond to the order in the save() method, so the
			 * correct values are bound to the columns.
			 *
			 * The SQL statement should conform to the ANSI standard to be
			 * compatible with most relational database systems. This also
			 * includes using double quotes for table and column names.
			 *
			 * @param string SQL statement for updating records
			 * @since 2015.01
			 * @category Developer
			 * @see mshop/customer/manager/fosuser/insert
			 * @see mshop/customer/manager/fosuser/newid
			 * @see mshop/customer/manager/fosuser/delete
			 * @see mshop/customer/manager/fosuser/search
			 * @see mshop/customer/manager/fosuser/count
			 */
			$path = 'mshop/customer/manager/fosuser/update';
			$sql = $this->addSqlColumns( array_keys( $columns ), $this->getSqlConfig( $path ), false );
		}

		$idx = 1;
		$stmt = $this->getCachedStatement( $conn, $path, $sql );

		foreach( $columns as $name => $entry ) {
			$stmt->bind( $idx++, $item->get( $name ), \Aimeos\Base\Criteria\SQL::type( $entry->getType() ) );
		}

		$stmt->bind( $idx++, $item->getCode() ); // canonical username
		$stmt->bind( $idx++, $item->getCode() ); // username
		$stmt->bind( $idx++, $billingAddress->getCompany() );
		$stmt->bind( $idx++, $billingAddress->getVatID() );
		$stmt->bind( $idx++, $billingAddress->getSalutation() );
		$stmt->bind( $idx++, $billingAddress->getTitle() );
		$stmt->bind( $idx++, $billingAddress->getFirstname() );
		$stmt->bind( $idx++, $billingAddress->getLastname() );
		$stmt->bind( $idx++, $billingAddress->getAddress1() );
		$stmt->bind( $idx++, $billingAddress->getAddress2() );
		$stmt->bind( $idx++, $billingAddress->getAddress3() );
		$stmt->bind( $idx++, $billingAddress->getPostal() );
		$stmt->bind( $idx++, $billingAddress->getCity() );
		$stmt->bind( $idx++, $billingAddress->getState() );
		$stmt->bind( $idx++, $billingAddress->getCountryId() );
		$stmt->bind( $idx++, $billingAddress->getLanguageId() );
		$stmt->bind( $idx++, $billingAddress->getTelephone() );
		$stmt->bind( $idx++, $billingAddress->getMobile() );
		$stmt->bind( $idx++, $billingAddress->getEmail() );
		$stmt->bind( $idx++, $billingAddress->getEmail() );
		$stmt->bind( $idx++, $billingAddress->getTelefax() );
		$stmt->bind( $idx++, $billingAddress->getWebsite() );
		$stmt->bind( $idx++, $billingAddress->getLongitude(), \Aimeos\Base\DB\Statement\Base::PARAM_FLOAT );
		$stmt->bind( $idx++, $billingAddress->getLatitude(), \Aimeos\Base\DB\Statement\Base::PARAM_FLOAT );
		$stmt->bind( $idx++, $billingAddress->getBirthday() );
		$stmt->bind( $idx++, ( $item->getStatus() > 0 ? true : false ), \Aimeos\Base\DB\Statement\Base::PARAM_BOOL );
		$stmt->bind( $idx++, $item->getDateVerified() );
		$stmt->bind( $idx++, $item->getPassword() );
		$stmt->bind( $idx++, $context->datetime() ); // Modification time
		$stmt->bind( $idx++, $context->editor() );
		$stmt->bind( $idx++, serialize( $item->getRoles() ) );
		$stmt->bind( $idx++, $item->getSalt() );

		if( $id !== null ) {
			$stmt->bind( $idx++, $context->locale()->getSiteId() . '%' );
			$stmt->bind( $idx++, (string) $context->user()?->getSiteId() );
			$stmt->bind( $idx, $id, \Aimeos\Base\DB\Statement\Base::PARAM_INT );
			$billingAddress->setId( $id ); // enforce ID to be present
		} else {
			$stmt->bind( $idx++, $this->siteId( $item->getSiteId(), \Aimeos\MShop\Locale\Manager\Base::SITE_SUBTREE ) );
			$stmt->bind( $idx, $context->datetime() ); // Creation time
		}

		$stmt->execute()->finish();

		if( $id === null && $fetch === true )
		{
			/** mshop/customer/manager/fosuser/newid
			 * Retrieves the ID generated by the database when inserting a new record
			 *
			 * As soon as a new record is inserted into the database table,
			 * the database server generates a new and unique identifier for
			 * that record. This ID can be used for retrieving, updating and
			 * deleting that specific record from the table again.
			 *
			 * For MySQL:
			 *  SELECT LAST_INSERT_ID()
			 * For PostgreSQL:
			 *  SELECT currval('seq_mcus_id')
			 * For SQL Server:
			 *  SELECT SCOPE_IDENTITY()
			 * For Oracle:
			 *  SELECT "seq_mcus_id".CURRVAL FROM DUAL
			 *
			 * There's no way to retrive the new ID by a SQL statements that
			 * fits for most database servers as they implement their own
			 * specific way.
			 *
			 * @param string SQL statement for retrieving the last inserted record ID
			 * @since 2015.01
			 * @category Developer
			 * @see mshop/customer/manager/fosuser/insert
			 * @see mshop/customer/manager/fosuser/update
			 * @see mshop/customer/manager/fosuser/delete
			 * @see mshop/customer/manager/fosuser/search
			 * @see mshop/customer/manager/fosuser/count
			 */
			$path = 'mshop/customer/manager/fosuser/newid';
			$id = $this->newId( $conn, $path );
		}

		return $this->object()->saveRefs( $item->setId( $id ), $fetch );
	}


	/**
	 * Returns the full configuration key for the passed last part
	 *
	 * @param string $name Configuration last part
	 * @return string Full configuration key
	 */
	protected function getConfigKey( string $name, string $default = '' ) : string
	{
		if( $this->context()->config()->get( 'mshop/customer/manager/fosuser/' . $name ) ) {
			return 'mshop/customer/manager/fosuser/' . $name;
		}

		return parent::getConfigKey( $name, $default );
	}


	/**
	 * Returns a new manager for customer extensions
	 *
	 * @param string $manager Name of the sub manager type in lower case
	 * @param string|null $name Name of the implementation, will be from configuration (or Default) if null
	 * @return mixed Manager for different extensions, e.g stock, tags, locations, etc.
	 */
	public function getSubManager( string $manager, ?string $name = null ) : \Aimeos\MShop\Common\Manager\Iface
	{
		return $this->getSubManagerBase( 'customer', $manager, $name ?: 'FosUser' );
	}


	/**
	 * Returns the name of the used table
	 *
	 * @return string Table name
	 */
	protected function table() : string
	{
		return 'fos_user';
	}
}
