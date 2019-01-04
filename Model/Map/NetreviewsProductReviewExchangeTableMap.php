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
 *
 */
class NetreviewsProductReviewExchangeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsProductReviewExchangeTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'netreviews_product_review_exchange';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\NetReviews\\Model\\NetreviewsProductReviewExchange';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsProductReviewExchange';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the ID field
     */
    const ID = 'netreviews_product_review_exchange.ID';

    /**
     * the column name for the PRODUCT_REVIEW_ID field
     */
    const PRODUCT_REVIEW_ID = 'netreviews_product_review_exchange.PRODUCT_REVIEW_ID';

    /**
     * the column name for the DATE field
     */
    const DATE = 'netreviews_product_review_exchange.DATE';

    /**
     * the column name for the WHO field
     */
    const WHO = 'netreviews_product_review_exchange.WHO';

    /**
     * the column name for the MESSAGE field
     */
    const MESSAGE = 'netreviews_product_review_exchange.MESSAGE';

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
        self::TYPE_PHPNAME       => array('Id', 'ProductReviewId', 'Date', 'Who', 'Message', ),
        self::TYPE_STUDLYPHPNAME => array('id', 'productReviewId', 'date', 'who', 'message', ),
        self::TYPE_COLNAME       => array(NetreviewsProductReviewExchangeTableMap::ID, NetreviewsProductReviewExchangeTableMap::PRODUCT_REVIEW_ID, NetreviewsProductReviewExchangeTableMap::DATE, NetreviewsProductReviewExchangeTableMap::WHO, NetreviewsProductReviewExchangeTableMap::MESSAGE, ),
        self::TYPE_RAW_COLNAME   => array('ID', 'PRODUCT_REVIEW_ID', 'DATE', 'WHO', 'MESSAGE', ),
        self::TYPE_FIELDNAME     => array('id', 'product_review_id', 'date', 'who', 'message', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ProductReviewId' => 1, 'Date' => 2, 'Who' => 3, 'Message' => 4, ),
        self::TYPE_STUDLYPHPNAME => array('id' => 0, 'productReviewId' => 1, 'date' => 2, 'who' => 3, 'message' => 4, ),
        self::TYPE_COLNAME       => array(NetreviewsProductReviewExchangeTableMap::ID => 0, NetreviewsProductReviewExchangeTableMap::PRODUCT_REVIEW_ID => 1, NetreviewsProductReviewExchangeTableMap::DATE => 2, NetreviewsProductReviewExchangeTableMap::WHO => 3, NetreviewsProductReviewExchangeTableMap::MESSAGE => 4, ),
        self::TYPE_RAW_COLNAME   => array('ID' => 0, 'PRODUCT_REVIEW_ID' => 1, 'DATE' => 2, 'WHO' => 3, 'MESSAGE' => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'product_review_id' => 1, 'date' => 2, 'who' => 3, 'message' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('netreviews_product_review_exchange');
        $this->setPhpName('NetreviewsProductReviewExchange');
        $this->setClassName('\\NetReviews\\Model\\NetreviewsProductReviewExchange');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('PRODUCT_REVIEW_ID', 'ProductReviewId', 'VARCHAR', 'netreviews_product_review', 'PRODUCT_REVIEW_ID', true, 55, null);
        $this->addColumn('DATE', 'Date', 'TIMESTAMP', false, null, null);
        $this->addColumn('WHO', 'Who', 'VARCHAR', false, 255, null);
        $this->addColumn('MESSAGE', 'Message', 'VARCHAR', false, 10000, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NetreviewsProductReview', '\\NetReviews\\Model\\NetreviewsProductReview', RelationMap::MANY_TO_ONE, array('product_review_id' => 'product_review_id', ), 'CASCADE', 'CASCADE');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? NetreviewsProductReviewExchangeTableMap::CLASS_DEFAULT : NetreviewsProductReviewExchangeTableMap::OM_CLASS;
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
     * @return array (NetreviewsProductReviewExchange object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = NetreviewsProductReviewExchangeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsProductReviewExchangeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsProductReviewExchangeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsProductReviewExchangeTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsProductReviewExchangeTableMap::addInstanceToPool($obj, $key);
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
            $key = NetreviewsProductReviewExchangeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NetreviewsProductReviewExchangeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::ID);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::PRODUCT_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::DATE);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::WHO);
            $criteria->addSelectColumn(NetreviewsProductReviewExchangeTableMap::MESSAGE);
        } else {
            $criteria->addSelectColumn($alias . '.ID');
            $criteria->addSelectColumn($alias . '.PRODUCT_REVIEW_ID');
            $criteria->addSelectColumn($alias . '.DATE');
            $criteria->addSelectColumn($alias . '.WHO');
            $criteria->addSelectColumn($alias . '.MESSAGE');
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
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME)->getTable(NetreviewsProductReviewExchangeTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(NetreviewsProductReviewExchangeTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new NetreviewsProductReviewExchangeTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsProductReviewExchange or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or NetreviewsProductReviewExchange object or primary key or array of primary keys
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
            $criteria->add(NetreviewsProductReviewExchangeTableMap::ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsProductReviewExchangeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { NetreviewsProductReviewExchangeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { NetreviewsProductReviewExchangeTableMap::removeInstanceFromPool($singleval);
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
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return NetreviewsProductReviewExchangeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsProductReviewExchange or Criteria object.
     *
     * @param mixed               $criteria Criteria or NetreviewsProductReviewExchange object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from NetreviewsProductReviewExchange object
        }

        if ($criteria->containsKey(NetreviewsProductReviewExchangeTableMap::ID) && $criteria->keyContainsValue(NetreviewsProductReviewExchangeTableMap::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NetreviewsProductReviewExchangeTableMap::ID.')');
        }


        // Set the correct dbName
        $query = NetreviewsProductReviewExchangeQuery::create()->mergeWith($criteria);

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

} // NetreviewsProductReviewExchangeTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
NetreviewsProductReviewExchangeTableMap::buildTableMap();
