<?php

namespace NetReviews\Model\Base;

use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsOrderQueue as ChildNetreviewsOrderQueue;
use NetReviews\Model\NetreviewsOrderQueueQuery as ChildNetreviewsOrderQueueQuery;
use NetReviews\Model\Map\NetreviewsOrderQueueTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `netreviews_order_queue` table.
 *
 * @method     ChildNetreviewsOrderQueueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNetreviewsOrderQueueQuery orderByOrderId($order = Criteria::ASC) Order by the order_id column
 * @method     ChildNetreviewsOrderQueueQuery orderByTreatedAt($order = Criteria::ASC) Order by the treated_at column
 * @method     ChildNetreviewsOrderQueueQuery orderByStatus($order = Criteria::ASC) Order by the status column
 *
 * @method     ChildNetreviewsOrderQueueQuery groupById() Group by the id column
 * @method     ChildNetreviewsOrderQueueQuery groupByOrderId() Group by the order_id column
 * @method     ChildNetreviewsOrderQueueQuery groupByTreatedAt() Group by the treated_at column
 * @method     ChildNetreviewsOrderQueueQuery groupByStatus() Group by the status column
 *
 * @method     ChildNetreviewsOrderQueueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNetreviewsOrderQueueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNetreviewsOrderQueueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNetreviewsOrderQueueQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNetreviewsOrderQueueQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNetreviewsOrderQueueQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNetreviewsOrderQueue|null findOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsOrderQueue matching the query
 * @method     ChildNetreviewsOrderQueue findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNetreviewsOrderQueue matching the query, or a new ChildNetreviewsOrderQueue object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsOrderQueue|null findOneById(int $id) Return the first ChildNetreviewsOrderQueue filtered by the id column
 * @method     ChildNetreviewsOrderQueue|null findOneByOrderId(int $order_id) Return the first ChildNetreviewsOrderQueue filtered by the order_id column
 * @method     ChildNetreviewsOrderQueue|null findOneByTreatedAt(string $treated_at) Return the first ChildNetreviewsOrderQueue filtered by the treated_at column
 * @method     ChildNetreviewsOrderQueue|null findOneByStatus(string $status) Return the first ChildNetreviewsOrderQueue filtered by the status column
 *
 * @method     ChildNetreviewsOrderQueue requirePk($key, ?ConnectionInterface $con = null) Return the ChildNetreviewsOrderQueue by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsOrderQueue requireOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsOrderQueue matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsOrderQueue requireOneById(int $id) Return the first ChildNetreviewsOrderQueue filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsOrderQueue requireOneByOrderId(int $order_id) Return the first ChildNetreviewsOrderQueue filtered by the order_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsOrderQueue requireOneByTreatedAt(string $treated_at) Return the first ChildNetreviewsOrderQueue filtered by the treated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsOrderQueue requireOneByStatus(string $status) Return the first ChildNetreviewsOrderQueue filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsOrderQueue[]|Collection find(?ConnectionInterface $con = null) Return ChildNetreviewsOrderQueue objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNetreviewsOrderQueue> find(?ConnectionInterface $con = null) Return ChildNetreviewsOrderQueue objects based on current ModelCriteria
 *
 * @method     ChildNetreviewsOrderQueue[]|Collection findById(int|array<int> $id) Return ChildNetreviewsOrderQueue objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsOrderQueue> findById(int|array<int> $id) Return ChildNetreviewsOrderQueue objects filtered by the id column
 * @method     ChildNetreviewsOrderQueue[]|Collection findByOrderId(int|array<int> $order_id) Return ChildNetreviewsOrderQueue objects filtered by the order_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsOrderQueue> findByOrderId(int|array<int> $order_id) Return ChildNetreviewsOrderQueue objects filtered by the order_id column
 * @method     ChildNetreviewsOrderQueue[]|Collection findByTreatedAt(string|array<string> $treated_at) Return ChildNetreviewsOrderQueue objects filtered by the treated_at column
 * @psalm-method Collection&\Traversable<ChildNetreviewsOrderQueue> findByTreatedAt(string|array<string> $treated_at) Return ChildNetreviewsOrderQueue objects filtered by the treated_at column
 * @method     ChildNetreviewsOrderQueue[]|Collection findByStatus(string|array<string> $status) Return ChildNetreviewsOrderQueue objects filtered by the status column
 * @psalm-method Collection&\Traversable<ChildNetreviewsOrderQueue> findByStatus(string|array<string> $status) Return ChildNetreviewsOrderQueue objects filtered by the status column
 *
 * @method     ChildNetreviewsOrderQueue[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNetreviewsOrderQueue> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NetreviewsOrderQueueQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsOrderQueueQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'TheliaMain', $modelName = '\\NetReviews\\Model\\NetreviewsOrderQueue', ?string $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsOrderQueueQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsOrderQueueQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNetreviewsOrderQueueQuery) {
            return $criteria;
        }
        $query = new ChildNetreviewsOrderQueueQuery();
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
     * @return ChildNetreviewsOrderQueue|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsOrderQueueTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NetreviewsOrderQueueTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildNetreviewsOrderQueue A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `order_id`, `treated_at`, `status` FROM `netreviews_order_queue` WHERE `id` = :p0';
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
            /** @var ChildNetreviewsOrderQueue $obj */
            $obj = new ChildNetreviewsOrderQueue();
            $obj->hydrate($row);
            NetreviewsOrderQueueTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildNetreviewsOrderQueue|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
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
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
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
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderId(1234); // WHERE order_id = 1234
     * $query->filterByOrderId(array(12, 34)); // WHERE order_id IN (12, 34)
     * $query->filterByOrderId(array('min' => 12)); // WHERE order_id > 12
     * </code>
     *
     * @param mixed $orderId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderId($orderId = null, ?string $comparison = null)
    {
        if (is_array($orderId)) {
            $useMinMax = false;
            if (isset($orderId['min'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ORDER_ID, $orderId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderId['max'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ORDER_ID, $orderId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ORDER_ID, $orderId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the treated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByTreatedAt('2011-03-14'); // WHERE treated_at = '2011-03-14'
     * $query->filterByTreatedAt('now'); // WHERE treated_at = '2011-03-14'
     * $query->filterByTreatedAt(array('max' => 'yesterday')); // WHERE treated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $treatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByTreatedAt($treatedAt = null, ?string $comparison = null)
    {
        if (is_array($treatedAt)) {
            $useMinMax = false;
            if (isset($treatedAt['min'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_TREATED_AT, $treatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($treatedAt['max'])) {
                $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_TREATED_AT, $treatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_TREATED_AT, $treatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%', Criteria::LIKE); // WHERE status LIKE '%fooValue%'
     * $query->filterByStatus(['foo', 'bar']); // WHERE status IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $status The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStatus($status = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_STATUS, $status, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNetreviewsOrderQueue $netreviewsOrderQueue Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($netreviewsOrderQueue = null)
    {
        if ($netreviewsOrderQueue) {
            $this->addUsingAlias(NetreviewsOrderQueueTableMap::COL_ID, $netreviewsOrderQueue->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_order_queue table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsOrderQueueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NetreviewsOrderQueueTableMap::clearInstancePool();
            NetreviewsOrderQueueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsOrderQueueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsOrderQueueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NetreviewsOrderQueueTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsOrderQueueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
