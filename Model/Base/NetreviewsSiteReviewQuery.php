<?php

namespace NetReviews\Model\Base;

use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsSiteReview as ChildNetreviewsSiteReview;
use NetReviews\Model\NetreviewsSiteReviewQuery as ChildNetreviewsSiteReviewQuery;
use NetReviews\Model\Map\NetreviewsSiteReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'netreviews_site_review' table.
 *
 *
 *
 * @method     ChildNetreviewsSiteReviewQuery orderBySiteReviewId($order = Criteria::ASC) Order by the site_review_id column
 * @method     ChildNetreviewsSiteReviewQuery orderByReviewId($order = Criteria::ASC) Order by the review_id column
 * @method     ChildNetreviewsSiteReviewQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 * @method     ChildNetreviewsSiteReviewQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildNetreviewsSiteReviewQuery orderByReview($order = Criteria::ASC) Order by the review column
 * @method     ChildNetreviewsSiteReviewQuery orderByReviewDate($order = Criteria::ASC) Order by the review_date column
 * @method     ChildNetreviewsSiteReviewQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildNetreviewsSiteReviewQuery orderByOrderRef($order = Criteria::ASC) Order by the order_ref column
 * @method     ChildNetreviewsSiteReviewQuery orderByOrderDate($order = Criteria::ASC) Order by the order_date column
 *
 * @method     ChildNetreviewsSiteReviewQuery groupBySiteReviewId() Group by the site_review_id column
 * @method     ChildNetreviewsSiteReviewQuery groupByReviewId() Group by the review_id column
 * @method     ChildNetreviewsSiteReviewQuery groupByLastname() Group by the lastname column
 * @method     ChildNetreviewsSiteReviewQuery groupByFirstname() Group by the firstname column
 * @method     ChildNetreviewsSiteReviewQuery groupByReview() Group by the review column
 * @method     ChildNetreviewsSiteReviewQuery groupByReviewDate() Group by the review_date column
 * @method     ChildNetreviewsSiteReviewQuery groupByRate() Group by the rate column
 * @method     ChildNetreviewsSiteReviewQuery groupByOrderRef() Group by the order_ref column
 * @method     ChildNetreviewsSiteReviewQuery groupByOrderDate() Group by the order_date column
 *
 * @method     ChildNetreviewsSiteReviewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNetreviewsSiteReviewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNetreviewsSiteReviewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNetreviewsSiteReview findOne(ConnectionInterface $con = null) Return the first ChildNetreviewsSiteReview matching the query
 * @method     ChildNetreviewsSiteReview findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNetreviewsSiteReview matching the query, or a new ChildNetreviewsSiteReview object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsSiteReview findOneBySiteReviewId(int $site_review_id) Return the first ChildNetreviewsSiteReview filtered by the site_review_id column
 * @method     ChildNetreviewsSiteReview findOneByReviewId(string $review_id) Return the first ChildNetreviewsSiteReview filtered by the review_id column
 * @method     ChildNetreviewsSiteReview findOneByLastname(string $lastname) Return the first ChildNetreviewsSiteReview filtered by the lastname column
 * @method     ChildNetreviewsSiteReview findOneByFirstname(string $firstname) Return the first ChildNetreviewsSiteReview filtered by the firstname column
 * @method     ChildNetreviewsSiteReview findOneByReview(string $review) Return the first ChildNetreviewsSiteReview filtered by the review column
 * @method     ChildNetreviewsSiteReview findOneByReviewDate(string $review_date) Return the first ChildNetreviewsSiteReview filtered by the review_date column
 * @method     ChildNetreviewsSiteReview findOneByRate(string $rate) Return the first ChildNetreviewsSiteReview filtered by the rate column
 * @method     ChildNetreviewsSiteReview findOneByOrderRef(string $order_ref) Return the first ChildNetreviewsSiteReview filtered by the order_ref column
 * @method     ChildNetreviewsSiteReview findOneByOrderDate(string $order_date) Return the first ChildNetreviewsSiteReview filtered by the order_date column
 *
 * @method     array findBySiteReviewId(int $site_review_id) Return ChildNetreviewsSiteReview objects filtered by the site_review_id column
 * @method     array findByReviewId(string $review_id) Return ChildNetreviewsSiteReview objects filtered by the review_id column
 * @method     array findByLastname(string $lastname) Return ChildNetreviewsSiteReview objects filtered by the lastname column
 * @method     array findByFirstname(string $firstname) Return ChildNetreviewsSiteReview objects filtered by the firstname column
 * @method     array findByReview(string $review) Return ChildNetreviewsSiteReview objects filtered by the review column
 * @method     array findByReviewDate(string $review_date) Return ChildNetreviewsSiteReview objects filtered by the review_date column
 * @method     array findByRate(string $rate) Return ChildNetreviewsSiteReview objects filtered by the rate column
 * @method     array findByOrderRef(string $order_ref) Return ChildNetreviewsSiteReview objects filtered by the order_ref column
 * @method     array findByOrderDate(string $order_date) Return ChildNetreviewsSiteReview objects filtered by the order_date column
 *
 */
abstract class NetreviewsSiteReviewQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsSiteReviewQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\NetReviews\\Model\\NetreviewsSiteReview', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsSiteReviewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsSiteReviewQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \NetReviews\Model\NetreviewsSiteReviewQuery) {
            return $criteria;
        }
        $query = new \NetReviews\Model\NetreviewsSiteReviewQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildNetreviewsSiteReview|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NetreviewsSiteReviewTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildNetreviewsSiteReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT SITE_REVIEW_ID, REVIEW_ID, LASTNAME, FIRSTNAME, REVIEW, REVIEW_DATE, RATE, ORDER_REF, ORDER_DATE FROM netreviews_site_review WHERE SITE_REVIEW_ID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildNetreviewsSiteReview();
            $obj->hydrate($row);
            NetreviewsSiteReviewTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildNetreviewsSiteReview|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the site_review_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySiteReviewId(1234); // WHERE site_review_id = 1234
     * $query->filterBySiteReviewId(array(12, 34)); // WHERE site_review_id IN (12, 34)
     * $query->filterBySiteReviewId(array('min' => 12)); // WHERE site_review_id > 12
     * </code>
     *
     * @param     mixed $siteReviewId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterBySiteReviewId($siteReviewId = null, $comparison = null)
    {
        if (is_array($siteReviewId)) {
            $useMinMax = false;
            if (isset($siteReviewId['min'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $siteReviewId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteReviewId['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $siteReviewId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $siteReviewId, $comparison);
    }

    /**
     * Filter the query on the review_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReviewId('fooValue');   // WHERE review_id = 'fooValue'
     * $query->filterByReviewId('%fooValue%'); // WHERE review_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reviewId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByReviewId($reviewId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reviewId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $reviewId)) {
                $reviewId = str_replace('*', '%', $reviewId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::REVIEW_ID, $reviewId, $comparison);
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%'); // WHERE lastname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lastname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lastname)) {
                $lastname = str_replace('*', '%', $lastname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::LASTNAME, $lastname, $comparison);
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%'); // WHERE firstname LIKE '%fooValue%'
     * </code>
     *
     * @param     string $firstname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $firstname)) {
                $firstname = str_replace('*', '%', $firstname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::FIRSTNAME, $firstname, $comparison);
    }

    /**
     * Filter the query on the review column
     *
     * Example usage:
     * <code>
     * $query->filterByReview('fooValue');   // WHERE review = 'fooValue'
     * $query->filterByReview('%fooValue%'); // WHERE review LIKE '%fooValue%'
     * </code>
     *
     * @param     string $review The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByReview($review = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($review)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $review)) {
                $review = str_replace('*', '%', $review);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::REVIEW, $review, $comparison);
    }

    /**
     * Filter the query on the review_date column
     *
     * Example usage:
     * <code>
     * $query->filterByReviewDate('2011-03-14'); // WHERE review_date = '2011-03-14'
     * $query->filterByReviewDate('now'); // WHERE review_date = '2011-03-14'
     * $query->filterByReviewDate(array('max' => 'yesterday')); // WHERE review_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $reviewDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByReviewDate($reviewDate = null, $comparison = null)
    {
        if (is_array($reviewDate)) {
            $useMinMax = false;
            if (isset($reviewDate['min'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::REVIEW_DATE, $reviewDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reviewDate['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::REVIEW_DATE, $reviewDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::REVIEW_DATE, $reviewDate, $comparison);
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate('fooValue');   // WHERE rate = 'fooValue'
     * $query->filterByRate('%fooValue%'); // WHERE rate LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rate The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByRate($rate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rate)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rate)) {
                $rate = str_replace('*', '%', $rate);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::RATE, $rate, $comparison);
    }

    /**
     * Filter the query on the order_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderRef('fooValue');   // WHERE order_ref = 'fooValue'
     * $query->filterByOrderRef('%fooValue%'); // WHERE order_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $orderRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByOrderRef($orderRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $orderRef)) {
                $orderRef = str_replace('*', '%', $orderRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::ORDER_REF, $orderRef, $comparison);
    }

    /**
     * Filter the query on the order_date column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderDate('2011-03-14'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate('now'); // WHERE order_date = '2011-03-14'
     * $query->filterByOrderDate(array('max' => 'yesterday')); // WHERE order_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $orderDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function filterByOrderDate($orderDate = null, $comparison = null)
    {
        if (is_array($orderDate)) {
            $useMinMax = false;
            if (isset($orderDate['min'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::ORDER_DATE, $orderDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderDate['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::ORDER_DATE, $orderDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsSiteReviewTableMap::ORDER_DATE, $orderDate, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNetreviewsSiteReview $netreviewsSiteReview Object to remove from the list of results
     *
     * @return ChildNetreviewsSiteReviewQuery The current query, for fluid interface
     */
    public function prune($netreviewsSiteReview = null)
    {
        if ($netreviewsSiteReview) {
            $this->addUsingAlias(NetreviewsSiteReviewTableMap::SITE_REVIEW_ID, $netreviewsSiteReview->getSiteReviewId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_site_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NetreviewsSiteReviewTableMap::clearInstancePool();
            NetreviewsSiteReviewTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildNetreviewsSiteReview or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildNetreviewsSiteReview object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsSiteReviewTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        NetreviewsSiteReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsSiteReviewTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // NetreviewsSiteReviewQuery
