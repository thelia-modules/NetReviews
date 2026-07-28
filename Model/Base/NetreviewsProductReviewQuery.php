<?php

namespace NetReviews\Model\Base;

use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsProductReview as ChildNetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewQuery as ChildNetreviewsProductReviewQuery;
use NetReviews\Model\Map\NetreviewsProductReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `netreviews_product_review` table.
 *
 * @method     ChildNetreviewsProductReviewQuery orderByProductReviewId($order = Criteria::ASC) Order by the product_review_id column
 * @method     ChildNetreviewsProductReviewQuery orderByReviewId($order = Criteria::ASC) Order by the review_id column
 * @method     ChildNetreviewsProductReviewQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildNetreviewsProductReviewQuery orderByLastname($order = Criteria::ASC) Order by the lastname column
 * @method     ChildNetreviewsProductReviewQuery orderByFirstname($order = Criteria::ASC) Order by the firstname column
 * @method     ChildNetreviewsProductReviewQuery orderByReviewDate($order = Criteria::ASC) Order by the review_date column
 * @method     ChildNetreviewsProductReviewQuery orderByMessage($order = Criteria::ASC) Order by the message column
 * @method     ChildNetreviewsProductReviewQuery orderByRate($order = Criteria::ASC) Order by the rate column
 * @method     ChildNetreviewsProductReviewQuery orderByOrderRef($order = Criteria::ASC) Order by the order_ref column
 * @method     ChildNetreviewsProductReviewQuery orderByProductRef($order = Criteria::ASC) Order by the product_ref column
 * @method     ChildNetreviewsProductReviewQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ChildNetreviewsProductReviewQuery orderByExchange($order = Criteria::ASC) Order by the exchange column
 * @method     ChildNetreviewsProductReviewQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildNetreviewsProductReviewQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildNetreviewsProductReviewQuery groupByProductReviewId() Group by the product_review_id column
 * @method     ChildNetreviewsProductReviewQuery groupByReviewId() Group by the review_id column
 * @method     ChildNetreviewsProductReviewQuery groupByEmail() Group by the email column
 * @method     ChildNetreviewsProductReviewQuery groupByLastname() Group by the lastname column
 * @method     ChildNetreviewsProductReviewQuery groupByFirstname() Group by the firstname column
 * @method     ChildNetreviewsProductReviewQuery groupByReviewDate() Group by the review_date column
 * @method     ChildNetreviewsProductReviewQuery groupByMessage() Group by the message column
 * @method     ChildNetreviewsProductReviewQuery groupByRate() Group by the rate column
 * @method     ChildNetreviewsProductReviewQuery groupByOrderRef() Group by the order_ref column
 * @method     ChildNetreviewsProductReviewQuery groupByProductRef() Group by the product_ref column
 * @method     ChildNetreviewsProductReviewQuery groupByProductId() Group by the product_id column
 * @method     ChildNetreviewsProductReviewQuery groupByExchange() Group by the exchange column
 * @method     ChildNetreviewsProductReviewQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildNetreviewsProductReviewQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildNetreviewsProductReviewQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNetreviewsProductReviewQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNetreviewsProductReviewQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNetreviewsProductReviewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNetreviewsProductReviewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNetreviewsProductReviewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNetreviewsProductReviewQuery leftJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a LEFT JOIN clause to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery rightJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery innerJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a INNER JOIN clause to the query using the NetreviewsProductReviewExchange relation
 *
 * @method     ChildNetreviewsProductReviewQuery joinWithNetreviewsProductReviewExchange($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the NetreviewsProductReviewExchange relation
 *
 * @method     ChildNetreviewsProductReviewQuery leftJoinWithNetreviewsProductReviewExchange() Adds a LEFT JOIN clause and with to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery rightJoinWithNetreviewsProductReviewExchange() Adds a RIGHT JOIN clause and with to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery innerJoinWithNetreviewsProductReviewExchange() Adds a INNER JOIN clause and with to the query using the NetreviewsProductReviewExchange relation
 *
 * @method     \NetReviews\Model\NetreviewsProductReviewExchangeQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildNetreviewsProductReview|null findOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReview matching the query
 * @method     ChildNetreviewsProductReview findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReview matching the query, or a new ChildNetreviewsProductReview object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsProductReview|null findOneByProductReviewId(string $product_review_id) Return the first ChildNetreviewsProductReview filtered by the product_review_id column
 * @method     ChildNetreviewsProductReview|null findOneByReviewId(string $review_id) Return the first ChildNetreviewsProductReview filtered by the review_id column
 * @method     ChildNetreviewsProductReview|null findOneByEmail(string $email) Return the first ChildNetreviewsProductReview filtered by the email column
 * @method     ChildNetreviewsProductReview|null findOneByLastname(string $lastname) Return the first ChildNetreviewsProductReview filtered by the lastname column
 * @method     ChildNetreviewsProductReview|null findOneByFirstname(string $firstname) Return the first ChildNetreviewsProductReview filtered by the firstname column
 * @method     ChildNetreviewsProductReview|null findOneByReviewDate(string $review_date) Return the first ChildNetreviewsProductReview filtered by the review_date column
 * @method     ChildNetreviewsProductReview|null findOneByMessage(string $message) Return the first ChildNetreviewsProductReview filtered by the message column
 * @method     ChildNetreviewsProductReview|null findOneByRate(string $rate) Return the first ChildNetreviewsProductReview filtered by the rate column
 * @method     ChildNetreviewsProductReview|null findOneByOrderRef(string $order_ref) Return the first ChildNetreviewsProductReview filtered by the order_ref column
 * @method     ChildNetreviewsProductReview|null findOneByProductRef(string $product_ref) Return the first ChildNetreviewsProductReview filtered by the product_ref column
 * @method     ChildNetreviewsProductReview|null findOneByProductId(int $product_id) Return the first ChildNetreviewsProductReview filtered by the product_id column
 * @method     ChildNetreviewsProductReview|null findOneByExchange(int $exchange) Return the first ChildNetreviewsProductReview filtered by the exchange column
 * @method     ChildNetreviewsProductReview|null findOneByCreatedAt(string $created_at) Return the first ChildNetreviewsProductReview filtered by the created_at column
 * @method     ChildNetreviewsProductReview|null findOneByUpdatedAt(string $updated_at) Return the first ChildNetreviewsProductReview filtered by the updated_at column
 *
 * @method     ChildNetreviewsProductReview requirePk($key, ?ConnectionInterface $con = null) Return the ChildNetreviewsProductReview by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsProductReview matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsProductReview requireOneByProductReviewId(string $product_review_id) Return the first ChildNetreviewsProductReview filtered by the product_review_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByReviewId(string $review_id) Return the first ChildNetreviewsProductReview filtered by the review_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByEmail(string $email) Return the first ChildNetreviewsProductReview filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByLastname(string $lastname) Return the first ChildNetreviewsProductReview filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByFirstname(string $firstname) Return the first ChildNetreviewsProductReview filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByReviewDate(string $review_date) Return the first ChildNetreviewsProductReview filtered by the review_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByMessage(string $message) Return the first ChildNetreviewsProductReview filtered by the message column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByRate(string $rate) Return the first ChildNetreviewsProductReview filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByOrderRef(string $order_ref) Return the first ChildNetreviewsProductReview filtered by the order_ref column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByProductRef(string $product_ref) Return the first ChildNetreviewsProductReview filtered by the product_ref column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByProductId(int $product_id) Return the first ChildNetreviewsProductReview filtered by the product_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByExchange(int $exchange) Return the first ChildNetreviewsProductReview filtered by the exchange column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByCreatedAt(string $created_at) Return the first ChildNetreviewsProductReview filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsProductReview requireOneByUpdatedAt(string $updated_at) Return the first ChildNetreviewsProductReview filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsProductReview[]|Collection find(?ConnectionInterface $con = null) Return ChildNetreviewsProductReview objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> find(?ConnectionInterface $con = null) Return ChildNetreviewsProductReview objects based on current ModelCriteria
 *
 * @method     ChildNetreviewsProductReview[]|Collection findByProductReviewId(string|array<string> $product_review_id) Return ChildNetreviewsProductReview objects filtered by the product_review_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByProductReviewId(string|array<string> $product_review_id) Return ChildNetreviewsProductReview objects filtered by the product_review_id column
 * @method     ChildNetreviewsProductReview[]|Collection findByReviewId(string|array<string> $review_id) Return ChildNetreviewsProductReview objects filtered by the review_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByReviewId(string|array<string> $review_id) Return ChildNetreviewsProductReview objects filtered by the review_id column
 * @method     ChildNetreviewsProductReview[]|Collection findByEmail(string|array<string> $email) Return ChildNetreviewsProductReview objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByEmail(string|array<string> $email) Return ChildNetreviewsProductReview objects filtered by the email column
 * @method     ChildNetreviewsProductReview[]|Collection findByLastname(string|array<string> $lastname) Return ChildNetreviewsProductReview objects filtered by the lastname column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByLastname(string|array<string> $lastname) Return ChildNetreviewsProductReview objects filtered by the lastname column
 * @method     ChildNetreviewsProductReview[]|Collection findByFirstname(string|array<string> $firstname) Return ChildNetreviewsProductReview objects filtered by the firstname column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByFirstname(string|array<string> $firstname) Return ChildNetreviewsProductReview objects filtered by the firstname column
 * @method     ChildNetreviewsProductReview[]|Collection findByReviewDate(string|array<string> $review_date) Return ChildNetreviewsProductReview objects filtered by the review_date column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByReviewDate(string|array<string> $review_date) Return ChildNetreviewsProductReview objects filtered by the review_date column
 * @method     ChildNetreviewsProductReview[]|Collection findByMessage(string|array<string> $message) Return ChildNetreviewsProductReview objects filtered by the message column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByMessage(string|array<string> $message) Return ChildNetreviewsProductReview objects filtered by the message column
 * @method     ChildNetreviewsProductReview[]|Collection findByRate(string|array<string> $rate) Return ChildNetreviewsProductReview objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByRate(string|array<string> $rate) Return ChildNetreviewsProductReview objects filtered by the rate column
 * @method     ChildNetreviewsProductReview[]|Collection findByOrderRef(string|array<string> $order_ref) Return ChildNetreviewsProductReview objects filtered by the order_ref column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByOrderRef(string|array<string> $order_ref) Return ChildNetreviewsProductReview objects filtered by the order_ref column
 * @method     ChildNetreviewsProductReview[]|Collection findByProductRef(string|array<string> $product_ref) Return ChildNetreviewsProductReview objects filtered by the product_ref column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByProductRef(string|array<string> $product_ref) Return ChildNetreviewsProductReview objects filtered by the product_ref column
 * @method     ChildNetreviewsProductReview[]|Collection findByProductId(int|array<int> $product_id) Return ChildNetreviewsProductReview objects filtered by the product_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByProductId(int|array<int> $product_id) Return ChildNetreviewsProductReview objects filtered by the product_id column
 * @method     ChildNetreviewsProductReview[]|Collection findByExchange(int|array<int> $exchange) Return ChildNetreviewsProductReview objects filtered by the exchange column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByExchange(int|array<int> $exchange) Return ChildNetreviewsProductReview objects filtered by the exchange column
 * @method     ChildNetreviewsProductReview[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildNetreviewsProductReview objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByCreatedAt(string|array<string> $created_at) Return ChildNetreviewsProductReview objects filtered by the created_at column
 * @method     ChildNetreviewsProductReview[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildNetreviewsProductReview objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildNetreviewsProductReview> findByUpdatedAt(string|array<string> $updated_at) Return ChildNetreviewsProductReview objects filtered by the updated_at column
 *
 * @method     ChildNetreviewsProductReview[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNetreviewsProductReview> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NetreviewsProductReviewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsProductReviewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'TheliaMain', $modelName = '\\NetReviews\\Model\\NetreviewsProductReview', ?string $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsProductReviewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsProductReviewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNetreviewsProductReviewQuery) {
            return $criteria;
        }
        $query = new ChildNetreviewsProductReviewQuery();
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
     * @return ChildNetreviewsProductReview|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNetreviewsProductReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `product_review_id`, `review_id`, `email`, `lastname`, `firstname`, `review_date`, `message`, `rate`, `order_ref`, `product_ref`, `product_id`, `exchange`, `created_at`, `updated_at` FROM `netreviews_product_review` WHERE `product_review_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildNetreviewsProductReview $obj */
            $obj = new ChildNetreviewsProductReview();
            $obj->hydrate($row);
            NetreviewsProductReviewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNetreviewsProductReview|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $keys, Criteria::IN);

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

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $productReviewId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the review_id column
     *
     * Example usage:
     * <code>
     * $query->filterByReviewId('fooValue');   // WHERE review_id = 'fooValue'
     * $query->filterByReviewId('%fooValue%', Criteria::LIKE); // WHERE review_id LIKE '%fooValue%'
     * $query->filterByReviewId(['foo', 'bar']); // WHERE review_id IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $reviewId The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReviewId($reviewId = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reviewId)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_REVIEW_ID, $reviewId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail(['foo', 'bar']); // WHERE email IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $email The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail($email = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_EMAIL, $email, $comparison);

        return $this;
    }

    /**
     * Filter the query on the lastname column
     *
     * Example usage:
     * <code>
     * $query->filterByLastname('fooValue');   // WHERE lastname = 'fooValue'
     * $query->filterByLastname('%fooValue%', Criteria::LIKE); // WHERE lastname LIKE '%fooValue%'
     * $query->filterByLastname(['foo', 'bar']); // WHERE lastname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $lastname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastname($lastname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lastname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_LASTNAME, $lastname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the firstname column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstname('fooValue');   // WHERE firstname = 'fooValue'
     * $query->filterByFirstname('%fooValue%', Criteria::LIKE); // WHERE firstname LIKE '%fooValue%'
     * $query->filterByFirstname(['foo', 'bar']); // WHERE firstname IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $firstname The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstname($firstname = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($firstname)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_FIRSTNAME, $firstname, $comparison);

        return $this;
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
     * @param mixed $reviewDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReviewDate($reviewDate = null, ?string $comparison = null)
    {
        if (is_array($reviewDate)) {
            $useMinMax = false;
            if (isset($reviewDate['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_REVIEW_DATE, $reviewDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reviewDate['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_REVIEW_DATE, $reviewDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_REVIEW_DATE, $reviewDate, $comparison);

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

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_MESSAGE, $message, $comparison);

        return $this;
    }

    /**
     * Filter the query on the rate column
     *
     * Example usage:
     * <code>
     * $query->filterByRate('fooValue');   // WHERE rate = 'fooValue'
     * $query->filterByRate('%fooValue%', Criteria::LIKE); // WHERE rate LIKE '%fooValue%'
     * $query->filterByRate(['foo', 'bar']); // WHERE rate IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $rate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRate($rate = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rate)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_RATE, $rate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the order_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderRef('fooValue');   // WHERE order_ref = 'fooValue'
     * $query->filterByOrderRef('%fooValue%', Criteria::LIKE); // WHERE order_ref LIKE '%fooValue%'
     * $query->filterByOrderRef(['foo', 'bar']); // WHERE order_ref IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $orderRef The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderRef($orderRef = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($orderRef)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_ORDER_REF, $orderRef, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByProductRef('fooValue');   // WHERE product_ref = 'fooValue'
     * $query->filterByProductRef('%fooValue%', Criteria::LIKE); // WHERE product_ref LIKE '%fooValue%'
     * $query->filterByProductRef(['foo', 'bar']); // WHERE product_ref IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $productRef The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductRef($productRef = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productRef)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REF, $productRef, $comparison);

        return $this;
    }

    /**
     * Filter the query on the product_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductId(1234); // WHERE product_id = 1234
     * $query->filterByProductId(array(12, 34)); // WHERE product_id IN (12, 34)
     * $query->filterByProductId(array('min' => 12)); // WHERE product_id > 12
     * </code>
     *
     * @param mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductId($productId = null, ?string $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_ID, $productId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the exchange column
     *
     * Example usage:
     * <code>
     * $query->filterByExchange(1234); // WHERE exchange = 1234
     * $query->filterByExchange(array(12, 34)); // WHERE exchange IN (12, 34)
     * $query->filterByExchange(array('min' => 12)); // WHERE exchange > 12
     * </code>
     *
     * @param mixed $exchange The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByExchange($exchange = null, ?string $comparison = null)
    {
        if (is_array($exchange)) {
            $useMinMax = false;
            if (isset($exchange['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_EXCHANGE, $exchange['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exchange['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_EXCHANGE, $exchange['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_EXCHANGE, $exchange, $comparison);

        return $this;
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, ?string $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_CREATED_AT, $createdAt, $comparison);

        return $this;
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, ?string $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \NetReviews\Model\NetreviewsProductReviewExchange object
     *
     * @param \NetReviews\Model\NetreviewsProductReviewExchange|ObjectCollection $netreviewsProductReviewExchange the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNetreviewsProductReviewExchange($netreviewsProductReviewExchange, ?string $comparison = null)
    {
        if ($netreviewsProductReviewExchange instanceof \NetReviews\Model\NetreviewsProductReviewExchange) {
            $this
                ->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $netreviewsProductReviewExchange->getProductReviewId(), $comparison);

            return $this;
        } elseif ($netreviewsProductReviewExchange instanceof ObjectCollection) {
            $this
                ->useNetreviewsProductReviewExchangeQuery()
                ->filterByPrimaryKeys($netreviewsProductReviewExchange->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByNetreviewsProductReviewExchange() only accepts arguments of type \NetReviews\Model\NetreviewsProductReviewExchange or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NetreviewsProductReviewExchange relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNetreviewsProductReviewExchange(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NetreviewsProductReviewExchange');

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
            $this->addJoinObject($join, 'NetreviewsProductReviewExchange');
        }

        return $this;
    }

    /**
     * Use the NetreviewsProductReviewExchange relation NetreviewsProductReviewExchange object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \NetReviews\Model\NetreviewsProductReviewExchangeQuery A secondary query class using the current class as primary query
     */
    public function useNetreviewsProductReviewExchangeQuery(?string $relationAlias = null, string $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNetreviewsProductReviewExchange($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NetreviewsProductReviewExchange', '\NetReviews\Model\NetreviewsProductReviewExchangeQuery');
    }

    /**
     * Use the NetreviewsProductReviewExchange relation NetreviewsProductReviewExchange object
     *
     * @param callable(\NetReviews\Model\NetreviewsProductReviewExchangeQuery):\NetReviews\Model\NetreviewsProductReviewExchangeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNetreviewsProductReviewExchangeQuery(
        callable $callable,
        ?string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNetreviewsProductReviewExchangeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to NetreviewsProductReviewExchange table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \NetReviews\Model\NetreviewsProductReviewExchangeQuery The inner query object of the EXISTS statement
     */
    public function useNetreviewsProductReviewExchangeExistsQuery(?string $modelAlias = null, ?string $queryClass = null, string $typeOfExists = 'EXISTS')
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewExchangeQuery */
        $q = $this->useExistsQuery('NetreviewsProductReviewExchange', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReviewExchange table for a NOT EXISTS query.
     *
     * @see useNetreviewsProductReviewExchangeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \NetReviews\Model\NetreviewsProductReviewExchangeQuery The inner query object of the NOT EXISTS statement
     */
    public function useNetreviewsProductReviewExchangeNotExistsQuery(?string $modelAlias = null, ?string $queryClass = null)
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewExchangeQuery */
        $q = $this->useExistsQuery('NetreviewsProductReviewExchange', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReviewExchange table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \NetReviews\Model\NetreviewsProductReviewExchangeQuery The inner query object of the IN statement
     */
    public function useInNetreviewsProductReviewExchangeQuery(?string $modelAlias = null, ?string $queryClass = null, string $typeOfIn = 'IN')
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewExchangeQuery */
        $q = $this->useInQuery('NetreviewsProductReviewExchange', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to NetreviewsProductReviewExchange table for a NOT IN query.
     *
     * @see useNetreviewsProductReviewExchangeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \NetReviews\Model\NetreviewsProductReviewExchangeQuery The inner query object of the NOT IN statement
     */
    public function useNotInNetreviewsProductReviewExchangeQuery(?string $modelAlias = null, ?string $queryClass = null)
    {
        /** @var $q \NetReviews\Model\NetreviewsProductReviewExchangeQuery */
        $q = $this->useInQuery('NetreviewsProductReviewExchange', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNetreviewsProductReview $netreviewsProductReview Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($netreviewsProductReview = null)
    {
        if ($netreviewsProductReview) {
            $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $netreviewsProductReview->getProductReviewId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_product_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NetreviewsProductReviewTableMap::clearInstancePool();
            NetreviewsProductReviewTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsProductReviewTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NetreviewsProductReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsProductReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param int $nbDays Maximum age of the latest update in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(NetreviewsProductReviewTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(NetreviewsProductReviewTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(NetreviewsProductReviewTableMap::COL_CREATED_AT);

        return $this;
    }

    /**
     * Filter by the latest created
     *
     * @param int $nbDays Maximum age of in days
     *
     * @return $this The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        $this->addUsingAlias(NetreviewsProductReviewTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(NetreviewsProductReviewTableMap::COL_CREATED_AT);

        return $this;
    }

}
