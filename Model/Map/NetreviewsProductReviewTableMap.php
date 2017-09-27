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
 *
 */
class NetreviewsProductReviewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;
    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'NetReviews.Model.Map.NetreviewsProductReviewTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'thelia';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'netreviews_product_review';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\NetReviews\\Model\\NetreviewsProductReview';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'NetReviews.Model.NetreviewsProductReview';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the PRODUCT_REVIEW_ID field
     */
    const PRODUCT_REVIEW_ID = 'netreviews_product_review.PRODUCT_REVIEW_ID';

    /**
     * the column name for the REVIEW_ID field
     */
    const REVIEW_ID = 'netreviews_product_review.REVIEW_ID';

    /**
     * the column name for the EMAIL field
     */
    const EMAIL = 'netreviews_product_review.EMAIL';

    /**
     * the column name for the LASTNAME field
     */
    const LASTNAME = 'netreviews_product_review.LASTNAME';

    /**
     * the column name for the FIRSTNAME field
     */
    const FIRSTNAME = 'netreviews_product_review.FIRSTNAME';

    /**
     * the column name for the REVIEW_DATE field
     */
    const REVIEW_DATE = 'netreviews_product_review.REVIEW_DATE';

    /**
     * the column name for the MESSAGE field
     */
    const MESSAGE = 'netreviews_product_review.MESSAGE';

    /**
     * the column name for the RATE field
     */
    const RATE = 'netreviews_product_review.RATE';

    /**
     * the column name for the ORDER_REF field
     */
    const ORDER_REF = 'netreviews_product_review.ORDER_REF';

    /**
     * the column name for the PRODUCT_REF field
     */
    const PRODUCT_REF = 'netreviews_product_review.PRODUCT_REF';

    /**
     * the column name for the PRODUCT_ID field
     */
    const PRODUCT_ID = 'netreviews_product_review.PRODUCT_ID';

    /**
     * the column name for the EXCHANGE field
     */
    const EXCHANGE = 'netreviews_product_review.EXCHANGE';

    /**
     * the column name for the CREATED_AT field
     */
    const CREATED_AT = 'netreviews_product_review.CREATED_AT';

    /**
     * the column name for the UPDATED_AT field
     */
    const UPDATED_AT = 'netreviews_product_review.UPDATED_AT';

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
        self::TYPE_PHPNAME       => array('ProductReviewId', 'ReviewId', 'Email', 'Lastname', 'Firstname', 'ReviewDate', 'Message', 'Rate', 'OrderRef', 'ProductRef', 'ProductId', 'Exchange', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_STUDLYPHPNAME => array('productReviewId', 'reviewId', 'email', 'lastname', 'firstname', 'reviewDate', 'message', 'rate', 'orderRef', 'productRef', 'productId', 'exchange', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, NetreviewsProductReviewTableMap::REVIEW_ID, NetreviewsProductReviewTableMap::EMAIL, NetreviewsProductReviewTableMap::LASTNAME, NetreviewsProductReviewTableMap::FIRSTNAME, NetreviewsProductReviewTableMap::REVIEW_DATE, NetreviewsProductReviewTableMap::MESSAGE, NetreviewsProductReviewTableMap::RATE, NetreviewsProductReviewTableMap::ORDER_REF, NetreviewsProductReviewTableMap::PRODUCT_REF, NetreviewsProductReviewTableMap::PRODUCT_ID, NetreviewsProductReviewTableMap::EXCHANGE, NetreviewsProductReviewTableMap::CREATED_AT, NetreviewsProductReviewTableMap::UPDATED_AT, ),
        self::TYPE_RAW_COLNAME   => array('PRODUCT_REVIEW_ID', 'REVIEW_ID', 'EMAIL', 'LASTNAME', 'FIRSTNAME', 'REVIEW_DATE', 'MESSAGE', 'RATE', 'ORDER_REF', 'PRODUCT_REF', 'PRODUCT_ID', 'EXCHANGE', 'CREATED_AT', 'UPDATED_AT', ),
        self::TYPE_FIELDNAME     => array('product_review_id', 'review_id', 'email', 'lastname', 'firstname', 'review_date', 'message', 'rate', 'order_ref', 'product_ref', 'product_id', 'exchange', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ProductReviewId' => 0, 'ReviewId' => 1, 'Email' => 2, 'Lastname' => 3, 'Firstname' => 4, 'ReviewDate' => 5, 'Message' => 6, 'Rate' => 7, 'OrderRef' => 8, 'ProductRef' => 9, 'ProductId' => 10, 'Exchange' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
        self::TYPE_STUDLYPHPNAME => array('productReviewId' => 0, 'reviewId' => 1, 'email' => 2, 'lastname' => 3, 'firstname' => 4, 'reviewDate' => 5, 'message' => 6, 'rate' => 7, 'orderRef' => 8, 'productRef' => 9, 'productId' => 10, 'exchange' => 11, 'createdAt' => 12, 'updatedAt' => 13, ),
        self::TYPE_COLNAME       => array(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID => 0, NetreviewsProductReviewTableMap::REVIEW_ID => 1, NetreviewsProductReviewTableMap::EMAIL => 2, NetreviewsProductReviewTableMap::LASTNAME => 3, NetreviewsProductReviewTableMap::FIRSTNAME => 4, NetreviewsProductReviewTableMap::REVIEW_DATE => 5, NetreviewsProductReviewTableMap::MESSAGE => 6, NetreviewsProductReviewTableMap::RATE => 7, NetreviewsProductReviewTableMap::ORDER_REF => 8, NetreviewsProductReviewTableMap::PRODUCT_REF => 9, NetreviewsProductReviewTableMap::PRODUCT_ID => 10, NetreviewsProductReviewTableMap::EXCHANGE => 11, NetreviewsProductReviewTableMap::CREATED_AT => 12, NetreviewsProductReviewTableMap::UPDATED_AT => 13, ),
        self::TYPE_RAW_COLNAME   => array('PRODUCT_REVIEW_ID' => 0, 'REVIEW_ID' => 1, 'EMAIL' => 2, 'LASTNAME' => 3, 'FIRSTNAME' => 4, 'REVIEW_DATE' => 5, 'MESSAGE' => 6, 'RATE' => 7, 'ORDER_REF' => 8, 'PRODUCT_REF' => 9, 'PRODUCT_ID' => 10, 'EXCHANGE' => 11, 'CREATED_AT' => 12, 'UPDATED_AT' => 13, ),
        self::TYPE_FIELDNAME     => array('product_review_id' => 0, 'review_id' => 1, 'email' => 2, 'lastname' => 3, 'firstname' => 4, 'review_date' => 5, 'message' => 6, 'rate' => 7, 'order_ref' => 8, 'product_ref' => 9, 'product_id' => 10, 'exchange' => 11, 'created_at' => 12, 'updated_at' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
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
        $this->setName('netreviews_product_review');
        $this->setPhpName('NetreviewsProductReview');
        $this->setClassName('\\NetReviews\\Model\\NetreviewsProductReview');
        $this->setPackage('NetReviews.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('PRODUCT_REVIEW_ID', 'ProductReviewId', 'VARCHAR', true, 55, null);
        $this->addColumn('REVIEW_ID', 'ReviewId', 'VARCHAR', true, 55, null);
        $this->addColumn('EMAIL', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('LASTNAME', 'Lastname', 'VARCHAR', false, 255, null);
        $this->addColumn('FIRSTNAME', 'Firstname', 'VARCHAR', false, 255, null);
        $this->addColumn('REVIEW_DATE', 'ReviewDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('MESSAGE', 'Message', 'CLOB', false, null, null);
        $this->addColumn('RATE', 'Rate', 'VARCHAR', false, 255, null);
        $this->addColumn('ORDER_REF', 'OrderRef', 'VARCHAR', false, 255, null);
        $this->addColumn('PRODUCT_REF', 'ProductRef', 'VARCHAR', false, 255, null);
        $this->addColumn('PRODUCT_ID', 'ProductId', 'INTEGER', false, null, null);
        $this->addColumn('EXCHANGE', 'Exchange', 'INTEGER', false, null, null);
        $this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('NetreviewsProductReviewExchange', '\\NetReviews\\Model\\NetreviewsProductReviewExchange', RelationMap::ONE_TO_MANY, array('product_review_id' => 'product_review_id', ), 'CASCADE', 'CASCADE', 'NetreviewsProductReviewExchanges');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to netreviews_product_review     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in ".$this->getClassNameFromBuilder($joinedTableTableMapBuilder)." instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
                NetreviewsProductReviewExchangeTableMap::clearInstancePool();
            }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)];
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
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? NetreviewsProductReviewTableMap::CLASS_DEFAULT : NetreviewsProductReviewTableMap::OM_CLASS;
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
     * @return array (NetreviewsProductReview object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = NetreviewsProductReviewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + NetreviewsProductReviewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NetreviewsProductReviewTableMap::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            NetreviewsProductReviewTableMap::addInstanceToPool($obj, $key);
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
            $key = NetreviewsProductReviewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
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
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::REVIEW_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::EMAIL);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::LASTNAME);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::FIRSTNAME);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::REVIEW_DATE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::MESSAGE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::RATE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::ORDER_REF);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::PRODUCT_REF);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::PRODUCT_ID);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::EXCHANGE);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::CREATED_AT);
            $criteria->addSelectColumn(NetreviewsProductReviewTableMap::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.PRODUCT_REVIEW_ID');
            $criteria->addSelectColumn($alias . '.REVIEW_ID');
            $criteria->addSelectColumn($alias . '.EMAIL');
            $criteria->addSelectColumn($alias . '.LASTNAME');
            $criteria->addSelectColumn($alias . '.FIRSTNAME');
            $criteria->addSelectColumn($alias . '.REVIEW_DATE');
            $criteria->addSelectColumn($alias . '.MESSAGE');
            $criteria->addSelectColumn($alias . '.RATE');
            $criteria->addSelectColumn($alias . '.ORDER_REF');
            $criteria->addSelectColumn($alias . '.PRODUCT_REF');
            $criteria->addSelectColumn($alias . '.PRODUCT_ID');
            $criteria->addSelectColumn($alias . '.EXCHANGE');
            $criteria->addSelectColumn($alias . '.CREATED_AT');
            $criteria->addSelectColumn($alias . '.UPDATED_AT');
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
        return Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewTableMap::DATABASE_NAME)->getTable(NetreviewsProductReviewTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getServiceContainer()->getDatabaseMap(NetreviewsProductReviewTableMap::DATABASE_NAME);
      if (!$dbMap->hasTable(NetreviewsProductReviewTableMap::TABLE_NAME)) {
        $dbMap->addTableObject(new NetreviewsProductReviewTableMap());
      }
    }

    /**
     * Performs a DELETE on the database, given a NetreviewsProductReview or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or NetreviewsProductReview object or primary key or array of primary keys
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
            $criteria->add(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, (array) $values, Criteria::IN);
        }

        $query = NetreviewsProductReviewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) { NetreviewsProductReviewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) { NetreviewsProductReviewTableMap::removeInstanceFromPool($singleval);
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
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return NetreviewsProductReviewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a NetreviewsProductReview or Criteria object.
     *
     * @param mixed               $criteria Criteria or NetreviewsProductReview object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
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

} // NetreviewsProductReviewTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
NetreviewsProductReviewTableMap::buildTableMap();
