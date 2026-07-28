<?php

namespace NetReviews\Model\Map;

use NetReviews\Model\NetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'netreviews_product_review' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NetreviewsProductReviewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsProductReviewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'TheliaMain';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'netreviews_product_review';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'NetreviewsProductReview';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\NetReviews\\Model\\NetreviewsProductReview';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsProductReview';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the product_review_id field
     */
    public const COL_PRODUCT_REVIEW_ID = 'netreviews_product_review.product_review_id';

    /**
     * the column name for the review_id field
     */
    public const COL_REVIEW_ID = 'netreviews_product_review.review_id';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'netreviews_product_review.email';

    /**
     * the column name for the lastname field
     */
    public const COL_LASTNAME = 'netreviews_product_review.lastname';

    /**
     * the column name for the firstname field
     */
    public const COL_FIRSTNAME = 'netreviews_product_review.firstname';

    /**
     * the column name for the review_date field
     */
    public const COL_REVIEW_DATE = 'netreviews_product_review.review_date';

    /**
     * the column name for the message field
     */
    public const COL_MESSAGE = 'netreviews_product_review.message';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'netreviews_product_review.rate';

    /**
     * the column name for the order_ref field
     */
    public const COL_ORDER_REF = 'netreviews_product_review.order_ref';

    /**
     * the column name for the product_ref field
     */
    public const COL_PRODUCT_REF = 'netreviews_product_review.product_ref';

    /**
     * the column name for the product_id field
     */
    public const COL_PRODUCT_ID = 'netreviews_product_review.product_id';

    /**
     * the column name for the exchange field
     */
    public const COL_EXCHANGE = 'netreviews_product_review.exchange';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'netreviews_product_review.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'netreviews_product_review.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['ProductReviewId', 'ReviewId', 'Email', 'Lastname', 'Firstname', 'ReviewDate', 'Message', 'Rate', 'OrderRef', 'ProductRef', 'ProductId', 'Exchange', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['productReviewId', 'reviewId', 'email', 'lastname', 'firstname', 'reviewDate', 'message', 'rate', 'orderRef', 'productRef', 'productId', 'exchange', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, NetreviewsProductReviewTableMap::COL_REVIEW_ID, NetreviewsProductReviewTableMap::COL_EMAIL, NetreviewsProductReviewTableMap::COL_LASTNAME, NetreviewsProductReviewTableMap::COL_FIRSTNAME, NetreviewsProductReviewTableMap::COL_REVIEW_DATE, NetreviewsProductReviewTableMap::COL_MESSAGE, NetreviewsProductReviewTableMap::COL_RATE, NetreviewsProductReviewTableMap::COL_ORDER_REF, NetreviewsProductReviewTableMap::COL_PRODUCT_REF, NetreviewsProductReviewTableMap::COL_PRODUCT_ID, NetreviewsProductReviewTableMap::COL_EXCHANGE, NetreviewsProductReviewTableMap::COL_CREATED_AT, NetreviewsProductReviewTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['product_review_id', 'review_id', 'email', 'lastname', 'firstname', 'review_date', 'message', 'rate', 'order_ref', 'product_ref', 'product_id', 'exchange', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['ProductReviewId' => 0, 'ReviewId' => 1, 'Email' => 2, 'Lastname' => 3, 'Firstname' => 4, 'ReviewDate' => 5, 'Message' => 6, 'Rate' => 7, 'OrderRef' => 8, 'ProductRef' => 9, 'ProductId' => 10, 'Exchange' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ],
        self::TYPE_CAMELNAME     => ['productReviewId' => 0, 'reviewId' => 1, 'email' => 2, 'lastname' => 3, 'firstname' => 4, 'reviewDate' => 5, 'message' => 6, 'rate' => 7, 'orderRef' => 8, 'productRef' => 9, 'productId' => 10, 'exchange' => 11, 'createdAt' => 12, 'updatedAt' => 13, ],
        self::TYPE_COLNAME       => [NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID => 0, NetreviewsProductReviewTableMap::COL_REVIEW_ID => 1, NetreviewsProductReviewTableMap::COL_EMAIL => 2, NetreviewsProductReviewTableMap::COL_LASTNAME => 3, NetreviewsProductReviewTableMap::COL_FIRSTNAME => 4, NetreviewsProductReviewTableMap::COL_REVIEW_DATE => 5, NetreviewsProductReviewTableMap::COL_MESSAGE => 6, NetreviewsProductReviewTableMap::COL_RATE => 7, NetreviewsProductReviewTableMap::COL_ORDER_REF => 8, NetreviewsProductReviewTableMap::COL_PRODUCT_REF => 9, NetreviewsProductReviewTableMap::COL_PRODUCT_ID => 10, NetreviewsProductReviewTableMap::COL_EXCHANGE => 11, NetreviewsProductReviewTableMap::COL_CREATED_AT => 12, NetreviewsProductReviewTableMap::COL_UPDATED_AT => 13, ],
        self::TYPE_FIELDNAME     => ['product_review_id' => 0, 'review_id' => 1, 'email' => 2, 'lastname' => 3, 'firstname' => 4, 'review_date' => 5, 'message' => 6, 'rate' => 7, 'order_ref' => 8, 'product_ref' => 9, 'product_id' => 10, 'exchange' => 11, 'created_at' => 12, 'updated_at' => 13, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'ProductReviewId' => 'PRODUCT_REVIEW_ID',
        'NetreviewsProductReview.ProductReviewId' => 'PRODUCT_REVIEW_ID',
        'productReviewId' => 'PRODUCT_REVIEW_ID',
        'netreviewsProductReview.productReviewId' => 'PRODUCT_REVIEW_ID',
        'NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID' => 'PRODUCT_REVIEW_ID',
        'COL_PRODUCT_REVIEW_ID' => 'PRODUCT_REVIEW_ID',
        'product_review_id' => 'PRODUCT_REVIEW_ID',
        'netreviews_product_review.product_review_id' => 'PRODUCT_REVIEW_ID',
        'ReviewId' => 'REVIEW_ID',
        'NetreviewsProductReview.ReviewId' => 'REVIEW_ID',
        'reviewId' => 'REVIEW_ID',
        'netreviewsProductReview.reviewId' => 'REVIEW_ID',
        'NetreviewsProductReviewTableMap::COL_REVIEW_ID' => 'REVIEW_ID',
        'COL_REVIEW_ID' => 'REVIEW_ID',
        'review_id' => 'REVIEW_ID',
        'netreviews_product_review.review_id' => 'REVIEW_ID',
        'Email' => 'EMAIL',
        'NetreviewsProductReview.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'netreviewsProductReview.email' => 'EMAIL',
        'NetreviewsProductReviewTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'netreviews_product_review.email' => 'EMAIL',
        'Lastname' => 'LASTNAME',
        'NetreviewsProductReview.Lastname' => 'LASTNAME',
        'lastname' => 'LASTNAME',
        'netreviewsProductReview.lastname' => 'LASTNAME',
        'NetreviewsProductReviewTableMap::COL_LASTNAME' => 'LASTNAME',
        'COL_LASTNAME' => 'LASTNAME',
        'netreviews_product_review.lastname' => 'LASTNAME',
        'Firstname' => 'FIRSTNAME',
        'NetreviewsProductReview.Firstname' => 'FIRSTNAME',
        'firstname' => 'FIRSTNAME',
        'netreviewsProductReview.firstname' => 'FIRSTNAME',
        'NetreviewsProductReviewTableMap::COL_FIRSTNAME' => 'FIRSTNAME',
        'COL_FIRSTNAME' => 'FIRSTNAME',
        'netreviews_product_review.firstname' => 'FIRSTNAME',
        'ReviewDate' => 'REVIEW_DATE',
        'NetreviewsProductReview.ReviewDate' => 'REVIEW_DATE',
        'reviewDate' => 'REVIEW_DATE',
        'netreviewsProductReview.reviewDate' => 'REVIEW_DATE',
        'NetreviewsProductReviewTableMap::COL_REVIEW_DATE' => 'REVIEW_DATE',
        'COL_REVIEW_DATE' => 'REVIEW_DATE',
        'review_date' => 'REVIEW_DATE',
        'netreviews_product_review.review_date' => 'REVIEW_DATE',
        'Message' => 'MESSAGE',
        'NetreviewsProductReview.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'netreviewsProductReview.message' => 'MESSAGE',
        'NetreviewsProductReviewTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'netreviews_product_review.message' => 'MESSAGE',
        'Rate' => 'RATE',
        'NetreviewsProductReview.Rate' => 'RATE',
        'rate' => 'RATE',
        'netreviewsProductReview.rate' => 'RATE',
        'NetreviewsProductReviewTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'netreviews_product_review.rate' => 'RATE',
        'OrderRef' => 'ORDER_REF',
        'NetreviewsProductReview.OrderRef' => 'ORDER_REF',
        'orderRef' => 'ORDER_REF',
        'netreviewsProductReview.orderRef' => 'ORDER_REF',
        'NetreviewsProductReviewTableMap::COL_ORDER_REF' => 'ORDER_REF',
        'COL_ORDER_REF' => 'ORDER_REF',
        'order_ref' => 'ORDER_REF',
        'netreviews_product_review.order_ref' => 'ORDER_REF',
        'ProductRef' => 'PRODUCT_REF',
        'NetreviewsProductReview.ProductRef' => 'PRODUCT_REF',
        'productRef' => 'PRODUCT_REF',
        'netreviewsProductReview.productRef' => 'PRODUCT_REF',
        'NetreviewsProductReviewTableMap::COL_PRODUCT_REF' => 'PRODUCT_REF',
        'COL_PRODUCT_REF' => 'PRODUCT_REF',
        'product_ref' => 'PRODUCT_REF',
        'netreviews_product_review.product_ref' => 'PRODUCT_REF',
        'ProductId' => 'PRODUCT_ID',
        'NetreviewsProductReview.ProductId' => 'PRODUCT_ID',
        'productId' => 'PRODUCT_ID',
        'netreviewsProductReview.productId' => 'PRODUCT_ID',
        'NetreviewsProductReviewTableMap::COL_PRODUCT_ID' => 'PRODUCT_ID',
        'COL_PRODUCT_ID' => 'PRODUCT_ID',
        'product_id' => 'PRODUCT_ID',
        'netreviews_product_review.product_id' => 'PRODUCT_ID',
        'Exchange' => 'EXCHANGE',
        'NetreviewsProductReview.Exchange' => 'EXCHANGE',
        'exchange' => 'EXCHANGE',
        'netreviewsProductReview.exchange' => 'EXCHANGE',
        'NetreviewsProductReviewTableMap::COL_EXCHANGE' => 'EXCHANGE',
        'COL_EXCHANGE' => 'EXCHANGE',
        'netreviews_product_review.exchange' => 'EXCHANGE',
        'CreatedAt' => 'CREATED_AT',
        'NetreviewsProductReview.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'netreviewsProductReview.createdAt' => 'CREATED_AT',
        'NetreviewsProductReviewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'netreviews_product_review.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'NetreviewsProductReview.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'netreviewsProductReview.updatedAt' => 'UPDATED_AT',
        'NetreviewsProductReviewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'netreviews_product_review.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('netreviews_product_review');
        $this->setPhpName('NetreviewsProductReview');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\NetReviews\\Model\\NetreviewsProductReview');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('product_review_id', 'ProductReviewId', 'VARCHAR', true, 55, null);
        $this->addColumn('review_id', 'ReviewId', 'VARCHAR', true, 55, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('lastname', 'Lastname', 'VARCHAR', false, 255, null);
        $this->addColumn('firstname', 'Firstname', 'VARCHAR', false, 255, null);
        $this->addColumn('review_date', 'ReviewDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('message', 'Message', 'VARCHAR', false, 10000, null);
        $this->addColumn('rate', 'Rate', 'VARCHAR', false, 255, null);
        $this->addColumn('order_ref', 'OrderRef', 'VARCHAR', false, 255, null);
        $this->addColumn('product_ref', 'ProductRef', 'VARCHAR', false, 255, null);
        $this->addColumn('product_id', 'ProductId', 'INTEGER', false, null, null);
        $this->addColumn('exchange', 'Exchange', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('NetreviewsProductReviewExchange', '\\NetReviews\\Model\\NetreviewsProductReviewExchange', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':product_review_id',
    1 => ':product_review_id',
  ),
), 'CASCADE', 'CASCADE', 'NetreviewsProductReviewExchanges', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false'],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to netreviews_product_review     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        NetreviewsProductReviewExchangeTableMap::clearInstancePool();
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? NetreviewsProductReviewTableMap::CLASS_DEFAULT : NetreviewsProductReviewTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (NetreviewsProductReview object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NetreviewsProductReviewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsProductReviewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsProductReviewTableMap::OM_CLASS;
            /** @var NetreviewsProductReview $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsProductReviewTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = NetreviewsProductReviewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NetreviewsProductReview $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NetreviewsProductReviewTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_EMAIL);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_REVIEW_DATE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_RATE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_ORDER_REF);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_REF);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_EXCHANGE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.product_review_id');
            $criteria->addSelectColumn($alias . '.review_id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.lastname');
            $criteria->addSelectColumn($alias . '.firstname');
            $criteria->addSelectColumn($alias . '.review_date');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.order_ref');
            $criteria->addSelectColumn($alias . '.product_ref');
            $criteria->addSelectColumn($alias . '.product_id');
            $criteria->addSelectColumn($alias . '.exchange');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_REVIEW_ID);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_LASTNAME);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_FIRSTNAME);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_REVIEW_DATE);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_MESSAGE);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_RATE);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_ORDER_REF);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_REF);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_PRODUCT_ID);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_EXCHANGE);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(NetreviewsProductReviewTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.product_review_id');
            $criteria->removeSelectColumn($alias . '.review_id');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.lastname');
            $criteria->removeSelectColumn($alias . '.firstname');
            $criteria->removeSelectColumn($alias . '.review_date');
            $criteria->removeSelectColumn($alias . '.message');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.order_ref');
            $criteria->removeSelectColumn($alias . '.product_ref');
            $criteria->removeSelectColumn($alias . '.product_id');
            $criteria->removeSelectColumn($alias . '.exchange');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewTableMap::DATABASE_NAME)->getTable(NetreviewsProductReviewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsProductReview or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or NetreviewsProductReview object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \NetReviews\Model\NetreviewsProductReview) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NetreviewsProductReviewTableMap::DATABASE_NAME);
            $criteria->add(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsProductReviewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NetreviewsProductReviewTableMap::clearInstancePool();
        } elseif (!\is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NetreviewsProductReviewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the netreviews_product_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NetreviewsProductReviewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsProductReview or Criteria object.
     *
     * @param mixed $criteria Criteria or NetreviewsProductReview object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NetreviewsProductReview object
        }


        // Set the correct dbName
        $query = NetreviewsProductReviewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
