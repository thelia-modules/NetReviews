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
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `netreviews_site_review` table.
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
 * @method     ChildNetreviewsSiteReviewQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNetreviewsSiteReviewQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNetreviewsSiteReviewQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNetreviewsSiteReview|null findOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsSiteReview matching the query
 * @method     ChildNetreviewsSiteReview findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildNetreviewsSiteReview matching the query, or a new ChildNetreviewsSiteReview object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsSiteReview|null findOneBySiteReviewId(int $site_review_id) Return the first ChildNetreviewsSiteReview filtered by the site_review_id column
 * @method     ChildNetreviewsSiteReview|null findOneByReviewId(string $review_id) Return the first ChildNetreviewsSiteReview filtered by the review_id column
 * @method     ChildNetreviewsSiteReview|null findOneByLastname(string $lastname) Return the first ChildNetreviewsSiteReview filtered by the lastname column
 * @method     ChildNetreviewsSiteReview|null findOneByFirstname(string $firstname) Return the first ChildNetreviewsSiteReview filtered by the firstname column
 * @method     ChildNetreviewsSiteReview|null findOneByReview(string $review) Return the first ChildNetreviewsSiteReview filtered by the review column
 * @method     ChildNetreviewsSiteReview|null findOneByReviewDate(string $review_date) Return the first ChildNetreviewsSiteReview filtered by the review_date column
 * @method     ChildNetreviewsSiteReview|null findOneByRate(string $rate) Return the first ChildNetreviewsSiteReview filtered by the rate column
 * @method     ChildNetreviewsSiteReview|null findOneByOrderRef(string $order_ref) Return the first ChildNetreviewsSiteReview filtered by the order_ref column
 * @method     ChildNetreviewsSiteReview|null findOneByOrderDate(string $order_date) Return the first ChildNetreviewsSiteReview filtered by the order_date column
 *
 * @method     ChildNetreviewsSiteReview requirePk($key, ?ConnectionInterface $con = null) Return the ChildNetreviewsSiteReview by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOne(?ConnectionInterface $con = null) Return the first ChildNetreviewsSiteReview matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsSiteReview requireOneBySiteReviewId(int $site_review_id) Return the first ChildNetreviewsSiteReview filtered by the site_review_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByReviewId(string $review_id) Return the first ChildNetreviewsSiteReview filtered by the review_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByLastname(string $lastname) Return the first ChildNetreviewsSiteReview filtered by the lastname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByFirstname(string $firstname) Return the first ChildNetreviewsSiteReview filtered by the firstname column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByReview(string $review) Return the first ChildNetreviewsSiteReview filtered by the review column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByReviewDate(string $review_date) Return the first ChildNetreviewsSiteReview filtered by the review_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByRate(string $rate) Return the first ChildNetreviewsSiteReview filtered by the rate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByOrderRef(string $order_ref) Return the first ChildNetreviewsSiteReview filtered by the order_ref column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNetreviewsSiteReview requireOneByOrderDate(string $order_date) Return the first ChildNetreviewsSiteReview filtered by the order_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNetreviewsSiteReview[]|Collection find(?ConnectionInterface $con = null) Return ChildNetreviewsSiteReview objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> find(?ConnectionInterface $con = null) Return ChildNetreviewsSiteReview objects based on current ModelCriteria
 *
 * @method     ChildNetreviewsSiteReview[]|Collection findBySiteReviewId(int|array<int> $site_review_id) Return ChildNetreviewsSiteReview objects filtered by the site_review_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findBySiteReviewId(int|array<int> $site_review_id) Return ChildNetreviewsSiteReview objects filtered by the site_review_id column
 * @method     ChildNetreviewsSiteReview[]|Collection findByReviewId(string|array<string> $review_id) Return ChildNetreviewsSiteReview objects filtered by the review_id column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByReviewId(string|array<string> $review_id) Return ChildNetreviewsSiteReview objects filtered by the review_id column
 * @method     ChildNetreviewsSiteReview[]|Collection findByLastname(string|array<string> $lastname) Return ChildNetreviewsSiteReview objects filtered by the lastname column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByLastname(string|array<string> $lastname) Return ChildNetreviewsSiteReview objects filtered by the lastname column
 * @method     ChildNetreviewsSiteReview[]|Collection findByFirstname(string|array<string> $firstname) Return ChildNetreviewsSiteReview objects filtered by the firstname column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByFirstname(string|array<string> $firstname) Return ChildNetreviewsSiteReview objects filtered by the firstname column
 * @method     ChildNetreviewsSiteReview[]|Collection findByReview(string|array<string> $review) Return ChildNetreviewsSiteReview objects filtered by the review column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByReview(string|array<string> $review) Return ChildNetreviewsSiteReview objects filtered by the review column
 * @method     ChildNetreviewsSiteReview[]|Collection findByReviewDate(string|array<string> $review_date) Return ChildNetreviewsSiteReview objects filtered by the review_date column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByReviewDate(string|array<string> $review_date) Return ChildNetreviewsSiteReview objects filtered by the review_date column
 * @method     ChildNetreviewsSiteReview[]|Collection findByRate(string|array<string> $rate) Return ChildNetreviewsSiteReview objects filtered by the rate column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByRate(string|array<string> $rate) Return ChildNetreviewsSiteReview objects filtered by the rate column
 * @method     ChildNetreviewsSiteReview[]|Collection findByOrderRef(string|array<string> $order_ref) Return ChildNetreviewsSiteReview objects filtered by the order_ref column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByOrderRef(string|array<string> $order_ref) Return ChildNetreviewsSiteReview objects filtered by the order_ref column
 * @method     ChildNetreviewsSiteReview[]|Collection findByOrderDate(string|array<string> $order_date) Return ChildNetreviewsSiteReview objects filtered by the order_date column
 * @psalm-method Collection&\Traversable<ChildNetreviewsSiteReview> findByOrderDate(string|array<string> $order_date) Return ChildNetreviewsSiteReview objects filtered by the order_date column
 *
 * @method     ChildNetreviewsSiteReview[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildNetreviewsSiteReview> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class NetreviewsSiteReviewQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsSiteReviewQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'TheliaMain', $modelName = '\\NetReviews\\Model\\NetreviewsSiteReview', ?string $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsSiteReviewQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsSiteReviewQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildNetreviewsSiteReviewQuery) {
            return $criteria;
        }
        $query = new ChildNetreviewsSiteReviewQuery();
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
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = NetreviewsSiteReviewTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildNetreviewsSiteReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `site_review_id`, `review_id`, `lastname`, `firstname`, `review`, `review_date`, `rate`, `order_ref`, `order_date` FROM `netreviews_site_review` WHERE `site_review_id` = :p0';
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
            /** @var ChildNetreviewsSiteReview $obj */
            $obj = new ChildNetreviewsSiteReview();
            $obj->hydrate($row);
            NetreviewsSiteReviewTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildNetreviewsSiteReview|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $keys, Criteria::IN);

        return $this;
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
     * @param mixed $siteReviewId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySiteReviewId($siteReviewId = null, ?string $comparison = null)
    {
        if (is_array($siteReviewId)) {
            $useMinMax = false;
            if (isset($siteReviewId['min'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $siteReviewId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($siteReviewId['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $siteReviewId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $siteReviewId, $comparison);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_REVIEW_ID, $reviewId, $comparison);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_LASTNAME, $lastname, $comparison);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_FIRSTNAME, $firstname, $comparison);

        return $this;
    }

    /**
     * Filter the query on the review column
     *
     * Example usage:
     * <code>
     * $query->filterByReview('fooValue');   // WHERE review = 'fooValue'
     * $query->filterByReview('%fooValue%', Criteria::LIKE); // WHERE review LIKE '%fooValue%'
     * $query->filterByReview(['foo', 'bar']); // WHERE review IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $review The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByReview($review = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($review)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_REVIEW, $review, $comparison);

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
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_REVIEW_DATE, $reviewDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reviewDate['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_REVIEW_DATE, $reviewDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_REVIEW_DATE, $reviewDate, $comparison);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_RATE, $rate, $comparison);

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

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_ORDER_REF, $orderRef, $comparison);

        return $this;
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
     * @param mixed $orderDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderDate($orderDate = null, ?string $comparison = null)
    {
        if (is_array($orderDate)) {
            $useMinMax = false;
            if (isset($orderDate['min'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_ORDER_DATE, $orderDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orderDate['max'])) {
                $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_ORDER_DATE, $orderDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_ORDER_DATE, $orderDate, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildNetreviewsSiteReview $netreviewsSiteReview Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($netreviewsSiteReview = null)
    {
        if ($netreviewsSiteReview) {
            $this->addUsingAlias(NetreviewsSiteReviewTableMap::COL_SITE_REVIEW_ID, $netreviewsSiteReview->getSiteReviewId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_site_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NetreviewsSiteReviewTableMap::clearInstancePool();
            NetreviewsSiteReviewTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsSiteReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsSiteReviewTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NetreviewsSiteReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsSiteReviewTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
