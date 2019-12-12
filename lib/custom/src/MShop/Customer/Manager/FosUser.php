<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2018
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
	private $searchConfig = array(
		// customer.siteid is only for informational purpuse, not for filtering
		'customer.id' => array(
			'label' => 'Customer ID',
			'code' => 'customer.id',
			'internalcode' => 'fos."id"',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_INT,
			'public' => false,
		),
		'customer.code' => array(
			'label' => 'Customer username',
			'code' => 'customer.code',
			'internalcode' => 'fos."username"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR
		),
		'customer.label' => array(
			'label' => 'Customer label',
			'code' => 'customer.label',
			'internalcode' => 'fos."username_canonical"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR
		),
		'customer.salutation' => array(
			'label' => 'Customer salutation',
			'code' => 'customer.salutation',
			'internalcode' => 'fos."salutation"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.company'=> array(
			'label' => 'Customer company',
			'code' => 'customer.company',
			'internalcode' => 'fos."company"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.vatid'=> array(
			'label' => 'Customer VAT ID',
			'code' => 'customer.vatid',
			'internalcode' => 'fos."vatid"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.title' => array(
			'label' => 'Customer title',
			'code' => 'customer.title',
			'internalcode' => 'fos."title"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.firstname' => array(
			'label' => 'Customer firstname',
			'code' => 'customer.firstname',
			'internalcode' => 'fos."firstname"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.lastname' => array(
			'label' => 'Customer lastname',
			'code' => 'customer.lastname',
			'internalcode' => 'fos."lastname"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.address1' => array(
			'label' => 'Customer address part one',
			'code' => 'customer.address1',
			'internalcode' => 'fos."address1"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.address2' => array(
			'label' => 'Customer address part two',
			'code' => 'customer.address2',
			'internalcode' => 'fos."address2"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.address3' => array(
			'label' => 'Customer address part three',
			'code' => 'customer.address3',
			'internalcode' => 'fos."address3"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.postal' => array(
			'label' => 'Customer postal',
			'code' => 'customer.postal',
			'internalcode' => 'fos."postal"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.city' => array(
			'label' => 'Customer city',
			'code' => 'customer.city',
			'internalcode' => 'fos."city"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.state' => array(
			'label' => 'Customer state',
			'code' => 'customer.state',
			'internalcode' => 'fos."state"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.languageid' => array(
			'label' => 'Customer language',
			'code' => 'customer.languageid',
			'internalcode' => 'fos."langid"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.countryid' => array(
			'label' => 'Customer country',
			'code' => 'customer.countryid',
			'internalcode' => 'fos."countryid"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.telephone' => array(
			'label' => 'Customer telephone',
			'code' => 'customer.telephone',
			'internalcode' => 'fos."telephone"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.email' => array(
			'label' => 'Customer email',
			'code' => 'customer.email',
			'internalcode' => 'fos."email"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.telefax' => array(
			'label' => 'Customer telefax',
			'code' => 'customer.telefax',
			'internalcode' => 'fos."telefax"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.website' => array(
			'label' => 'Customer website',
			'code' => 'customer.website',
			'internalcode' => 'fos."website"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.longitude' => array(
			'label' => 'Customer longitude',
			'code' => 'customer.longitude',
			'internalcode' => 'fos."longitude"',
			'type' => 'float',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_FLOAT,
		),
		'customer.latitude' => array(
			'label' => 'Customer latitude',
			'code' => 'customer.latitude',
			'internalcode' => 'fos."latitude"',
			'type' => 'float',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_FLOAT,
		),
		'customer.birthday' => array(
			'label' => 'Customer birthday',
			'code' => 'customer.birthday',
			'internalcode' => 'fos."birthday"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.password'=> array(
			'label' => 'Customer password',
			'code' => 'customer.password',
			'internalcode' => 'fos."password"',
			'type' => 'string',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.status'=> array(
			'label' => 'Customer status',
			'code' => 'customer.status',
			'internalcode' => 'fos."enabled"',
			'type' => 'integer',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_BOOL,
		),
		'customer.dateverified'=> array(
			'label' => 'Customer verification date',
			'code' => 'customer.dateverified',
			'internalcode' => 'fos."vdate"',
			'type' => 'date',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.ctime'=> array(
			'label' => 'Customer creation time',
			'code' => 'customer.ctime',
			'internalcode' => 'fos."ctime"',
			'type' => 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.mtime'=> array(
			'label' => 'Customer modification time',
			'code' => 'customer.mtime',
			'internalcode' => 'fos."mtime"',
			'type' => 'datetime',
			'internaltype' => \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer.editor'=> array(
			'label'=>'Customer editor',
			'code'=>'customer.editor',
			'internalcode' => 'fos."editor"',
			'type'=> 'string',
			'internaltype'=> \Aimeos\MW\DB\Statement\Base::PARAM_STR,
		),
		'customer:has' => array(
			'code' => 'customer:has()',
			'internalcode' => ':site :key AND fosli."id"',
			'internaldeps' => ['LEFT JOIN "fos_user_list" AS fosli ON ( fosli."parentid" = fos."id" )'],
			'label' => 'Customer has list item, parameter(<domain>[,<list type>[,<reference ID>)]]',
			'type' => 'null',
			'internaltype' => 'null',
			'public' => false,
		),
		'customer:prop' => array(
			'code' => 'customer:prop()',
			'internalcode' => ':site :key AND fospr."id"',
			'internaldeps' => ['LEFT JOIN "fos_user_property" AS fospr ON ( fospr."parentid" = fos."id" )'],
			'label' => 'Customer has property item, parameter(<property type>[,<language code>[,<property value>]])',
			'type' => 'null',
			'internaltype' => 'null',
			'public' => false,
		),
	);


	/**
	 * Initializes the object.
	 *
	 * @param \Aimeos\MShop\Context\Item\Iface $context Context object
	 */
	public function __construct( \Aimeos\MShop\Context\Item\Iface $context )
	{
		parent::__construct( $context );

		$self = $this;
		$locale = $context->getLocale();

		$level = \Aimeos\MShop\Locale\Manager\Base::SITE_ALL;
		$level = $context->getConfig()->get( 'mshop/customer/manager/sitemode', $level );

		$siteIds = [$locale->getSiteId()];

		if( $level & \Aimeos\MShop\Locale\Manager\Base::SITE_PATH ) {
			$siteIds = array_merge( $siteIds, $locale->getSitePath() );
		}

		if( $level & \Aimeos\MShop\Locale\Manager\Base::SITE_SUBTREE ) {
			$siteIds = array_merge( $siteIds, $locale->getSiteSubTree() );
		}


		$this->searchConfig['customer:has']['function'] = function( &$source, array $params ) use ( $self, $siteIds ) {

			array_walk_recursive( $params, function( &$v ) {
				$v = trim( $v, '\'' );
			} );

			$keys = [];
			$params[1] = isset( $params[1] ) ? $params[1] : '';
			$params[2] = isset( $params[2] ) ? $params[2] : '';

			foreach( (array) $params[1] as $type ) {
				foreach( (array) $params[2] as $id ) {
					$keys[] = $params[0] . '|' . ( $type ? $type . '|' : '' ) . $id;
				}
			}

			$sitestr = $siteIds ? $self->toExpression( 'fosli."siteid"', $siteIds ) . ' AND' : '';
			$keystr = $self->toExpression( 'fosli."key"', $keys, $params[2] !== '' ? '==' : '=~' );
			$source = str_replace( [':site', ':key'], [$sitestr, $keystr], $source );

			return $params;
		};


		$this->searchConfig['customer:prop']['function'] = function( &$source, array $params ) use ( $self, $siteIds ) {

			array_walk_recursive( $params, function( &$v ) {
				$v = trim( $v, '\'' );
			} );

			$keys = [];
			$params[1] = array_key_exists( 1, $params ) ? $params[1] : '';
			$params[2] = isset( $params[2] ) ? $params[2] : '';

			foreach( (array) $params[1] as $lang ) {
				foreach( (array) $params[2] as $id ) {
					$keys[] = $params[0] . '|' . ( $lang ? $lang . '|' : '' ) . ( $id !== '' ?  md5( $id ) : '' );
				}
			}

			$sitestr = $siteIds ? $self->toExpression( 'fospr."siteid"', $siteIds ) . ' AND' : '';
			$keystr = $self->toExpression( 'fospr."key"', $keys, $params[2] !== '' ? '==' : '=~' );
			$source = str_replace( [':site', ':key'], [$sitestr, $keystr], $source );

			return $params;
		};
	}


	/**
	 * Removes old entries from the storage.
	 *
	 * @param array $siteids List of IDs for sites whose entries should be deleted
	 */
	public function cleanup( array $siteids )
	{
		$path = 'mshop/customer/manager/submanagers';
		$default = ['address', 'lists', 'property'];

		foreach( $this->getContext()->getConfig()->get( $path, $default ) as $domain ) {
			$this->getObject()->getSubManager( $domain )->cleanup( $siteids );
		}
	}


	/**
	 * Removes multiple items specified by ids in the array.
	 *
	 * @param array $ids List of IDs
	 */
	public function deleteItems( array $ids )
	{
		$path = 'mshop/customer/manager/fosuser/delete';
		$this->deleteItemsBase( $ids, $path, false );
	}


	/**
	 * Returns the list attributes that can be used for searching.
	 *
	 * @param boolean $withsub Return also attributes of sub-managers if true
	 * @return array List of attribute items implementing \Aimeos\MW\Criteria\Attribute\Iface
	 */
	public function getSearchAttributes( $withsub = true )
	{
		$path = 'mshop/customer/manager/submanagers';
		return $this->getSearchAttributesBase( $this->searchConfig, $path, ['address'], $withsub );
	}


	/**
	 * Saves a customer item object.
	 *
	 * @param \Aimeos\MShop\Customer\Item\Iface $item Customer item object
	 * @param boolean $fetch True if the new ID should be returned in the item
	 * @return \Aimeos\MShop\Common\Item\Iface $item Updated item including the generated ID
	 */
	public function saveItem( \Aimeos\MShop\Common\Item\Iface $item, $fetch = true )
	{
		self::checkClass( '\\Aimeos\\MShop\\Customer\\Item\\FosUser', $item );

		$item = $this->addGroups( $item );

		if( !$item->isModified() )
		{
			$item = $this->savePropertyItems( $item, 'customer' );
			$item = $this->saveAddressItems( $item, 'customer' );
			return $this->saveListItems( $item, 'customer' );
		}

		$context = $this->getContext();
		$dbm = $context->getDatabaseManager();
		$dbname = $this->getResourceName();
		$conn = $dbm->acquire( $dbname );

		try
		{
			$id = $item->getId();
			$date = date( 'Y-m-d H:i:s' );
			$billingAddress = $item->getPaymentAddress();
			$columns = $this->getObject()->getSaveAttributes();

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
				 * order in the saveItems() method, so the correct values are
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
				 * correspond to the order in the saveItems() method, so the
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
				$stmt->bind( $idx++, $item->get( $name ), $entry->getInternalType() );
			}

			$stmt->bind( $idx++, $context->getLocale()->getSiteId(), \Aimeos\MW\DB\Statement\Base::PARAM_INT );
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
			$stmt->bind( $idx++, $billingAddress->getEmail() );
			$stmt->bind( $idx++, $billingAddress->getEmail() );
			$stmt->bind( $idx++, $billingAddress->getTelefax() );
			$stmt->bind( $idx++, $billingAddress->getWebsite() );
			$stmt->bind( $idx++, $billingAddress->getLongitude(), \Aimeos\MW\DB\Statement\Base::PARAM_FLOAT );
			$stmt->bind( $idx++, $billingAddress->getLatitude(), \Aimeos\MW\DB\Statement\Base::PARAM_FLOAT );
			$stmt->bind( $idx++, $item->getBirthday() );
			$stmt->bind( $idx++, ( $item->getStatus() > 0 ? true : false ), \Aimeos\MW\DB\Statement\Base::PARAM_BOOL );
			$stmt->bind( $idx++, $item->getDateVerified() );
			$stmt->bind( $idx++, $item->getPassword() );
			$stmt->bind( $idx++, $date ); // Modification time
			$stmt->bind( $idx++, $context->getEditor() );
			$stmt->bind( $idx++, serialize( $item->getRoles() ) );
			$stmt->bind( $idx++, $item->getSalt() );

			if( $id !== null ) {
				$stmt->bind( $idx, $id, \Aimeos\MW\DB\Statement\Base::PARAM_INT );
				$item->setId( $id );
			} else {
				$stmt->bind( $idx, $date ); // Creation time
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
				$item->setId( $this->newId( $conn, $path ) );
			}

			$dbm->release( $conn, $dbname );
		}
		catch( \Exception $e )
		{
			$dbm->release( $conn, $dbname );
			throw $e;
		}

		$item = $this->savePropertyItems( $item, 'customer' );
		$item = $this->saveAddressItems( $item, 'customer' );
		return $this->saveListItems( $item, 'customer' );
	}


	/**
	 * Returns the item objects matched by the given search criteria.
	 *
	 * @param \Aimeos\MW\Criteria\Iface $search Search criteria object
	 * @param integer &$total Number of items that are available in total
	 * @return array List of items implementing \Aimeos\MShop\Customer\Item\Iface
	 * @throws \Aimeos\MShop\Customer\Exception If creating items failed
	 */
	public function searchItems( \Aimeos\MW\Criteria\Iface $search, array $ref = [], &$total = null )
	{
		$dbm = $this->getContext()->getDatabaseManager();
		$dbname = $this->getResourceName();
		$conn = $dbm->acquire( $dbname );
		$map = [];

		try
		{
			$level = \Aimeos\MShop\Locale\Manager\Base::SITE_ALL;
			$cfgPathSearch = 'mshop/customer/manager/fosuser/search';
			$cfgPathCount = 'mshop/customer/manager/fosuser/count';
			$ref[] = 'customer/group';
			$required = ['customer'];

			$results = $this->searchItemsBase( $conn, $search, $cfgPathSearch, $cfgPathCount, $required, $total, $level );
			while( ( $row = $results->fetch() ) !== false ) {
				$map[(string) $row['customer.id']] = $row;
			}

			$dbm->release( $conn, $dbname );
		}
		catch( \Exception $e )
		{
			$dbm->release( $conn, $dbname  );
			throw $e;
		}

		$addrItems = [];
		if( in_array( 'customer/address', $ref, true ) ) {
			$addrItems = $this->getAddressItems( array_keys( $map ), 'customer' );
		}

		$propItems = [];
		if( in_array( 'customer/property', $ref, true ) ) {
			$propItems = $this->getPropertyItems( array_keys( $map ), 'customer' );
		}

		return $this->buildItems( $map, $ref, 'customer', $addrItems, $propItems );
	}


	/**
	 * Returns a new manager for customer extensions
	 *
	 * @param string $manager Name of the sub manager type in lower case
	 * @param string|null $name Name of the implementation, will be from configuration (or Default) if null
	 * @return mixed Manager for different extensions, e.g stock, tags, locations, etc.
	 */
	public function getSubManager( $manager, $name = null )
	{
		return $this->getSubManagerBase( 'customer', $manager, ( $name === null ? 'FosUser' : $name ) );
	}


	/**
	 * Creates a new customer item.
	 *
	 * @param array $values List of attributes for customer item
	 * @param \Aimeos\MShop\Common\Lists\Item\Iface[] $listItems List of list items
	 * @param \Aimeos\MShop\Common\Item\Iface[] $refItems List of referenced items
	 * @param \Aimeos\MShop\Common\Item\Address\Iface[] $addrItems List of referenced address items
	 * @param \Aimeos\MShop\Common\Item\Property\Iface[] $propItems List of property items
	 * @return \Aimeos\MShop\Customer\Item\Iface New customer item
	 */
	protected function createItemBase( array $values = [], array $listItems = [], array $refItems = [],
		array $addrItems = [], array $propItems = [] )
	{
		if( isset( $values['roles'] ) ) {
			$values['roles'] = unserialize( $values['roles'] );
		}

		$helper = $this->getPasswordHelper();
		$address = new \Aimeos\MShop\Common\Item\Address\Simple( 'customer.', $values );

		return new \Aimeos\MShop\Customer\Item\FosUser(
			$address, $values, $listItems, $refItems, $addrItems, $propItems, $helper
		);
	}
}
