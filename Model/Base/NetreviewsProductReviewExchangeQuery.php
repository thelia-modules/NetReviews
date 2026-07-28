<?php

namespace NetReviews\Model\Base;

use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsProductReviewExchange as ChildNetreviewsProductReviewExchange;
use NetReviews\Model\NetreviewsProductReviewExchangeQuery as ChildNetreviewsProductReviewExchangeQuery;
use NetReviews\Model\Map\NetreviewsProductReviewExchangeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `netreviews_product_review_exchange` table.
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNetreviewsProductReviewExchangeQuery orderByProductReviewId($order = Criteria::ASC) Order by the product_review_id column
 * @method     ChildNetreviewsProductReviewExchangeQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method     ChildNetreviewsProductReviewExchangeQuery orderByWho($order = Criteria::ASC) Order by the who column
 * @method     ChildNetreviewsProductReviewExchangeQuery orderByMessage($order = Criteria::ASC) Order by the message column
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery groupById() Group by the id column
 * @method     ChildNetreviewsProductReviewExchangeQuery groupByProductReviewId() Group by the product_review_id column
 * @method     ChildNetreviewsProductReviewExchangeQuery groupByDate() Group by the date column
 * @method     ChildNetreviewsProductReviewExchangeQuery groupByWho() Group by the who column
 * @method     ChildNetreviewsProductReviewExchangeQuery groupByMessage() Group by the message column
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNetreviewsProductReviewExchangeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNetreviewsProductReviewExchangeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNetreviewsProductReviewExchangeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNetreviewsProductReviewExchangeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery leftJoinNetreviewsProductReview($relationAlias = null) Adds a LEFT JOIN clause to the query using the NetreviewsProductReview relation
 * @method     ChildNetreviewsProductReviewExchangeQuery rightJoinNetreviewsProductReview($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NetreviewsProductReview relation
 * @method     ChildNetreviewsProductReviewExchangeQuery innerJoinNetreviewsProductReview($relationAlias = null) Adds a INNER JOIN clause to the query using the NetreviewsProductReview relation
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery joinWithNetreviewsProductReview($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the NetreviewsProductReview relation
 *
 * @method     ChildNetreviewsProductReviewExchangeQuery leftJoinWithNetreviewsProductReview() Adds a LEFT JOIN clause and with to the query using the NetreviewsProductReview relation
 * @method     ChildNetreviewsProductReviewExchangeQuery rightJoinWithNetreviewsProductReview() Adds a RIGHT JOIN clause and with to the query using the NetreviewsProductReview relation
 * @method     ChildNetreviewsProductReviewExchangeQuery innerJoinWithNetreviewsProductReview() Adds a INNER JOIN clause and with to the query using the NetreviewsProductReview relation
 *
 * @method     \NetReviews\Model\NetreviewsProductReviewQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNetreviewsProductReviewExchange|null findOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReviewExchange matching the query
 * @method     ChildNetreviewsProductReviewExchange findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReviewExchange matching the query, or a new ChildNetreviewsProductReviewExchange object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsProductReviewExchange|null findOneById(int $id) Return the first ChildNetreviewsProductReviewExchange filtered by the id column
 * @method     ChildNetreviewsProductReviewExchange|null findOneByProductReviewId(string $product_review_id) Return the first ChildNetreviewsProductReviewExchange filtered by the product_review_id column
 * @method     ChildNetreviewsProductReviewExchange|null findOneByDate(string $date) Return the first ChildNetreviewsProductReviewExchange filtered by the date column
 * @method     ChildNetreviewsProductReviewExchange|null findOneByWho(string $who) Return the first ChildNetreviewsProductReviewExchange filtered by the who column
 * @method     ChildNetreviewsProductReviewExchange|null findOneByMessage(string $message) Return the first ChildNetreviewsProductReviewExchange filtered by the message column
 *
 * @method     ChildNetreviewsProductReviewExchange requirePk($key, ?ConnectionInterface $con = null) Return the ChildNetreviewsProductReviewExchange by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReviewExchange requireOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReviewExchange matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsProductReviewExchange requireOneById(int $id) Return the first ChildNetreviewsProductReviewExchange filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReviewExchange requireOneByProductReviewId(string $product_review_id) Return the first ChildNetreviewsProductReviewExchange filtered by the product_review_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReviewExchange requireOneByDate(string $date) Return the first ChildNetreviewsProductReviewExchange filtered by the date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReviewExchange requireOneByWho(string $who) Return the first ChildNetreviewsProductReviewExchange filtered by the who column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReviewExchange requireOneByMessage(string $message) Return the first ChildNetreviewsProductReviewExchange filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsProductReviewExchange[]|Collection find(?ConnectionInterface $con = null) Return ChildNetreviewsProductReviewExchange objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> find(?ConnectionInterface $con = null) Return ChildNetreviewsProductReviewExchange objects based on current ModelCriteria
 *
 * @method     ChildNetreviewsProductReviewExchange[]|Collection findById(int|array<int> $id) Return ChildNetreviewsProductReviewExchange objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> findById(int|array<int> $id) Return ChildNetreviewsProductReviewExchange objects filtered by the id column
 * @method     ChildNetreviewsProductReviewExchange[]|Collection findByProductReviewId(string|array<string> $product_review_id) Return ChildNetreviewsProductReviewExchange objects filtered by the product_review_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> findByProductReviewId(string|array<string> $product_review_id) Return ChildNetreviewsProductReviewExchange objects filtered by the product_review_id column
 * @method     ChildNetreviewsProductReviewExchange[]|Collection findByDate(string|array<string> $date) Return ChildNetreviewsProductReviewExchange objects filtered by the date column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> findByDate(string|array<string> $date) Return ChildNetreviewsProductReviewExchange objects filtered by the date column
 * @method     ChildNetreviewsProductReviewExchange[]|Collection findByWho(string|array<string> $who) Return ChildNetreviewsProductReviewExchange objects filtered by the who column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> findByWho(string|array<string> $who) Return ChildNetreviewsProductReviewExchange objects filtered by the who column
 * @method     ChildNetreviewsProductReviewExchange[]|Collection findByMessage(string|array<string> $message) Return ChildNetreviewsProductReviewExchange objects filtered by the message column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReviewExchange> findByMessage(string|array<string> $message) Return ChildNetreviewsProductReviewExchange objects filtered by the message column
 *
 * @method     ChildNetreviewsProductReviewExchange[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNetreviewsProductReviewExchange> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NetreviewsProductReviewExchangeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsProductReviewExchangeQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'TheliaMain', $modelName = '\\NetReviews\\Model\\NetreviewsProductReviewExchange', ?string $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsProductReviewExchangeQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsProductReviewExchangeQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNetreviewsProductReviewExchangeQuery) {
            return $criteria;
        }
        $query = new ChildNetreviewsProductReviewExchangeQuery();
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
     * @return ChildNetreviewsProductReviewExchange|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NetreviewsProductReviewExchangeTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNetreviewsProductReviewExchange A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id`, `product_review_id`, `date`, `who`, `message` FROM `netreviews_product_review_exchange` WHERE `id` = :p0';
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
            /** @var ChildNetreviewsProductReviewExchange $obj */
            $obj = new ChildNetreviewsProductReviewExchange();
            $obj->hydrate($row);
            NetreviewsProductReviewExchangeTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNetreviewsProductReviewExchange|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $keys, Criteria::IN);

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
                $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_review_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductReviewId('fooValue');   // WHERE product_review_id = 'fooValue'
     * $query->filterByProductReviewId('%fooValue%', Criteria::LIKE); // WHERE product_review_id LIKE '%fooValue%'
     * $query->filterByProductReviewId(['foo', 'bar']); // WHERE product_review_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productReviewId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductReviewId($productReviewId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productReviewId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID, $productReviewId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDate($date = null, ?string $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_DATE, $date, $comparison);

        return $this;
    }

    /**
     * Filter the query on the who column
     *
     * Example usage:
     * <code>
     * $query->filterByWho('fooValue');   // WHERE who = 'fooValue'
     * $query->filterByWho('%fooValue%', Criteria::LIKE); // WHERE who LIKE '%fooValue%'
     * $query->filterByWho(['foo', 'bar']); // WHERE who IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $who The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByWho($who = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($who)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_WHO, $who, $comparison);

        return $this;
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%', Criteria::LIKE); // WHERE message LIKE '%fooValue%'
     * $query->filterByMessage(['foo', 'bar']); // WHERE message IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $message The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMessage($message = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_MESSAGE, $message, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \NetReviews\Model\NetreviewsProductReview object
     *
     * @param \NetReviews\Model\NetreviewsProductReview|ObjectCollection $netreviewsProductReview The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetreviewsProductReview($netreviewsProductReview, ?string $comparison = null)
    {
        if ($netreviewsProductReview instanceof \NetReviews\Model\NetreviewsProductReview) {
            return $this
                ->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID, $netreviewsProductReview->getProductReviewId(), $comparison);
        } elseif ($netreviewsProductReview instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_PRODUCT_REVIEW_ID, $netreviewsProductReview->toKeyValue('PrimaryKey', 'ProductReviewId'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByNetreviewsProductReview() only accepts arguments of type \NetReviews\Model\NetreviewsProductReview or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NetreviewsProductReview relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNetreviewsProductReview(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NetreviewsProductReview');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NetreviewsProductReview');
        }

        return $this;
    }

    /**
     * Use the NetreviewsProductReview relation NetreviewsProductReview object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NetReviews\Model\NetreviewsProductReviewQuery A secondary query class using the current class as primary query
     */
    public function useNetreviewsProductReviewQuery(?string $relationAlias = null, string $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNetreviewsProductReview($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NetreviewsProductReview', '\NetReviews\Model\NetreviewsProductReviewQuery');
    }

    /**
     * Use the NetreviewsProductReview relation NetreviewsProductReview object
     *
     * @param callable(\NetReviews\Model\NetreviewsProductReviewQuery):\NetReviews\Model\NetreviewsProductReviewQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNetreviewsProductReviewQuery(
        callable $callable,
        ?string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNetreviewsProductReviewQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to NetreviewsProductReview table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \NetReviews\Model\NetreviewsProductReviewQuery The inner query object of the EXISTS statement
     */
    public function useNetreviewsProductReviewExistsQuery(?string $modelAlias = null, ?string $queryClass = null, string $typeOfExists = 'EXISTS')
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewQuery */
        $q = $this->useExistsQuery('NetreviewsProductReview', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReview table for a NOT EXISTS query.
     *
     * @see useNetreviewsProductReviewExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \NetReviews\Model\NetreviewsProductReviewQuery The inner query object of the NOT EXISTS statement
     */
    public function useNetreviewsProductReviewNotExistsQuery(?string $modelAlias = null, ?string $queryClass = null)
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewQuery */
        $q = $this->useExistsQuery('NetreviewsProductReview', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReview table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \NetReviews\Model\NetreviewsProductReviewQuery The inner query object of the IN statement
     */
    public function useInNetreviewsProductReviewQuery(?string $modelAlias = null, ?string $queryClass = null, string $typeOfIn = 'IN')
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewQuery */
        $q = $this->useInQuery('NetreviewsProductReview', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReview table for a NOT IN query.
     *
     * @see useNetreviewsProductReviewInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \NetReviews\Model\NetreviewsProductReviewQuery The inner query object of the NOT IN statement
     */
    public function useNotInNetreviewsProductReviewQuery(?string $modelAlias = null, ?string $queryClass = null)
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewQuery */
        $q = $this->useInQuery('NetreviewsProductReview', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNetreviewsProductReviewExchange $netreviewsProductReviewExchange Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($netreviewsProductReviewExchange = null)
    {
        if ($netreviewsProductReviewExchange) {
            $this->addUsingAlias(NetreviewsProductReviewExchangeTableMap::COL_ID, $netreviewsProductReviewExchange->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_product_review_exchange table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NetreviewsProductReviewExchangeTableMap::clearInstancePool();
            NetreviewsProductReviewExchangeTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsProductReviewExchangeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NetreviewsProductReviewExchangeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsProductReviewExchangeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
