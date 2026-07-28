<?php

namespace NetReviews\Model\Map;

use NetReviews\Model\NetreviewsProductReviewExchange;
use NetReviews\Model\NetreviewsProductReviewExchangeQuery;
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
 * This class defines the structure of the 'netreviews_product_review_exchange' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NetreviewsProductReviewExchangeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsProductReviewExchangeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'TheliaMain';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'netreviews_product_review_exchange';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'NetreviewsProductReviewExchange';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\NetReviews\\Model\\NetreviewsProductReviewExchange';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsProductReviewExchange';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    public const COL_ID = 'netreviews_product_review_exchange.id';

    /**
     * the column name for the product_review_id field
     */
    public const COL_PRODUCT_REVIEW_ID = 'netreviews_product_review_exchange.product_review_id';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'netreviews_product_review_exchange.date';

    /**
     * the column name for the who field
     */
    public const COL_WHO = 'netreviews_product_review_exchange.who';

    /**
     * the column name for the message field
     */
    public const COL_MESSAGE = 'netreviews_product_review_exchange.message';

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
        self::TYPE_PHPNAME       => ['Id', 'ProductReviewId', 'Date', 'Who', 'Message', ],
        self::TYPE_CAMELNAME     => ['id', 'productReviewId', 'date', 'who', 'message', ],
        self::TYPE_COLNAME       => [NetreviewsProductReviewExchangeTableMap::COL_ID, NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID, NetreviewsProductReviewExchangeTableMap::COL_DATE, NetreviewsProductReviewExchangeTableMap::COL_WHO, NetreviewsProductReviewExchangeTableMap::COL_MESSAGE, ],
        self::TYPE_FIELDNAME     => ['id', 'product_review_id', 'date', 'who', 'message', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'ProductReviewId' => 1, 'Date' => 2, 'Who' => 3, 'Message' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'productReviewId' => 1, 'date' => 2, 'who' => 3, 'message' => 4, ],
        self::TYPE_COLNAME       => [NetreviewsProductReviewExchangeTableMap::COL_ID => 0, NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID => 1, NetreviewsProductReviewExchangeTableMap::COL_DATE => 2, NetreviewsProductReviewExchangeTableMap::COL_WHO => 3, NetreviewsProductReviewExchangeTableMap::COL_MESSAGE => 4, ],
        self::TYPE_FIELDNAME     => ['id' => 0, 'product_review_id' => 1, 'date' => 2, 'who' => 3, 'message' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'NetreviewsProductReviewExchange.Id' => 'ID',
        'id' => 'ID',
        'netreviewsProductReviewExchange.id' => 'ID',
        'NetreviewsProductReviewExchangeTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'netreviews_product_review_exchange.id' => 'ID',
        'ProductReviewId' => 'PRODUCT_REVIEW_ID',
        'NetreviewsProductReviewExchange.ProductReviewId' => 'PRODUCT_REVIEW_ID',
        'productReviewId' => 'PRODUCT_REVIEW_ID',
        'netreviewsProductReviewExchange.productReviewId' => 'PRODUCT_REVIEW_ID',
        'NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID' => 'PRODUCT_REVIEW_ID',
        'COL_PRODUCT_REVIEW_ID' => 'PRODUCT_REVIEW_ID',
        'product_review_id' => 'PRODUCT_REVIEW_ID',
        'netreviews_product_review_exchange.product_review_id' => 'PRODUCT_REVIEW_ID',
        'Date' => 'DATE',
        'NetreviewsProductReviewExchange.Date' => 'DATE',
        'date' => 'DATE',
        'netreviewsProductReviewExchange.date' => 'DATE',
        'NetreviewsProductReviewExchangeTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'netreviews_product_review_exchange.date' => 'DATE',
        'Who' => 'WHO',
        'NetreviewsProductReviewExchange.Who' => 'WHO',
        'who' => 'WHO',
        'netreviewsProductReviewExchange.who' => 'WHO',
        'NetreviewsProductReviewExchangeTableMap::COL_WHO' => 'WHO',
        'COL_WHO' => 'WHO',
        'netreviews_product_review_exchange.who' => 'WHO',
        'Message' => 'MESSAGE',
        'NetreviewsProductReviewExchange.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'netreviewsProductReviewExchange.message' => 'MESSAGE',
        'NetreviewsProductReviewExchangeTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'netreviews_product_review_exchange.message' => 'MESSAGE',
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
        $this->setName('netreviews_product_review_exchange');
        $this->setPhpName('NetreviewsProductReviewExchange');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\NetReviews\\Model\\NetreviewsProductReviewExchange');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('product_review_id', 'ProductReviewId', 'VARCHAR', 'netreviews_product_review', 'product_review_id', true, 55, null);
        $this->addColumn('date', 'Date', 'TIMESTAMP', false, null, null);
        $this->addColumn('who', 'Who', 'VARCHAR', false, 255, null);
        $this->addColumn('message', 'Message', 'VARCHAR', false, 10000, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('NetreviewsProductReview', '\\NetReviews\\Model\\NetreviewsProductReview', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':product_review_id',
    1 => ':product_review_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NetreviewsProductReviewExchangeTableMap::CLASS_DEFAULT : NetreviewsProductReviewExchangeTableMap::OM_CLASS;
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
     * @return array (NetreviewsProductReviewExchange object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NetreviewsProductReviewExchangeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsProductReviewExchangeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsProductReviewExchangeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsProductReviewExchangeTableMap::OM_CLASS;
            /** @var NetreviewsProductReviewExchange $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsProductReviewExchangeTableMap::addInstanceToPool($obj, $key);
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
            $key = NetreviewsProductReviewExchangeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NetreviewsProductReviewExchangeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NetreviewsProductReviewExchange $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NetreviewsProductReviewExchangeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_DATE);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_WHO);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_MESSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.product_review_id');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.who');
            $criteria->addSelectColumn($alias . '.message');
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
            $criteria->removeSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_ID);
            $criteria->removeSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID);
            $criteria->removeSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_DATE);
            $criteria->removeSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_WHO);
            $criteria->removeSelectColumn(NetreviewsProductReviewExchangeTableMap::COL_MESSAGE);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.product_review_id');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.who');
            $criteria->removeSelectColumn($alias . '.message');
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
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME)->getTable(NetreviewsProductReviewExchangeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsProductReviewExchange or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or NetreviewsProductReviewExchange object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \NetReviews\Model\NetreviewsProductReviewExchange) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
            $criteria->add(NetreviewsProductReviewExchangeTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsProductReviewExchangeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NetreviewsProductReviewExchangeTableMap::clearInstancePool();
        } elseif (!\is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NetreviewsProductReviewExchangeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the netreviews_product_review_exchange table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NetreviewsProductReviewExchangeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsProductReviewExchange or Criteria object.
     *
     * @param mixed $criteria Criteria or NetreviewsProductReviewExchange object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NetreviewsProductReviewExchange object
        }

        if ($criteria->containsKey(NetreviewsProductReviewExchangeTableMap::COL_ID) && $criteria->keyContainsValue(NetreviewsProductReviewExchangeTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NetreviewsProductReviewExchangeTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = NetreviewsProductReviewExchangeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
