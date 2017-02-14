<?php

namespace NetReviews\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsProductReview as ChildNetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewExchange as ChildNetreviewsProductReviewExchange;
use NetReviews\Model\NetreviewsProductReviewExchangeQuery as ChildNetreviewsProductReviewExchangeQuery;
use NetReviews\Model\NetreviewsProductReviewQuery as ChildNetreviewsProductReviewQuery;
use NetReviews\Model\Map\NetreviewsProductReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

abstract class NetreviewsProductReview implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\NetReviews\\Model\\Map\\NetreviewsProductReviewTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the product_review_id field.
     * @var        string
     */
    protected $product_review_id;

    /**
     * The value for the review_id field.
     * @var        string
     */
    protected $review_id;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the lastname field.
     * @var        string
     */
    protected $lastname;

    /**
     * The value for the firstname field.
     * @var        string
     */
    protected $firstname;

    /**
     * The value for the review_date field.
     * @var        string
     */
    protected $review_date;

    /**
     * The value for the message field.
     * @var        string
     */
    protected $message;

    /**
     * The value for the rate field.
     * @var        string
     */
    protected $rate;

    /**
     * The value for the order_ref field.
     * @var        string
     */
    protected $order_ref;

    /**
     * The value for the product_ref field.
     * @var        string
     */
    protected $product_ref;

    /**
     * The value for the product_id field.
     * @var        int
     */
    protected $product_id;

    /**
     * The value for the exchange field.
     * @var        int
     */
    protected $exchange;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        ObjectCollection|ChildNetreviewsProductReviewExchange[] Collection to store aggregation of ChildNetreviewsProductReviewExchange objects.
     */
    protected $collNetreviewsProductReviewExchanges;
    protected $collNetreviewsProductReviewExchangesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection
     */
    protected $netreviewsProductReviewExchangesScheduledForDeletion = null;

    /**
     * Initializes internal state of NetReviews\Model\Base\NetreviewsProductReview object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (Boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (Boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>NetreviewsProductReview</code> instance.  If
     * <code>obj</code> is an instance of <code>NetreviewsProductReview</code>, delegates to
     * <code>equals(NetreviewsProductReview)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        $thisclazz = get_class($this);
        if (!is_object($obj) || !($obj instanceof $thisclazz)) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey()
            || null === $obj->getPrimaryKey())  {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        if (null !== $this->getPrimaryKey()) {
            return crc32(serialize($this->getPrimaryKey()));
        }

        return crc32(serialize(clone $this));
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return NetreviewsProductReview The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     *
     * @return NetreviewsProductReview The current object, for fluid interface
     */
    public function importFrom($parser, $data)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), TableMap::TYPE_PHPNAME);

        return $this;
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [product_review_id] column value.
     *
     * @return   string
     */
    public function getProductReviewId()
    {

        return $this->product_review_id;
    }

    /**
     * Get the [review_id] column value.
     *
     * @return   string
     */
    public function getReviewId()
    {

        return $this->review_id;
    }

    /**
     * Get the [email] column value.
     *
     * @return   string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * Get the [lastname] column value.
     *
     * @return   string
     */
    public function getLastname()
    {

        return $this->lastname;
    }

    /**
     * Get the [firstname] column value.
     *
     * @return   string
     */
    public function getFirstname()
    {

        return $this->firstname;
    }

    /**
     * Get the [optionally formatted] temporal [review_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getReviewDate($format = NULL)
    {
        if ($format === null) {
            return $this->review_date;
        } else {
            return $this->review_date instanceof \DateTime ? $this->review_date->format($format) : null;
        }
    }

    /**
     * Get the [message] column value.
     *
     * @return   string
     */
    public function getMessage()
    {

        return $this->message;
    }

    /**
     * Get the [rate] column value.
     *
     * @return   string
     */
    public function getRate()
    {

        return $this->rate;
    }

    /**
     * Get the [order_ref] column value.
     *
     * @return   string
     */
    public function getOrderRef()
    {

        return $this->order_ref;
    }

    /**
     * Get the [product_ref] column value.
     *
     * @return   string
     */
    public function getProductRef()
    {

        return $this->product_ref;
    }

    /**
     * Get the [product_id] column value.
     *
     * @return   int
     */
    public function getProductId()
    {

        return $this->product_id;
    }

    /**
     * Get the [exchange] column value.
     *
     * @return   int
     */
    public function getExchange()
    {

        return $this->exchange;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTime ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw \DateTime object will be returned.
     *
     * @return mixed Formatted date/time value as string or \DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTime ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [product_review_id] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setProductReviewId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_review_id !== $v) {
            $this->product_review_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID] = true;
        }


        return $this;
    } // setProductReviewId()

    /**
     * Set the value of [review_id] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setReviewId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->review_id !== $v) {
            $this->review_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::REVIEW_ID] = true;
        }


        return $this;
    } // setReviewId()

    /**
     * Set the value of [email] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::EMAIL] = true;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [lastname] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setLastname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lastname !== $v) {
            $this->lastname = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::LASTNAME] = true;
        }


        return $this;
    } // setLastname()

    /**
     * Set the value of [firstname] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setFirstname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->firstname !== $v) {
            $this->firstname = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::FIRSTNAME] = true;
        }


        return $this;
    } // setFirstname()

    /**
     * Sets the value of [review_date] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setReviewDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->review_date !== null || $dt !== null) {
            if ($dt !== $this->review_date) {
                $this->review_date = $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::REVIEW_DATE] = true;
            }
        } // if either are not null


        return $this;
    } // setReviewDate()

    /**
     * Set the value of [message] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setMessage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->message !== $v) {
            $this->message = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::MESSAGE] = true;
        }


        return $this;
    } // setMessage()

    /**
     * Set the value of [rate] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setRate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::RATE] = true;
        }


        return $this;
    } // setRate()

    /**
     * Set the value of [order_ref] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setOrderRef($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_ref !== $v) {
            $this->order_ref = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::ORDER_REF] = true;
        }


        return $this;
    } // setOrderRef()

    /**
     * Set the value of [product_ref] column.
     *
     * @param      string $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setProductRef($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_ref !== $v) {
            $this->product_ref = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::PRODUCT_REF] = true;
        }


        return $this;
    } // setProductRef()

    /**
     * Set the value of [product_id] column.
     *
     * @param      int $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setProductId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::PRODUCT_ID] = true;
        }


        return $this;
    } // setProductId()

    /**
     * Set the value of [exchange] column.
     *
     * @param      int $v new value
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setExchange($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->exchange !== $v) {
            $this->exchange = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::EXCHANGE] = true;
        }


        return $this;
    } // setExchange()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($dt !== $this->created_at) {
                $this->created_at = $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::CREATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param      mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, '\DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($dt !== $this->updated_at) {
                $this->updated_at = $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::UPDATED_AT] = true;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {


            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('ProductReviewId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_review_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('ReviewId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->review_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Lastname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->lastname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Firstname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->firstname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('ReviewDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->review_date = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Message', TableMap::TYPE_PHPNAME, $indexType)];
            $this->message = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Rate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rate = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('OrderRef', TableMap::TYPE_PHPNAME, $indexType)];
            $this->order_ref = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('ProductRef', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_ref = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('ProductId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->product_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('Exchange', TableMap::TYPE_PHPNAME, $indexType)];
            $this->exchange = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, '\DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = NetreviewsProductReviewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating \NetReviews\Model\NetreviewsProductReview object", 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildNetreviewsProductReviewQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collNetreviewsProductReviewExchanges = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see NetreviewsProductReview::setDeleted()
     * @see NetreviewsProductReview::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ChildNetreviewsProductReviewQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(NetreviewsProductReviewTableMap::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(NetreviewsProductReviewTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(NetreviewsProductReviewTableMap::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                NetreviewsProductReviewTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->netreviewsProductReviewExchangesScheduledForDeletion !== null) {
                if (!$this->netreviewsProductReviewExchangesScheduledForDeletion->isEmpty()) {
                    \NetReviews\Model\NetreviewsProductReviewExchangeQuery::create()
                        ->filterByPrimaryKeys($this->netreviewsProductReviewExchangesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->netreviewsProductReviewExchangesScheduledForDeletion = null;
                }
            }

                if ($this->collNetreviewsProductReviewExchanges !== null) {
            foreach ($this->collNetreviewsProductReviewExchanges as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID)) {
            $modifiedColumns[':p' . $index++]  = 'PRODUCT_REVIEW_ID';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::REVIEW_ID)) {
            $modifiedColumns[':p' . $index++]  = 'REVIEW_ID';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'EMAIL';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'LASTNAME';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = 'FIRSTNAME';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::REVIEW_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'REVIEW_DATE';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = 'MESSAGE';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::RATE)) {
            $modifiedColumns[':p' . $index++]  = 'RATE';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::ORDER_REF)) {
            $modifiedColumns[':p' . $index++]  = 'ORDER_REF';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_REF)) {
            $modifiedColumns[':p' . $index++]  = 'PRODUCT_REF';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'PRODUCT_ID';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::EXCHANGE)) {
            $modifiedColumns[':p' . $index++]  = 'EXCHANGE';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'CREATED_AT';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'UPDATED_AT';
        }

        $sql = sprintf(
            'INSERT INTO netreviews_product_review (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'PRODUCT_REVIEW_ID':
                        $stmt->bindValue($identifier, $this->product_review_id, PDO::PARAM_STR);
                        break;
                    case 'REVIEW_ID':
                        $stmt->bindValue($identifier, $this->review_id, PDO::PARAM_STR);
                        break;
                    case 'EMAIL':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'LASTNAME':
                        $stmt->bindValue($identifier, $this->lastname, PDO::PARAM_STR);
                        break;
                    case 'FIRSTNAME':
                        $stmt->bindValue($identifier, $this->firstname, PDO::PARAM_STR);
                        break;
                    case 'REVIEW_DATE':
                        $stmt->bindValue($identifier, $this->review_date ? $this->review_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'MESSAGE':
                        $stmt->bindValue($identifier, $this->message, PDO::PARAM_STR);
                        break;
                    case 'RATE':
                        $stmt->bindValue($identifier, $this->rate, PDO::PARAM_STR);
                        break;
                    case 'ORDER_REF':
                        $stmt->bindValue($identifier, $this->order_ref, PDO::PARAM_STR);
                        break;
                    case 'PRODUCT_REF':
                        $stmt->bindValue($identifier, $this->product_ref, PDO::PARAM_STR);
                        break;
                    case 'PRODUCT_ID':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);
                        break;
                    case 'EXCHANGE':
                        $stmt->bindValue($identifier, $this->exchange, PDO::PARAM_INT);
                        break;
                    case 'CREATED_AT':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'UPDATED_AT':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NetreviewsProductReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getProductReviewId();
                break;
            case 1:
                return $this->getReviewId();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getLastname();
                break;
            case 4:
                return $this->getFirstname();
                break;
            case 5:
                return $this->getReviewDate();
                break;
            case 6:
                return $this->getMessage();
                break;
            case 7:
                return $this->getRate();
                break;
            case 8:
                return $this->getOrderRef();
                break;
            case 9:
                return $this->getProductRef();
                break;
            case 10:
                return $this->getProductId();
                break;
            case 11:
                return $this->getExchange();
                break;
            case 12:
                return $this->getCreatedAt();
                break;
            case 13:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['NetreviewsProductReview'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NetreviewsProductReview'][$this->getPrimaryKey()] = true;
        $keys = NetreviewsProductReviewTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getProductReviewId(),
            $keys[1] => $this->getReviewId(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getLastname(),
            $keys[4] => $this->getFirstname(),
            $keys[5] => $this->getReviewDate(),
            $keys[6] => $this->getMessage(),
            $keys[7] => $this->getRate(),
            $keys[8] => $this->getOrderRef(),
            $keys[9] => $this->getProductRef(),
            $keys[10] => $this->getProductId(),
            $keys[11] => $this->getExchange(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collNetreviewsProductReviewExchanges) {
                $result['NetreviewsProductReviewExchanges'] = $this->collNetreviewsProductReviewExchanges->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name
     * @param      mixed  $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return void
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NetreviewsProductReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setProductReviewId($value);
                break;
            case 1:
                $this->setReviewId($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setLastname($value);
                break;
            case 4:
                $this->setFirstname($value);
                break;
            case 5:
                $this->setReviewDate($value);
                break;
            case 6:
                $this->setMessage($value);
                break;
            case 7:
                $this->setRate($value);
                break;
            case 8:
                $this->setOrderRef($value);
                break;
            case 9:
                $this->setProductRef($value);
                break;
            case 10:
                $this->setProductId($value);
                break;
            case 11:
                $this->setExchange($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_STUDLYPHPNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = NetreviewsProductReviewTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setProductReviewId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setReviewId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLastname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFirstname($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setReviewDate($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setMessage($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setRate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setOrderRef($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setProductRef($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setProductId($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setExchange($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setCreatedAt($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setUpdatedAt($arr[$keys[13]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NetreviewsProductReviewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID)) $criteria->add(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $this->product_review_id);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::REVIEW_ID)) $criteria->add(NetreviewsProductReviewTableMap::REVIEW_ID, $this->review_id);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::EMAIL)) $criteria->add(NetreviewsProductReviewTableMap::EMAIL, $this->email);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::LASTNAME)) $criteria->add(NetreviewsProductReviewTableMap::LASTNAME, $this->lastname);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::FIRSTNAME)) $criteria->add(NetreviewsProductReviewTableMap::FIRSTNAME, $this->firstname);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::REVIEW_DATE)) $criteria->add(NetreviewsProductReviewTableMap::REVIEW_DATE, $this->review_date);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::MESSAGE)) $criteria->add(NetreviewsProductReviewTableMap::MESSAGE, $this->message);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::RATE)) $criteria->add(NetreviewsProductReviewTableMap::RATE, $this->rate);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::ORDER_REF)) $criteria->add(NetreviewsProductReviewTableMap::ORDER_REF, $this->order_ref);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_REF)) $criteria->add(NetreviewsProductReviewTableMap::PRODUCT_REF, $this->product_ref);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::PRODUCT_ID)) $criteria->add(NetreviewsProductReviewTableMap::PRODUCT_ID, $this->product_id);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::EXCHANGE)) $criteria->add(NetreviewsProductReviewTableMap::EXCHANGE, $this->exchange);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::CREATED_AT)) $criteria->add(NetreviewsProductReviewTableMap::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::UPDATED_AT)) $criteria->add(NetreviewsProductReviewTableMap::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(NetreviewsProductReviewTableMap::DATABASE_NAME);
        $criteria->add(NetreviewsProductReviewTableMap::PRODUCT_REVIEW_ID, $this->product_review_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   string
     */
    public function getPrimaryKey()
    {
        return $this->getProductReviewId();
    }

    /**
     * Generic method to set the primary key (product_review_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setProductReviewId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getProductReviewId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \NetReviews\Model\NetreviewsProductReview (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setProductReviewId($this->getProductReviewId());
        $copyObj->setReviewId($this->getReviewId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setLastname($this->getLastname());
        $copyObj->setFirstname($this->getFirstname());
        $copyObj->setReviewDate($this->getReviewDate());
        $copyObj->setMessage($this->getMessage());
        $copyObj->setRate($this->getRate());
        $copyObj->setOrderRef($this->getOrderRef());
        $copyObj->setProductRef($this->getProductRef());
        $copyObj->setProductId($this->getProductId());
        $copyObj->setExchange($this->getExchange());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getNetreviewsProductReviewExchanges() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNetreviewsProductReviewExchange($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 \NetReviews\Model\NetreviewsProductReview Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('NetreviewsProductReviewExchange' == $relationName) {
            return $this->initNetreviewsProductReviewExchanges();
        }
    }

    /**
     * Clears out the collNetreviewsProductReviewExchanges collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addNetreviewsProductReviewExchanges()
     */
    public function clearNetreviewsProductReviewExchanges()
    {
        $this->collNetreviewsProductReviewExchanges = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collNetreviewsProductReviewExchanges collection loaded partially.
     */
    public function resetPartialNetreviewsProductReviewExchanges($v = true)
    {
        $this->collNetreviewsProductReviewExchangesPartial = $v;
    }

    /**
     * Initializes the collNetreviewsProductReviewExchanges collection.
     *
     * By default this just sets the collNetreviewsProductReviewExchanges collection to an empty array (like clearcollNetreviewsProductReviewExchanges());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNetreviewsProductReviewExchanges($overrideExisting = true)
    {
        if (null !== $this->collNetreviewsProductReviewExchanges && !$overrideExisting) {
            return;
        }
        $this->collNetreviewsProductReviewExchanges = new ObjectCollection();
        $this->collNetreviewsProductReviewExchanges->setModel('\NetReviews\Model\NetreviewsProductReviewExchange');
    }

    /**
     * Gets an array of ChildNetreviewsProductReviewExchange objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildNetreviewsProductReview is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return Collection|ChildNetreviewsProductReviewExchange[] List of ChildNetreviewsProductReviewExchange objects
     * @throws PropelException
     */
    public function getNetreviewsProductReviewExchanges($criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collNetreviewsProductReviewExchangesPartial && !$this->isNew();
        if (null === $this->collNetreviewsProductReviewExchanges || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNetreviewsProductReviewExchanges) {
                // return empty collection
                $this->initNetreviewsProductReviewExchanges();
            } else {
                $collNetreviewsProductReviewExchanges = ChildNetreviewsProductReviewExchangeQuery::create(null, $criteria)
                    ->filterByNetreviewsProductReview($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collNetreviewsProductReviewExchangesPartial && count($collNetreviewsProductReviewExchanges)) {
                        $this->initNetreviewsProductReviewExchanges(false);

                        foreach ($collNetreviewsProductReviewExchanges as $obj) {
                            if (false == $this->collNetreviewsProductReviewExchanges->contains($obj)) {
                                $this->collNetreviewsProductReviewExchanges->append($obj);
                            }
                        }

                        $this->collNetreviewsProductReviewExchangesPartial = true;
                    }

                    reset($collNetreviewsProductReviewExchanges);

                    return $collNetreviewsProductReviewExchanges;
                }

                if ($partial && $this->collNetreviewsProductReviewExchanges) {
                    foreach ($this->collNetreviewsProductReviewExchanges as $obj) {
                        if ($obj->isNew()) {
                            $collNetreviewsProductReviewExchanges[] = $obj;
                        }
                    }
                }

                $this->collNetreviewsProductReviewExchanges = $collNetreviewsProductReviewExchanges;
                $this->collNetreviewsProductReviewExchangesPartial = false;
            }
        }

        return $this->collNetreviewsProductReviewExchanges;
    }

    /**
     * Sets a collection of NetreviewsProductReviewExchange objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $netreviewsProductReviewExchanges A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return   ChildNetreviewsProductReview The current object (for fluent API support)
     */
    public function setNetreviewsProductReviewExchanges(Collection $netreviewsProductReviewExchanges, ConnectionInterface $con = null)
    {
        $netreviewsProductReviewExchangesToDelete = $this->getNetreviewsProductReviewExchanges(new Criteria(), $con)->diff($netreviewsProductReviewExchanges);


        $this->netreviewsProductReviewExchangesScheduledForDeletion = $netreviewsProductReviewExchangesToDelete;

        foreach ($netreviewsProductReviewExchangesToDelete as $netreviewsProductReviewExchangeRemoved) {
            $netreviewsProductReviewExchangeRemoved->setNetreviewsProductReview(null);
        }

        $this->collNetreviewsProductReviewExchanges = null;
        foreach ($netreviewsProductReviewExchanges as $netreviewsProductReviewExchange) {
            $this->addNetreviewsProductReviewExchange($netreviewsProductReviewExchange);
        }

        $this->collNetreviewsProductReviewExchanges = $netreviewsProductReviewExchanges;
        $this->collNetreviewsProductReviewExchangesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NetreviewsProductReviewExchange objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related NetreviewsProductReviewExchange objects.
     * @throws PropelException
     */
    public function countNetreviewsProductReviewExchanges(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collNetreviewsProductReviewExchangesPartial && !$this->isNew();
        if (null === $this->collNetreviewsProductReviewExchanges || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNetreviewsProductReviewExchanges) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getNetreviewsProductReviewExchanges());
            }

            $query = ChildNetreviewsProductReviewExchangeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByNetreviewsProductReview($this)
                ->count($con);
        }

        return count($this->collNetreviewsProductReviewExchanges);
    }

    /**
     * Method called to associate a ChildNetreviewsProductReviewExchange object to this object
     * through the ChildNetreviewsProductReviewExchange foreign key attribute.
     *
     * @param    ChildNetreviewsProductReviewExchange $l ChildNetreviewsProductReviewExchange
     * @return   \NetReviews\Model\NetreviewsProductReview The current object (for fluent API support)
     */
    public function addNetreviewsProductReviewExchange(ChildNetreviewsProductReviewExchange $l)
    {
        if ($this->collNetreviewsProductReviewExchanges === null) {
            $this->initNetreviewsProductReviewExchanges();
            $this->collNetreviewsProductReviewExchangesPartial = true;
        }

        if (!in_array($l, $this->collNetreviewsProductReviewExchanges->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNetreviewsProductReviewExchange($l);
        }

        return $this;
    }

    /**
     * @param NetreviewsProductReviewExchange $netreviewsProductReviewExchange The netreviewsProductReviewExchange object to add.
     */
    protected function doAddNetreviewsProductReviewExchange($netreviewsProductReviewExchange)
    {
        $this->collNetreviewsProductReviewExchanges[]= $netreviewsProductReviewExchange;
        $netreviewsProductReviewExchange->setNetreviewsProductReview($this);
    }

    /**
     * @param  NetreviewsProductReviewExchange $netreviewsProductReviewExchange The netreviewsProductReviewExchange object to remove.
     * @return ChildNetreviewsProductReview The current object (for fluent API support)
     */
    public function removeNetreviewsProductReviewExchange($netreviewsProductReviewExchange)
    {
        if ($this->getNetreviewsProductReviewExchanges()->contains($netreviewsProductReviewExchange)) {
            $this->collNetreviewsProductReviewExchanges->remove($this->collNetreviewsProductReviewExchanges->search($netreviewsProductReviewExchange));
            if (null === $this->netreviewsProductReviewExchangesScheduledForDeletion) {
                $this->netreviewsProductReviewExchangesScheduledForDeletion = clone $this->collNetreviewsProductReviewExchanges;
                $this->netreviewsProductReviewExchangesScheduledForDeletion->clear();
            }
            $this->netreviewsProductReviewExchangesScheduledForDeletion[]= clone $netreviewsProductReviewExchange;
            $netreviewsProductReviewExchange->setNetreviewsProductReview(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->product_review_id = null;
        $this->review_id = null;
        $this->email = null;
        $this->lastname = null;
        $this->firstname = null;
        $this->review_date = null;
        $this->message = null;
        $this->rate = null;
        $this->order_ref = null;
        $this->product_ref = null;
        $this->product_id = null;
        $this->exchange = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collNetreviewsProductReviewExchanges) {
                foreach ($this->collNetreviewsProductReviewExchanges as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collNetreviewsProductReviewExchanges = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NetreviewsProductReviewTableMap::DEFAULT_STRING_FORMAT);
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     ChildNetreviewsProductReview The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[NetreviewsProductReviewTableMap::UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
