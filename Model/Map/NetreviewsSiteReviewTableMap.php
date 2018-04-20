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
 *
 */
class NetreviewsSiteReviewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsSiteReviewTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'netreviews_site_review';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\NetReviews\\Model\\NetreviewsSiteReview';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsSiteReview';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the SITE_REVIEW_ID field
     */
    const SITE_REVIEW_ID = 'netreviews_site_review.SITE_REVIEW_ID';

    /**
     * the column name for the REVIEW_ID field
     */
    const REVIEW_ID = 'netreviews_site_review.REVIEW_ID';

    /**
     * the column name for the LASTNAME field
     */
    const LASTNAME = 'netreviews_site_review.LASTNAME';

    /**
     * the column name for the FIRSTNAME field
     */
    const FIRSTNAME = 'netreviews_site_review.FIRSTNAME';

    /**
     * the column name for the REVIEW field
     */
    const REVIEW = 'netreviews_site_review.REVIEW';

    /**
     * the column name for the REVIEW_DATE field
     */
    const REVIEW_DATE = 'netreviews_site_review.REVIEW_DATE';

    /**
     * the column name for the RATE field
     */
    const RATE = 'netreviews_site_review.RATE';

    /**
     * the column name for the ORDER_REF field
     */
    const ORDER_REF = 'netreviews_site_review.ORDER_REF';

    /**
     * the column name for the ORDER_DATE field
     */
    const ORDER_DATE = 'netreviews_site_review.ORDER_DATE';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('SiteReviewId', 'ReviewId', 'Lastname', 'Firstname', 'Review', 'ReviewDate', 'Rate', 'OrderRef', 'OrderDate', ),
        self::TYPE_STUDLYPHPNAME => array('siteReviewId', 'reviewId', 'lastname', 'firstname', 'review', 'reviewDate', 'rate', 'orderRef', 'orderDate', ),
        self::TYPE_COLNAME       => array(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, NetreviewsSiteReviewTableMap::REVIEW_ID, NetreviewsSiteReviewTableMap::LASTNAME, NetreviewsSiteReviewTableMap::FIRSTNAME, NetreviewsSiteReviewTableMap::REVIEW, NetreviewsSiteReviewTableMap::REVIEW_DATE, NetreviewsSiteReviewTableMap::RATE, NetreviewsSiteReviewTableMap::ORDER_REF, NetreviewsSiteReviewTableMap::ORDER_DATE, ),
        self::TYPE_RAW_COLNAME   => array('SITE_REVIEW_ID', 'REVIEW_ID', 'LASTNAME', 'FIRSTNAME', 'REVIEW', 'REVIEW_DATE', 'RATE', 'ORDER_REF', 'ORDER_DATE', ),
        self::TYPE_FIELDNAME     => array('site_review_id', 'review_id', 'lastname', 'firstname', 'review', 'review_date', 'rate', 'order_ref', 'order_date', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('SiteReviewId' => 0, 'ReviewId' => 1, 'Lastname' => 2, 'Firstname' => 3, 'Review' => 4, 'ReviewDate' => 5, 'Rate' => 6, 'OrderRef' => 7, 'OrderDate' => 8, ),
        self::TYPE_STUDLYPHPNAME => array('siteReviewId' => 0, 'reviewId' => 1, 'lastname' => 2, 'firstname' => 3, 'review' => 4, 'reviewDate' => 5, 'rate' => 6, 'orderRef' => 7, 'orderDate' => 8, ),
        self::TYPE_COLNAME       => array(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID => 0, NetreviewsSiteReviewTableMap::REVIEW_ID => 1, NetreviewsSiteReviewTableMap::LASTNAME => 2, NetreviewsSiteReviewTableMap::FIRSTNAME => 3, NetreviewsSiteReviewTableMap::REVIEW => 4, NetreviewsSiteReviewTableMap::REVIEW_DATE => 5, NetreviewsSiteReviewTableMap::RATE => 6, NetreviewsSiteReviewTableMap::ORDER_REF => 7, NetreviewsSiteReviewTableMap::ORDER_DATE => 8, ),
        self::TYPE_RAW_COLNAME   => array('SITE_REVIEW_ID' => 0, 'REVIEW_ID' => 1, 'LASTNAME' => 2, 'FIRSTNAME' => 3, 'REVIEW' => 4, 'REVIEW_DATE' => 5, 'RATE' => 6, 'ORDER_REF' => 7, 'ORDER_DATE' => 8, ),
        self::TYPE_FIELDNAME     => array('site_review_id' => 0, 'review_id' => 1, 'lastname' => 2, 'firstname' => 3, 'review' => 4, 'review_date' => 5, 'rate' => 6, 'order_ref' => 7, 'order_date' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('netreviews_site_review');
        $this->setPhpName('NetreviewsSiteReview');
        $this->setClassName('\\NetReviews\\Model\\NetreviewsSiteReview');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('SITE_REVIEW_ID', 'SiteReviewId', 'INTEGER', true, null, null);
        $this->addColumn('REVIEW_ID', 'ReviewId', 'VARCHAR', true, 255, null);
        $this->addColumn('LASTNAME', 'Lastname', 'VARCHAR', false, 255, null);
        $this->addColumn('FIRSTNAME', 'Firstname', 'VARCHAR', false, 255, null);
        $this->addColumn('REVIEW', 'Review', 'CLOB', false, null, null);
        $this->addColumn('REVIEW_DATE', 'ReviewDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('RATE', 'Rate', 'VARCHAR', false, 255, null);
        $this->addColumn('ORDER_REF', 'OrderRef', 'VARCHAR', false, 255, null);
        $this->addColumn('ORDER_DATE', 'OrderDate', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('SiteReviewId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? NetreviewsSiteReviewTableMap::CLASS_DEFAULT : NetreviewsSiteReviewTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     * @return array (NetreviewsSiteReview object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = NetreviewsSiteReviewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsSiteReviewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsSiteReviewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsSiteReviewTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsSiteReviewTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::LASTNAME);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::FIRSTNAME);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::REVIEW);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::REVIEW_DATE);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::RATE);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::ORDER_REF);
            $criteria->addSelectColumn(NetreviewsSiteReviewTableMap::ORDER_DATE);
        } else {
            $criteria->addSelectColumn($alias . '.SITE_REVIEW_ID');
            $criteria->addSelectColumn($alias . '.REVIEW_ID');
            $criteria->addSelectColumn($alias . '.LASTNAME');
            $criteria->addSelectColumn($alias . '.FIRSTNAME');
            $criteria->addSelectColumn($alias . '.REVIEW');
            $criteria->addSelectColumn($alias . '.REVIEW_DATE');
            $criteria->addSelectColumn($alias . '.RATE');
            $criteria->addSelectColumn($alias . '.ORDER_REF');
            $criteria->addSelectColumn($alias . '.ORDER_DATE');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsSiteReviewTableMap::DATABASE_NAME)->getTable(NetreviewsSiteReviewTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(NetreviewsSiteReviewTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(NetreviewsSiteReviewTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new NetreviewsSiteReviewTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsSiteReview or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or NetreviewsSiteReview object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
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
            $criteria->add(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsSiteReviewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { NetreviewsSiteReviewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { NetreviewsSiteReviewTableMap::removeInstanceFromPool($singleval);
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
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return NetreviewsSiteReviewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsSiteReview or Criteria object.
     *
     * @param mixed               $criteria Criteria or NetreviewsSiteReview object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NetreviewsSiteReview object
        }

        if ($criteria->containsKey(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID) && $criteria->keyContainsValue(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NetreviewsSiteReviewTableMap::SITE_REVIEW_ID.')');
        }


        // Set the correct dbName
        $query = NetreviewsSiteReviewQuery::create()->mergeWith($criteria);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = $query->doInsert($con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

} // NetreviewsSiteReviewTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
NetreviewsSiteReviewTableMap::buildTableMap();
