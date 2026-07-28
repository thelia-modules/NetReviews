<?php

namespace NetReviews\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use NetReviews\Model\NetreviewsProductReview as ChildNetreviewsProductReview;
use NetReviews\Model\NetreviewsProductReviewExchange as ChildNetreviewsProductReviewExchange;
use NetReviews\Model\NetreviewsProductReviewExchangeQuery as ChildNetreviewsProductReviewExchangeQuery;
use NetReviews\Model\NetreviewsProductReviewQuery as ChildNetreviewsProductReviewQuery;
use NetReviews\Model\Event\NetreviewsProductReviewEvent;
use NetReviews\Model\Map\NetreviewsProductReviewExchangeTableMap;
use NetReviews\Model\Map\NetreviewsProductReviewTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'netreviews_product_review' table.
 *
 *
 *
 * @package    propel.generator.NetReviews.Model.Base
 */
abstract class NetreviewsProductReview implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\NetReviews\\Model\\Map\\NetreviewsProductReviewTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var bool
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var bool
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = [];

    /**
     * The value for the product_review_id field.
     *
     * @var        string
     */
    protected ?string $product_review_id = null;

    /**
     * The value for the review_id field.
     *
     * @var        string
     */
    protected ?string $review_id = null;

    /**
     * The value for the email field.
     *
     * @var        string|null
     */
    protected ?string $email = null;

    /**
     * The value for the lastname field.
     *
     * @var        string|null
     */
    protected ?string $lastname = null;

    /**
     * The value for the firstname field.
     *
     * @var        string|null
     */
    protected ?string $firstname = null;

    /**
     * The value for the review_date field.
     *
     * @var        DateTime|null
     */
    protected ?\DateTimeInterface $review_date = null;

    /**
     * The value for the message field.
     *
     * @var        string|null
     */
    protected ?string $message = null;

    /**
     * The value for the rate field.
     *
     * @var        string|null
     */
    protected ?string $rate = null;

    /**
     * The value for the order_ref field.
     *
     * @var        string|null
     */
    protected ?string $order_ref = null;

    /**
     * The value for the product_ref field.
     *
     * @var        string|null
     */
    protected ?string $product_ref = null;

    /**
     * The value for the product_id field.
     *
     * @var        int|null
     */
    protected ?int $product_id = null;

    /**
     * The value for the exchange field.
     *
     * @var        int|null
     */
    protected ?int $exchange = null;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected ?\DateTimeInterface $created_at = null;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected ?\DateTimeInterface $updated_at = null;

    /**
     * @var        ObjectCollection|ChildNetreviewsProductReviewExchange[] Collection to store aggregation of ChildNetreviewsProductReviewExchange objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildNetreviewsProductReviewExchange> Collection to store aggregation of ChildNetreviewsProductReviewExchange objects.
     */
    protected $collNetreviewsProductReviewExchanges;
    protected $collNetreviewsProductReviewExchangesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var bool
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildNetreviewsProductReviewExchange[]
     * @phpstan-var ObjectCollection&\Traversable<ChildNetreviewsProductReviewExchange>
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
     * @return bool True if the object has been modified.
     */
    public function isModified(): bool
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return bool True, if the object has never been persisted.
     */
    public function isNew(): bool
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param bool $b The deleted state of this object.
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>NetreviewsProductReview</code> instance.  If
     * <code>obj</code> is an instance of <code>NetreviewsProductReview</code>, delegates to
     * <code>equals(NetreviewsProductReview)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     * @return bool Whether equal to the object specified.
     */
    public function equals($obj): bool
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array<string, mixed>
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @return bool
     */
    public function hasVirtualColumn(string $name): bool
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     *
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getVirtualColumn(string $name): mixed
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of nonexistent virtual column `%s`.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name The virtual column name
     * @param mixed $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn(string $name, mixed $value): static
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(\get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param \Propel\Runtime\Parser\AbstractParser|string $parser An AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     *
     * @return array<string>
     */
    public function __sleep(): array
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [product_review_id] column value.
     *
     * @return string
     */
    public function getProductReviewId(): ?string
    {
        return $this->product_review_id;
    }

    /**
     * Get the [review_id] column value.
     *
     * @return string
     */
    public function getReviewId(): ?string
    {
        return $this->review_id;
    }

    /**
     * Get the [email] column value.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get the [lastname] column value.
     *
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Get the [firstname] column value.
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Get the [optionally formatted] temporal [review_date] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getReviewDate(?string $format = null): string|\DateTimeInterface|null
    {
        if ($format === null) {
            return $this->review_date;
        } else {
            return $this->review_date instanceof \DateTimeInterface ? $this->review_date->format($format) : null;
        }
    }

    /**
     * Get the [message] column value.
     *
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Get the [rate] column value.
     *
     * @return string|null
     */
    public function getRate(): ?string
    {
        return $this->rate;
    }

    /**
     * Get the [order_ref] column value.
     *
     * @return string|null
     */
    public function getOrderRef(): ?string
    {
        return $this->order_ref;
    }

    /**
     * Get the [product_ref] column value.
     *
     * @return string|null
     */
    public function getProductRef(): ?string
    {
        return $this->product_ref;
    }

    /**
     * Get the [product_id] column value.
     *
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    /**
     * Get the [exchange] column value.
     *
     * @return int|null
     */
    public function getExchange(): ?int
    {
        return $this->exchange;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt(?string $format = null): string|\DateTimeInterface|null
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt(?string $format = null): string|\DateTimeInterface|null
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [product_review_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductReviewId(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_review_id !== $v) {
            $this->product_review_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [review_id] column.
     *
     * @param string $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setReviewId(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->review_id !== $v) {
            $this->review_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_REVIEW_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [email] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setEmail(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_EMAIL] = true;
        }

        return $this;
    }

    /**
     * Set the value of [lastname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setLastname(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->lastname !== $v) {
            $this->lastname = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_LASTNAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [firstname] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setFirstname(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->firstname !== $v) {
            $this->firstname = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_FIRSTNAME] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [review_date] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setReviewDate(string|int|\DateTimeInterface|null $v = null): static
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->review_date !== null || $dt !== null) {
            if ($this->review_date === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->review_date->format("Y-m-d H:i:s.u")) {
                $this->review_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_REVIEW_DATE] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Set the value of [message] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setMessage(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->message !== $v) {
            $this->message = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_MESSAGE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [rate] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setRate(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rate !== $v) {
            $this->rate = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_RATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [order_ref] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setOrderRef(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->order_ref !== $v) {
            $this->order_ref = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_ORDER_REF] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_ref] column.
     *
     * @param string|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductRef(?string $v = null): static
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->product_ref !== $v) {
            $this->product_ref = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_PRODUCT_REF] = true;
        }

        return $this;
    }

    /**
     * Set the value of [product_id] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setProductId(?int $v = null): static
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->product_id !== $v) {
            $this->product_id = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_PRODUCT_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [exchange] column.
     *
     * @param int|null $v New value
     * @return $this The current object (for fluent API support)
     */
    public function setExchange(?int $v = null): static
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->exchange !== $v) {
            $this->exchange = $v;
            $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_EXCHANGE] = true;
        }

        return $this;
    }

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setCreatedAt(string|int|\DateTimeInterface|null $v = null): static
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this The current object (for fluent API support)
     */
    public function setUpdatedAt(string|int|\DateTimeInterface|null $v = null): static
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    }

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return bool Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues(): bool
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by DataFetcher->fetch().
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param bool $rehydrate Whether this object is being re-hydrated from the database.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int next starting column
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
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
            $this->review_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

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
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : NetreviewsProductReviewTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = NetreviewsProductReviewTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\NetReviews\\Model\\NetreviewsProductReview'), 0, $e);
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
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function ensureConsistency(): void
    {
    }

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param bool $deep (optional) Whether to also de-associated any related objects.
     * @param ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
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
     * @param ConnectionInterface $con
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @see NetreviewsProductReview::setDeleted()
     * @see NetreviewsProductReview::isDeleted()
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildNetreviewsProductReviewQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(NetreviewsProductReviewTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                $mtime = microtime(true);
                if (!$this->isColumnModified(NetreviewsProductReviewTableMap::COL_CREATED_AT)) {
                    $this->setCreatedAt(PropelDateTime::createHighPrecision(PropelDateTime::formatMicrotime($mtime), 'DateTime'));
                }
                if (!$this->isColumnModified(NetreviewsProductReviewTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(PropelDateTime::createHighPrecision(PropelDateTime::formatMicrotime($mtime), 'DateTime'));
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(NetreviewsProductReviewTableMap::COL_UPDATED_AT)) {
                    $this->setUpdatedAt(PropelDateTime::createHighPrecision(null, 'DateTime'));
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

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param ConnectionInterface $con
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws \Propel\Runtime\Exception\PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con): int
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
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
    }

    /**
     * Insert the row in the database.
     *
     * @param ConnectionInterface $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID)) {
            $modifiedColumns[':p' . $index++]  = '`product_review_id`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_REVIEW_ID)) {
            $modifiedColumns[':p' . $index++]  = '`review_id`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_LASTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`lastname`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_FIRSTNAME)) {
            $modifiedColumns[':p' . $index++]  = '`firstname`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_REVIEW_DATE)) {
            $modifiedColumns[':p' . $index++]  = '`review_date`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_MESSAGE)) {
            $modifiedColumns[':p' . $index++]  = '`message`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_RATE)) {
            $modifiedColumns[':p' . $index++]  = '`rate`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_ORDER_REF)) {
            $modifiedColumns[':p' . $index++]  = '`order_ref`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_REF)) {
            $modifiedColumns[':p' . $index++]  = '`product_ref`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`product_id`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_EXCHANGE)) {
            $modifiedColumns[':p' . $index++]  = '`exchange`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `netreviews_product_review` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`product_review_id`':
                        $stmt->bindValue($identifier, $this->product_review_id, PDO::PARAM_STR);

                        break;
                    case '`review_id`':
                        $stmt->bindValue($identifier, $this->review_id, PDO::PARAM_STR);

                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);

                        break;
                    case '`lastname`':
                        $stmt->bindValue($identifier, $this->lastname, PDO::PARAM_STR);

                        break;
                    case '`firstname`':
                        $stmt->bindValue($identifier, $this->firstname, PDO::PARAM_STR);

                        break;
                    case '`review_date`':
                        $stmt->bindValue($identifier, $this->review_date ? $this->review_date->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`message`':
                        $stmt->bindValue($identifier, $this->message, PDO::PARAM_STR);

                        break;
                    case '`rate`':
                        $stmt->bindValue($identifier, $this->rate, PDO::PARAM_STR);

                        break;
                    case '`order_ref`':
                        $stmt->bindValue($identifier, $this->order_ref, PDO::PARAM_STR);

                        break;
                    case '`product_ref`':
                        $stmt->bindValue($identifier, $this->product_ref, PDO::PARAM_STR);

                        break;
                    case '`product_id`':
                        $stmt->bindValue($identifier, $this->product_id, PDO::PARAM_INT);

                        break;
                    case '`exchange`':
                        $stmt->bindValue($identifier, $this->exchange, PDO::PARAM_INT);

                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);

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
     * @param ConnectionInterface $con
     *
     * @return int Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con): int
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NetreviewsProductReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        switch ($pos) {
            case 0:
                return $this->getProductReviewId();

            case 1:
                return $this->getReviewId();

            case 2:
                return $this->getEmail();

            case 3:
                return $this->getLastname();

            case 4:
                return $this->getFirstname();

            case 5:
                return $this->getReviewDate();

            case 6:
                return $this->getMessage();

            case 7:
                return $this->getRate();

            case 8:
                return $this->getOrderRef();

            case 9:
                return $this->getProductRef();

            case 10:
                return $this->getProductId();

            case 11:
                return $this->getExchange();

            case 12:
                return $this->getCreatedAt();

            case 13:
                return $this->getUpdatedAt();

            default:
                return null;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param string $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param bool $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param bool $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array An associative array containing the field names (as keys) and field values
     */
    public function toArray(string $keyType = TableMap::TYPE_PHPNAME, bool $includeLazyLoadColumns = true, array $alreadyDumpedObjects = [], bool $includeForeignObjects = false): array
    {
        if (isset($alreadyDumpedObjects['NetreviewsProductReview'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['NetreviewsProductReview'][$this->hashCode()] = true;
        $keys = NetreviewsProductReviewTableMap::getFieldNames($keyType);
        $result = [
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
        ];
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collNetreviewsProductReviewExchanges) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'netreviewsProductReviewExchanges';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'netreviews_product_review_exchanges';
                        break;
                    default:
                        $key = 'NetreviewsProductReviewExchanges';
                }

                $result[$key] = $this->collNetreviewsProductReviewExchanges->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        $pos = NetreviewsProductReviewTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return $this
     */
    public function setByPosition(int $pos, $value)
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

        return $this;
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
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = NetreviewsProductReviewTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setProductReviewId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setReviewId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLastname($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setFirstname($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setReviewDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMessage($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setRate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setOrderRef($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setProductRef($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setProductId($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setExchange($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUpdatedAt($arr[$keys[13]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this The current object, for fluid interface
     */
    public function importFrom($parser, string $data, string $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria(): Criteria
    {
        $criteria = new Criteria(NetreviewsProductReviewTableMap::DATABASE_NAME);

        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $this->product_review_id);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_REVIEW_ID)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_REVIEW_ID, $this->review_id);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_EMAIL)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_LASTNAME)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_LASTNAME, $this->lastname);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_FIRSTNAME)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_FIRSTNAME, $this->firstname);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_REVIEW_DATE)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_REVIEW_DATE, $this->review_date);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_MESSAGE)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_MESSAGE, $this->message);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_RATE)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_RATE, $this->rate);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_ORDER_REF)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_ORDER_REF, $this->order_ref);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_REF)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_PRODUCT_REF, $this->product_ref);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_PRODUCT_ID)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_PRODUCT_ID, $this->product_id);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_EXCHANGE)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_EXCHANGE, $this->exchange);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_CREATED_AT)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(NetreviewsProductReviewTableMap::COL_UPDATED_AT)) {
            $criteria->add(NetreviewsProductReviewTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $criteria = ChildNetreviewsProductReviewQuery::create();
        $criteria->add(NetreviewsProductReviewTableMap::COL_PRODUCT_REVIEW_ID, $this->product_review_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int|string Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getProductReviewId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getProductReviewId();
    }

    /**
     * Generic method to set the primary key (product_review_id column).
     *
     * @param string|null $key Primary key.
     * @return void
     */
    public function setPrimaryKey(?string $key = null): void
    {
        $this->setProductReviewId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return null === $this->getProductReviewId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \NetReviews\Model\NetreviewsProductReview (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws \Propel\Runtime\Exception\PropelException
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
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
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \NetReviews\Model\NetreviewsProductReview Clone of current object.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function copy(bool $deepCopy = false)
    {
        // we use \get_class(), because this might be a subclass
        $clazz = \get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName): void
    {
        if ('NetreviewsProductReviewExchange' === $relationName) {
            $this->initNetreviewsProductReviewExchanges();
            return;
        }
    }

    /**
     * Clears out the collNetreviewsProductReviewExchanges collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return $this
     * @see addNetreviewsProductReviewExchanges()
     */
    public function clearNetreviewsProductReviewExchanges()
    {
        $this->collNetreviewsProductReviewExchanges = null; // important to set this to NULL since that means it is uninitialized

        return $this;
    }

    /**
     * Reset is the collNetreviewsProductReviewExchanges collection loaded partially.
     *
     * @return void
     */
    public function resetPartialNetreviewsProductReviewExchanges($v = true): void
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
     * @param bool $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNetreviewsProductReviewExchanges(bool $overrideExisting = true): void
    {
        if (null !== $this->collNetreviewsProductReviewExchanges && !$overrideExisting) {
            return;
        }

        $collectionClassName = NetreviewsProductReviewExchangeTableMap::getTableMap()->getCollectionClassName();

        $this->collNetreviewsProductReviewExchanges = new $collectionClassName;
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
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildNetreviewsProductReviewExchange[] List of ChildNetreviewsProductReviewExchange objects
     * @phpstan-return ObjectCollection&\Traversable<ChildNetreviewsProductReviewExchange> List of ChildNetreviewsProductReviewExchange objects
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getNetreviewsProductReviewExchanges(?Criteria $criteria = null, ?ConnectionInterface $con = null)
    {
        $partial = $this->collNetreviewsProductReviewExchangesPartial && !$this->isNew();
        if (null === $this->collNetreviewsProductReviewExchanges || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collNetreviewsProductReviewExchanges) {
                    $this->initNetreviewsProductReviewExchanges();
                } else {
                    $collectionClassName = NetreviewsProductReviewExchangeTableMap::getTableMap()->getCollectionClassName();

                    $collNetreviewsProductReviewExchanges = new $collectionClassName;
                    $collNetreviewsProductReviewExchanges->setModel('\NetReviews\Model\NetreviewsProductReviewExchange');

                    return $collNetreviewsProductReviewExchanges;
                }
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
     * Sets a collection of ChildNetreviewsProductReviewExchange objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param Collection $netreviewsProductReviewExchanges A Propel collection.
     * @param ConnectionInterface $con Optional connection object
     * @return $this The current object (for fluent API support)
     */
    public function setNetreviewsProductReviewExchanges(Collection $netreviewsProductReviewExchanges, ?ConnectionInterface $con = null)
    {
        /** @var ChildNetreviewsProductReviewExchange[] $netreviewsProductReviewExchangesToDelete */
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
     * @param Criteria $criteria
     * @param bool $distinct
     * @param ConnectionInterface $con
     * @return int Count of related NetreviewsProductReviewExchange objects.
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function countNetreviewsProductReviewExchanges(?Criteria $criteria = null, bool $distinct = false, ?ConnectionInterface $con = null): int
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
     * @param ChildNetreviewsProductReviewExchange $l ChildNetreviewsProductReviewExchange
     * @return $this The current object (for fluent API support)
     */
    public function addNetreviewsProductReviewExchange(ChildNetreviewsProductReviewExchange $l)
    {
        if ($this->collNetreviewsProductReviewExchanges === null) {
            $this->initNetreviewsProductReviewExchanges();
            $this->collNetreviewsProductReviewExchangesPartial = true;
        }

        if (!$this->collNetreviewsProductReviewExchanges->contains($l)) {
            $this->doAddNetreviewsProductReviewExchange($l);

            if ($this->netreviewsProductReviewExchangesScheduledForDeletion and $this->netreviewsProductReviewExchangesScheduledForDeletion->contains($l)) {
                $this->netreviewsProductReviewExchangesScheduledForDeletion->remove($this->netreviewsProductReviewExchangesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildNetreviewsProductReviewExchange $netreviewsProductReviewExchange The ChildNetreviewsProductReviewExchange object to add.
     */
    protected function doAddNetreviewsProductReviewExchange(ChildNetreviewsProductReviewExchange $netreviewsProductReviewExchange): void
    {
        $this->collNetreviewsProductReviewExchanges[]= $netreviewsProductReviewExchange;
        $netreviewsProductReviewExchange->setNetreviewsProductReview($this);
    }

    /**
     * @param ChildNetreviewsProductReviewExchange $netreviewsProductReviewExchange The ChildNetreviewsProductReviewExchange object to remove.
     * @return $this The current object (for fluent API support)
     */
    public function removeNetreviewsProductReviewExchange(ChildNetreviewsProductReviewExchange $netreviewsProductReviewExchange)
    {
        if ($this->getNetreviewsProductReviewExchanges()->contains($netreviewsProductReviewExchange)) {
            $pos = $this->collNetreviewsProductReviewExchanges->search($netreviewsProductReviewExchange);
            $this->collNetreviewsProductReviewExchanges->remove($pos);
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
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     *
     * @return $this
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

        return $this;
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param bool $deep Whether to also clear the references on all referrer objects.
     * @return $this
     */
    public function clearAllReferences(bool $deep = false)
    {
        if ($deep) {
            if ($this->collNetreviewsProductReviewExchanges) {
                foreach ($this->collNetreviewsProductReviewExchanges as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collNetreviewsProductReviewExchanges = null;
        return $this;
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
     * @return $this The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[NetreviewsProductReviewTableMap::COL_UPDATED_AT] = true;

        return $this;
    }

    /**
     * Code to be run before persisting the object
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new NetreviewsProductReviewEvent($this);

            $con->getEventDispatcher()
                ->dispatch(
                    $event,
                    NetreviewsProductReviewEvent::PRE_SAVE
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    new NetreviewsProductReviewEvent($this),
                    NetreviewsProductReviewEvent::POST_SAVE
                );
        }
    }

    /**
     * Code to be run before inserting to database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new NetreviewsProductReviewEvent($this);
            $con->getEventDispatcher()
                ->dispatch(
                    $event,
                    NetreviewsProductReviewEvent::PRE_INSERT
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    new NetreviewsProductReviewEvent($this),
                    NetreviewsProductReviewEvent::POST_INSERT
                );
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new NetreviewsProductReviewEvent($this);

            $con->getEventDispatcher()
                ->dispatch(
                    $event,
                    NetreviewsProductReviewEvent::PRE_UPDATE
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    new NetreviewsProductReviewEvent($this),
                    NetreviewsProductReviewEvent::POST_UPDATE
                );
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param ConnectionInterface|null $con
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $event = new NetreviewsProductReviewEvent($this);

            $con->getEventDispatcher()
                ->dispatch(
                    $event,
                    NetreviewsProductReviewEvent::PRE_DELETE
                );

            return !$event->isPropagationStopped();
        }

        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface|null $con
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {

        if (null !== $con
            && method_exists($con, 'getEventDispatcher')
            && null !== $con->getEventDispatcher()
        ) {
            $con->getEventDispatcher()
                ->dispatch(
                    new NetreviewsProductReviewEvent($this),
                    NetreviewsProductReviewEvent::POST_DELETE
                );
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed $params
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
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
