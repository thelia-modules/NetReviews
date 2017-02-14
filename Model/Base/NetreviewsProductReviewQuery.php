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
 * Base class that represents a query for the 'netreviews_product_review' table.
 *
 *
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
 * @method     ChildNetreviewsProductReviewQuery leftJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a LEFT JOIN clause to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery rightJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NetreviewsProductReviewExchange relation
 * @method     ChildNetreviewsProductReviewQuery innerJoinNetreviewsProductReviewExchange($relationAlias = null) Adds a INNER JOIN clause to the query using the NetreviewsProductReviewExchange relation
 *
 * @method     ChildNetreviewsProductReview findOne(ConnectionInterface $con = null) Return the first ChildNetreviewsProductReview matching the query
 * @method     ChildNetreviewsProductReview findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNetreviewsProductReview matching the query, or a new ChildNetreviewsProductReview object populated from the query conditions when no match is found
 *
 * @method     ChildNetreviewsProductReview findOneByProductReviewId(string $product_review_id) Return the first ChildNetreviewsProductReview filtered by the product_review_id column
 * @method     ChildNetreviewsProductReview findOneByReviewId(string $review_id) Return the first ChildNetreviewsProductReview filtered by the review_id column
 * @method     ChildNetreviewsProductReview findOneByEmail(string $email) Return the first ChildNetreviewsProductReview filtered by the email column
 * @method     ChildNetreviewsProductReview findOneByLastname(string $lastname) Return the first ChildNetreviewsProductReview filtered by the lastname column
 * @method     ChildNetreviewsProductReview findOneByFirstname(string $firstname) Return the first ChildNetreviewsProductReview filtered by the firstname column
 * @method     ChildNetreviewsProductReview findOneByReviewDate(string $review_date) Return the first ChildNetreviewsProductReview filtered by the review_date column
 * @method     ChildNetreviewsProductReview findOneByMessage(string $message) Return the first ChildNetreviewsProductReview filtered by the message column
 * @method     ChildNetreviewsProductReview findOneByRate(string $rate) Return the first ChildNetreviewsProductReview filtered by the rate column
 * @method     ChildNetreviewsProductReview findOneByOrderRef(string $order_ref) Return the first ChildNetreviewsProductReview filtered by the order_ref column
 * @method     ChildNetreviewsProductReview findOneByProductRef(string $product_ref) Return the first ChildNetreviewsProductReview filtered by the product_ref column
 * @method     ChildNetreviewsProductReview findOneByProductId(int $product_id) Return the first ChildNetreviewsProductReview filtered by the product_id column
 * @method     ChildNetreviewsProductReview findOneByExchange(int $exchange) Return the first ChildNetreviewsProductReview filtered by the exchange column
 * @method     ChildNetreviewsProductReview findOneByCreatedAt(string $created_at) Return the first ChildNetreviewsProductReview filtered by the created_at column
 * @method     ChildNetreviewsProductReview findOneByUpdatedAt(string $updated_at) Return the first ChildNetreviewsProductReview filtered by the updated_at column
 *
 * @method     array findByProductReviewId(string $product_review_id) Return ChildNetreviewsProductReview objects filtered by the product_review_id column
 * @method     array findByReviewId(string $review_id) Return ChildNetreviewsProductReview objects filtered by the review_id column
 * @method     array findByEmail(string $email) Return ChildNetreviewsProductReview objects filtered by the email column
 * @method     array findByLastname(string $lastname) Return ChildNetreviewsProductReview objects filtered by the lastname column
 * @method     array findByFirstname(string $firstname) Return ChildNetreviewsProductReview objects filtered by the firstname column
 * @method     array findByReviewDate(string $review_date) Return ChildNetreviewsProductReview objects filtered by the review_date column
 * @method     array findByMessage(string $message) Return ChildNetreviewsProductReview objects filtered by the message column
 * @method     array findByRate(string $rate) Return ChildNetreviewsProductReview objects filtered by the rate column
 * @method     array findByOrderRef(string $order_ref) Return ChildNetreviewsProductReview objects filtered by the order_ref column
 * @method     array findByProductRef(string $product_ref) Return ChildNetreviewsProductReview objects filtered by the product_ref column
 * @method     array findByProductId(int $product_id) Return ChildNetreviewsProductReview objects filtered by the product_id column
 * @method     array findByExchange(int $exchange) Return ChildNetreviewsProductReview objects filtered by the exchange column
 * @method     array findByCreatedAt(string $created_at) Return ChildNetreviewsProductReview objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return ChildNetreviewsProductReview objects filtered by the updated_at column
 *
 */
