<?php

namespace NetReviews\Model\Map;

use NetReviews\Model\NetreviewsSiteReview;
use NetReviews\Model\NetreviewsSiteReviewQuery;
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
 * This class defines the structure of the 'netreviews_site_review' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class NetreviewsSiteReviewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsSiteReviewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'TheliaMain';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'netreviews_site_review';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'NetreviewsSiteReview';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\NetReviews\\Model\\NetreviewsSiteReview';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsSiteReview';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the site_review_id field
     */
    public const COL_SITE_REVIEW_ID = 'netreviews_site_review.site_review_id';

    /**
     * the column name for the review_id field
     */
    public const COL_REVIEW_ID = 'netreviews_site_review.review_id';

    /**
     * the column name for the lastname field
     */
    public const COL_LASTNAME = 'netreviews_site_review.lastname';

    /**
     * the column name for the firstname field
     */
    public const COL_FIRSTNAME = 'netreviews_site_review.firstname';

    /**
     * the column name for the review field
     */
    public const COL_REVIEW = 'netreviews_site_review.review';

    /**
     * the column name for the review_date field
     */
    public const COL_REVIEW_DATE = 'netreviews_site_review.review_date';

    /**
     * the column name for the rate field
     */
    public const COL_RATE = 'netreviews_site_review.rate';

    /**
     * the column name for the order_ref field
     */
    public const COL_ORDER_REF = 'netreviews_site_review.order_ref';

    /**
     * the column name for the order_date field
     */
    public const COL_ORDER_DATE = 'netreviews_site_review.order_date';

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
        self::TYPE_PHPNAME       => ['SiteReviewId', 'ReviewId', 'Lastname', 'Firstname', 'Review', 'ReviewDate', 'Rate', 'OrderRef', 'OrderDate', ],
        self::TYPE_CAMELNAME     => ['siteReviewId', 'reviewId', 'lastname', 'firstname', 'review', 'reviewDate', 'rate', 'orderRef', 'orderDate', ],
        self::TYPE_COLNAME       => [NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, NetreviewsSiteReviewTableMap::COL_REVIEW_ID, NetreviewsSiteReviewTableMap::COL_LASTNAME, NetreviewsSiteReviewTableMap::COL_FIRSTNAME, NetreviewsSiteReviewTableMap::COL_REVIEW, NetreviewsSiteReviewTableMap::COL_REVIEW_DATE, NetreviewsSiteReviewTableMap::COL_RATE, NetreviewsSiteReviewTableMap::COL_ORDER_REF, NetreviewsSiteReviewTableMap::COL_ORDER_DATE, ],
        self::TYPE_FIELDNAME     => ['site_review_id', 'review_id', 'lastname', 'firstname', 'review', 'review_date', 'rate', 'order_ref', 'order_date', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['SiteReviewId' => 0, 'ReviewId' => 1, 'Lastname' => 2, 'Firstname' => 3, 'Review' => 4, 'ReviewDate' => 5, 'Rate' => 6, 'OrderRef' => 7, 'OrderDate' => 8, ],
        self::TYPE_CAMELNAME     => ['siteReviewId' => 0, 'reviewId' => 1, 'lastname' => 2, 'firstname' => 3, 'review' => 4, 'reviewDate' => 5, 'rate' => 6, 'orderRef' => 7, 'orderDate' => 8, ],
        self::TYPE_COLNAME       => [NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID => 0, NetreviewsSiteReviewTableMap::COL_REVIEW_ID => 1, NetreviewsSiteReviewTableMap::COL_LASTNAME => 2, NetreviewsSiteReviewTableMap::COL_FIRSTNAME => 3, NetreviewsSiteReviewTableMap::COL_REVIEW => 4, NetreviewsSiteReviewTableMap::COL_REVIEW_DATE => 5, NetreviewsSiteReviewTableMap::COL_RATE => 6, NetreviewsSiteReviewTableMap::COL_ORDER_REF => 7, NetreviewsSiteReviewTableMap::COL_ORDER_DATE => 8, ],
        self::TYPE_FIELDNAME     => ['site_review_id' => 0, 'review_id' => 1, 'lastname' => 2, 'firstname' => 3, 'review' => 4, 'review_date' => 5, 'rate' => 6, 'order_ref' => 7, 'order_date' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'SiteReviewId' => 'SITE_REVIEW_ID',
        'NetreviewsSiteReview.SiteReviewId' => 'SITE_REVIEW_ID',
        'siteReviewId' => 'SITE_REVIEW_ID',
        'netreviewsSiteReview.siteReviewId' => 'SITE_REVIEW_ID',
        'NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID' => 'SITE_REVIEW_ID',
        'COL_SITE_REVIEW_ID' => 'SITE_REVIEW_ID',
        'site_review_id' => 'SITE_REVIEW_ID',
        'netreviews_site_review.site_review_id' => 'SITE_REVIEW_ID',
        'ReviewId' => 'REVIEW_ID',
        'NetreviewsSiteReview.ReviewId' => 'REVIEW_ID',
        'reviewId' => 'REVIEW_ID',
        'netreviewsSiteReview.reviewId' => 'REVIEW_ID',
        'NetreviewsSiteReviewTableMap::COL_REVIEW_ID' => 'REVIEW_ID',
        'COL_REVIEW_ID' => 'REVIEW_ID',
        'review_id' => 'REVIEW_ID',
        'netreviews_site_review.review_id' => 'REVIEW_ID',
        'Lastname' => 'LASTNAME',
        'NetreviewsSiteReview.Lastname' => 'LASTNAME',
        'lastname' => 'LASTNAME',
        'netreviewsSiteReview.lastname' => 'LASTNAME',
        'NetreviewsSiteReviewTableMap::COL_LASTNAME' => 'LASTNAME',
        'COL_LASTNAME' => 'LASTNAME',
        'netreviews_site_review.lastname' => 'LASTNAME',
        'Firstname' => 'FIRSTNAME',
        'NetreviewsSiteReview.Firstname' => 'FIRSTNAME',
        'firstname' => 'FIRSTNAME',
        'netreviewsSiteReview.firstname' => 'FIRSTNAME',
        'NetreviewsSiteReviewTableMap::COL_FIRSTNAME' => 'FIRSTNAME',
        'COL_FIRSTNAME' => 'FIRSTNAME',
        'netreviews_site_review.firstname' => 'FIRSTNAME',
        'Review' => 'REVIEW',
        'NetreviewsSiteReview.Review' => 'REVIEW',
        'review' => 'REVIEW',
        'netreviewsSiteReview.review' => 'REVIEW',
        'NetreviewsSiteReviewTableMap::COL_REVIEW' => 'REVIEW',
        'COL_REVIEW' => 'REVIEW',
        'netreviews_site_review.review' => 'REVIEW',
        'ReviewDate' => 'REVIEW_DATE',
        'NetreviewsSiteReview.ReviewDate' => 'REVIEW_DATE',
        'reviewDate' => 'REVIEW_DATE',
        'netreviewsSiteReview.reviewDate' => 'REVIEW_DATE',
        'NetreviewsSiteReviewTableMap::COL_REVIEW_DATE' => 'REVIEW_DATE',
        'COL_REVIEW_DATE' => 'REVIEW_DATE',
        'review_date' => 'REVIEW_DATE',
        'netreviews_site_review.review_date' => 'REVIEW_DATE',
        'Rate' => 'RATE',
        'NetreviewsSiteReview.Rate' => 'RATE',
        'rate' => 'RATE',
        'netreviewsSiteReview.rate' => 'RATE',
        'NetreviewsSiteReviewTableMap::COL_RATE' => 'RATE',
        'COL_RATE' => 'RATE',
        'netreviews_site_review.rate' => 'RATE',
        'OrderRef' => 'ORDER_REF',
        'NetreviewsSiteReview.OrderRef' => 'ORDER_REF',
        'orderRef' => 'ORDER_REF',
        'netreviewsSiteReview.orderRef' => 'ORDER_REF',
        'NetreviewsSiteReviewTableMap::COL_ORDER_REF' => 'ORDER_REF',
        'COL_ORDER_REF' => 'ORDER_REF',
        'order_ref' => 'ORDER_REF',
        'netreviews_site_review.order_ref' => 'ORDER_REF',
        'OrderDate' => 'ORDER_DATE',
        'NetreviewsSiteReview.OrderDate' => 'ORDER_DATE',
        'orderDate' => 'ORDER_DATE',
        'netreviewsSiteReview.orderDate' => 'ORDER_DATE',
        'NetreviewsSiteReviewTableMap::COL_ORDER_DATE' => 'ORDER_DATE',
        'COL_ORDER_DATE' => 'ORDER_DATE',
        'order_date' => 'ORDER_DATE',
        'netreviews_site_review.order_date' => 'ORDER_DATE',
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
        $this->setName('netreviews_site_review');
        $this->setPhpName('NetreviewsSiteReview');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\NetReviews\\Model\\NetreviewsSiteReview');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('site_review_id', 'SiteReviewId', 'INTEGER', true, null, null);
        $this->addColumn('review_id', 'ReviewId', 'VARCHAR', true, 255, null);
        $this->addColumn('lastname', 'Lastname', 'VARCHAR', false, 255, null);
        $this->addColumn('firstname', 'Firstname', 'VARCHAR', false, 255, null);
        $this->addColumn('review', 'Review', 'VARCHAR', false, 10000, null);
        $this->addColumn('review_date', 'ReviewDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('rate', 'Rate', 'VARCHAR', false, 255, null);
        $this->addColumn('order_ref', 'OrderRef', 'VARCHAR', false, 255, null);
        $this->addColumn('order_date', 'OrderDate', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? NetreviewsSiteReviewTableMap::CLASS_DEFAULT : NetreviewsSiteReviewTableMap::OM_CLASS;
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
     * @return array (NetreviewsSiteReview object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = NetreviewsSiteReviewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsSiteReviewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsSiteReviewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsSiteReviewTableMap::OM_CLASS;
            /** @var NetreviewsSiteReview $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsSiteReviewTableMap::addInstanceToPool($obj, $key);
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
            $key = NetreviewsSiteReviewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NetreviewsSiteReviewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var NetreviewsSiteReview $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NetreviewsSiteReviewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_LASTNAME);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_FIRSTNAME);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW_DATE);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_RATE);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_ORDER_REF);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::COL_ORDER_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.site_review_id');
            $criteria->addSelectColumn($alias . '.review_id');
            $criteria->addSelectColumn($alias . '.lastname');
            $criteria->addSelectColumn($alias . '.firstname');
            $criteria->addSelectColumn($alias . '.review');
            $criteria->addSelectColumn($alias . '.review_date');
            $criteria->addSelectColumn($alias . '.rate');
            $criteria->addSelectColumn($alias . '.order_ref');
            $criteria->addSelectColumn($alias . '.order_date');
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
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW_ID);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_LASTNAME);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_FIRSTNAME);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_REVIEW_DATE);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_RATE);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_ORDER_REF);
            $criteria->removeSelectColumn(NetreviewsSiteReviewTableMap::COL_ORDER_DATE);
        } else {
            $criteria->removeSelectColumn($alias . '.site_review_id');
            $criteria->removeSelectColumn($alias . '.review_id');
            $criteria->removeSelectColumn($alias . '.lastname');
            $criteria->removeSelectColumn($alias . '.firstname');
            $criteria->removeSelectColumn($alias . '.review');
            $criteria->removeSelectColumn($alias . '.review_date');
            $criteria->removeSelectColumn($alias . '.rate');
            $criteria->removeSelectColumn($alias . '.order_ref');
            $criteria->removeSelectColumn($alias . '.order_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsSiteReviewTableMap::DATABASE_NAME)->getTable(NetreviewsSiteReviewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsSiteReview or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or NetreviewsSiteReview object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \NetReviews\Model\NetreviewsSiteReview) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NetreviewsSiteReviewTableMap::DATABASE_NAME);
            $criteria->add(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsSiteReviewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            NetreviewsSiteReviewTableMap::clearInstancePool();
        } elseif (!\is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                NetreviewsSiteReviewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the netreviews_site_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return NetreviewsSiteReviewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsSiteReview or Criteria object.
     *
     * @param mixed $criteria Criteria or NetreviewsSiteReview object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NetreviewsSiteReview object
        }

        if ($criteria->containsKey(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID) && $criteria->keyContainsValue(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID.')');
        }


        // Set the correct dbName
        $query = NetreviewsSiteReviewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