abstract class NetreviewsProductReviewQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \NetReviews\Model\Base\NetreviewsProductReviewQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\NetReviews\\Model\\NetreviewsProductReview', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNetreviewsProductReviewQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNetreviewsProductReviewQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \NetReviews\Model\NetreviewsProductReviewQuery) {
            return $criteria;
        }
        $query = new \NetReviews\Model\NetreviewsProductReviewQuery();
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
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NetreviewsProductReviewTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
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
     * @return   ChildNetreviewsProductReview A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT PRODUCT_REVIEW_ID, REVIEW_ID, EMAIL, LASTNAME, FIRSTNAME, REVIEW_DATE, MESSAGE, RATE, ORDER_REF, PRODUCT_REF, PRODUCT_ID, EXCHANGE, CREATED_AT, UPDATED_AT FROM netreviews_product_review WHERE PRODUCT_REVIEW_ID = :p0';
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
            $obj = new ChildNetreviewsProductReview();
            $obj->hydrate($row);
            NetreviewsProductReviewTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildNetreviewsProductReview|array|mixed the result, formatted by the current formatter
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the product_review_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProductReviewId('fooValue');   // WHERE product_review_id = 'fooValue'
     * $query->filterByProductReviewId('%fooValue%'); // WHERE product_review_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productReviewId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByProductReviewId($productReviewId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productReviewId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productReviewId)) {
                $productReviewId = str_replace('*', '%', $productReviewId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $productReviewId, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::REVIEW_ID, $reviewId, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::EMAIL, $email, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::LASTNAME, $lastname, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::FIRSTNAME, $firstname, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByReviewDate($reviewDate = null, $comparison = null)
    {
        if (is_array($reviewDate)) {
            $useMinMax = false;
            if (isset($reviewDate['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::REVIEW_DATE, $reviewDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reviewDate['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::REVIEW_DATE, $reviewDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::REVIEW_DATE, $reviewDate, $comparison);
    }

    /**
     * Filter the query on the message column
     *
     * Example usage:
     * <code>
     * $query->filterByMessage('fooValue');   // WHERE message = 'fooValue'
     * $query->filterByMessage('%fooValue%'); // WHERE message LIKE '%fooValue%'
     * </code>
     *
     * @param     string $message The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByMessage($message = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($message)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $message)) {
                $message = str_replace('*', '%', $message);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::MESSAGE, $message, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::RATE, $rate, $comparison);
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
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
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

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::ORDER_REF, $orderRef, $comparison);
    }

    /**
     * Filter the query on the product_ref column
     *
     * Example usage:
     * <code>
     * $query->filterByProductRef('fooValue');   // WHERE product_ref = 'fooValue'
     * $query->filterByProductRef('%fooValue%'); // WHERE product_ref LIKE '%fooValue%'
     * </code>
     *
     * @param     string $productRef The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByProductRef($productRef = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($productRef)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $productRef)) {
                $productRef = str_replace('*', '%', $productRef);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REF, $productRef, $comparison);
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
     * @param     mixed $productId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByProductId($productId = null, $comparison = null)
    {
        if (is_array($productId)) {
            $useMinMax = false;
            if (isset($productId['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_ID, $productId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($productId['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_ID, $productId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_ID, $productId, $comparison);
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
     * @param     mixed $exchange The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByExchange($exchange = null, $comparison = null)
    {
        if (is_array($exchange)) {
            $useMinMax = false;
            if (isset($exchange['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::EXCHANGE, $exchange['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($exchange['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::EXCHANGE, $exchange['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::EXCHANGE, $exchange, $comparison);
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
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::CREATED_AT, $createdAt, $comparison);
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
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NetreviewsProductReviewTableMap::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NetreviewsProductReviewTableMap::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \NetReviews\Model\NetreviewsProductReviewExchange object
     *
     * @param \NetReviews\Model\NetreviewsProductReviewExchange|ObjectCollection $netreviewsProductReviewExchange  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function filterByNetreviewsProductReviewExchange($netreviewsProductReviewExchange, $comparison = null)
    {
        if ($netreviewsProductReviewExchange instanceof \NetReviews\Model\NetreviewsProductReviewExchange) {
            return $this
                ->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $netreviewsProductReviewExchange->getProductReviewId(), $comparison);
        } elseif ($netreviewsProductReviewExchange instanceof ObjectCollection) {
            return $this
                ->useNetreviewsProductReviewExchangeQuery()
                ->filterByPrimaryKeys($netreviewsProductReviewExchange->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNetreviewsProductReviewExchange() only accepts arguments of type \NetReviews\Model\NetreviewsProductReviewExchange or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NetreviewsProductReviewExchange relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function joinNetreviewsProductReviewExchange($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \NetReviews\Model\NetreviewsProductReviewExchangeQuery A secondary query class using the current class as primary query
     */
    public function useNetreviewsProductReviewExchangeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNetreviewsProductReviewExchange($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NetreviewsProductReviewExchange', '\NetReviews\Model\NetreviewsProductReviewExchangeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNetreviewsProductReview $netreviewsProductReview Object to remove from the list of results
     *
     * @return ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function prune($netreviewsProductReview = null)
    {
        if ($netreviewsProductReview) {
            $this->addUsingAlias(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $netreviewsProductReview->getProductReviewId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the netreviews_product_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
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
            NetreviewsProductReviewTableMap::clearInstancePool();
            NetreviewsProductReviewTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildNetreviewsProductReview or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildNetreviewsProductReview object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NetreviewsProductReviewTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        NetreviewsProductReviewTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NetreviewsProductReviewTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(NetreviewsProductReviewTableMap::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(NetreviewsProductReviewTableMap::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(NetreviewsProductReviewTableMap::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(NetreviewsProductReviewTableMap::UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(NetreviewsProductReviewTableMap::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ChildNetreviewsProductReviewQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(NetreviewsProductReviewTableMap::CREATED_AT);
    }

} // NetreviewsProductReviewQuery
