<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Base;

use ChurchCRM\model\ChurchCRM\Map\ResultResTableMap;
use ChurchCRM\model\ChurchCRM\ResultResQuery as ChildResultResQuery;
use Exception;
use PDO;
use Propel\Runtime\ActiveQuery\ColumnResolver\ColumnExpression\LocalColumnExpression;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Propel;
use ReflectionClass;
use ReflectionProperty;
use RuntimeException;

/**
 * Base class that represents a row from the 'result_res' table.
 *
 * contains the results of authorizations from electronic payments
 *
 * @package propel.generator.ChurchCRM.model.ChurchCRM.Base
 */
abstract class ResultRes implements ActiveRecordInterface
{
    /**
     * TableMap class name
     *
     * @var string
     */
    public const TABLE_MAP = '\\ChurchCRM\\model\\ChurchCRM\\Map\\ResultResTableMap';

    /**
     * attribute to determine if this object has previously been saved.
     */
    protected bool $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     */
    protected bool $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     *
     * @var array<string, bool>
     */
    protected array $modifiedColumns = [];

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     *
     * @var array<string, mixed>
     */
    protected array $virtualColumns = [];

    /**
     * The value for the res_id field.
     */
    protected int|null $res_id = null;

    /**
     * The value for the res_echotype1 field.
     */
    protected string|null $res_echotype1 = null;

    /**
     * The value for the res_echotype2 field.
     */
    protected string|null $res_echotype2 = null;

    /**
     * The value for the res_echotype3 field.
     */
    protected string|null $res_echotype3 = null;

    /**
     * The value for the res_authorization field.
     */
    protected string|null $res_authorization = null;

    /**
     * The value for the res_order_number field.
     */
    protected string|null $res_order_number = null;

    /**
     * The value for the res_reference field.
     */
    protected string|null $res_reference = null;

    /**
     * The value for the res_status field.
     */
    protected string|null $res_status = null;

    /**
     * The value for the res_avs_result field.
     */
    protected string|null $res_avs_result = null;

    /**
     * The value for the res_security_result field.
     */
    protected string|null $res_security_result = null;

    /**
     * The value for the res_mac field.
     */
    protected string|null $res_mac = null;

    /**
     * The value for the res_decline_code field.
     */
    protected string|null $res_decline_code = null;

    /**
     * The value for the res_tran_date field.
     */
    protected string|null $res_tran_date = null;

    /**
     * The value for the res_merchant_name field.
     */
    protected string|null $res_merchant_name = null;

    /**
     * The value for the res_version field.
     */
    protected string|null $res_version = null;

    /**
     * The value for the res_echoserver field.
     */
    protected string|null $res_echoserver = null;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     */
    protected bool $alreadyInSave = false;

    /**
     * Initializes internal state of ChurchCRM\model\ChurchCRM\Base\ResultRes object.
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
        return (bool)$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param string $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     *
     * @return bool True if $col has been modified.
     */
    public function isColumnModified(string $col): bool
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     *
     * @return array<string> A unique list of the modified column names for this object.
     */
    public function getModifiedColumns(): array
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved. This will
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
     * Setter for the isNew attribute.
     *
     * Called by Propel-generated children and objects.
     *
     * @param bool $b the state of the object.
     *
     * @return void
     */
    public function setNew(bool $b): void
    {
        $this->new = $b;
    }

    /**
     * Whether this object has been deleted.
     *
     * @return bool The deleted state of this object.
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     *
     * @param bool $b The deleted state of this object.
     *
     * @return void
     */
    public function setDeleted(bool $b): void
    {
        $this->deleted = $b;
    }

    /**
     * Sets the modified state for the object to be false.
     *
     * @param string|null $col If supplied, only the specified column is reset.
     *
     * @return void
     */
    public function resetModified(?string $col = null): void
    {
        if ($col !== null) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = [];
        }
    }

    /**
     * Compares this with another <code>ResultRes</code> instance. If
     * <code>obj</code> is an instance of <code>ResultRes</code>, delegates to
     * <code>equals(ResultRes)</code>. Otherwise, returns <code>false</code>.
     *
     * @param mixed $obj The object to compare to.
     *
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
        if ($this->getPrimaryKey() === null || $obj->getPrimaryKey() === null) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array<mixed>
     */
    public function getVirtualColumns(): array
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param string $name The virtual column name
     *
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
     *
     * @return mixed
     */
    public function getVirtualColumn(string $name)
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
     * @return $this
     */
    public function setVirtualColumn(string $name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param string $msg
     * @param int $priority One of the Propel::LOG_* logging levels
     *
     * @return void
     */
    protected function log(string $msg, int $priority = Propel::LOG_INFO): void
    {
        Propel::log(static::class . ': ' . $msg, $priority);
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
     *
     * @return string The exported data
     */
    public function exportTo($parser, bool $includeLazyLoadColumns = true, string $keyType = TableMap::TYPE_PHPNAME): string
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns));
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

        $cls = new ReflectionClass($this);
        $staticProperties = $cls->getProperties(ReflectionProperty::IS_STATIC);
        $properties = $cls->getProperties();
        $serializableProperties = array_diff($properties, $staticProperties);

        $propertyNames = [];
        foreach ($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [res_id] column value.
     *
     * @return int|null
     */
    public function getResId()
    {
        return $this->res_id;
    }

    /**
     * Get the [res_echotype1] column value.
     *
     * @return string|null
     */
    public function getResEchotype1()
    {
        return $this->res_echotype1;
    }

    /**
     * Get the [res_echotype2] column value.
     *
     * @return string|null
     */
    public function getResEchotype2()
    {
        return $this->res_echotype2;
    }

    /**
     * Get the [res_echotype3] column value.
     *
     * @return string|null
     */
    public function getResEchotype3()
    {
        return $this->res_echotype3;
    }

    /**
     * Get the [res_authorization] column value.
     *
     * @return string|null
     */
    public function getResAuthorization()
    {
        return $this->res_authorization;
    }

    /**
     * Get the [res_order_number] column value.
     *
     * @return string|null
     */
    public function getResOrderNumber()
    {
        return $this->res_order_number;
    }

    /**
     * Get the [res_reference] column value.
     *
     * @return string|null
     */
    public function getResReference()
    {
        return $this->res_reference;
    }

    /**
     * Get the [res_status] column value.
     *
     * @return string|null
     */
    public function getResStatus()
    {
        return $this->res_status;
    }

    /**
     * Get the [res_avs_result] column value.
     *
     * @return string|null
     */
    public function getResAvsResult()
    {
        return $this->res_avs_result;
    }

    /**
     * Get the [res_security_result] column value.
     *
     * @return string|null
     */
    public function getResSecurityResult()
    {
        return $this->res_security_result;
    }

    /**
     * Get the [res_mac] column value.
     *
     * @return string|null
     */
    public function getResMac()
    {
        return $this->res_mac;
    }

    /**
     * Get the [res_decline_code] column value.
     *
     * @return string|null
     */
    public function getResDeclineCode()
    {
        return $this->res_decline_code;
    }

    /**
     * Get the [res_tran_date] column value.
     *
     * @return string|null
     */
    public function getResTranDate()
    {
        return $this->res_tran_date;
    }

    /**
     * Get the [res_merchant_name] column value.
     *
     * @return string|null
     */
    public function getResMerchantName()
    {
        return $this->res_merchant_name;
    }

    /**
     * Get the [res_version] column value.
     *
     * @return string|null
     */
    public function getResVersion()
    {
        return $this->res_version;
    }

    /**
     * Get the [res_echoserver] column value.
     *
     * @return string|null
     */
    public function getResEchoserver()
    {
        return $this->res_echoserver;
    }

    /**
     * Set the value of [res_id] column.
     *
     * @param int|null $v New value
     *
     * @return $this
     */
    public function setResId($v)
    {
        if ($v !== null) {
            $v = (int)$v;
        }

        if ($this->res_id !== $v) {
            $this->res_id = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ID] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_echotype1] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResEchotype1($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_echotype1 !== $v) {
            $this->res_echotype1 = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ECHOTYPE1] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_echotype2] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResEchotype2($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_echotype2 !== $v) {
            $this->res_echotype2 = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ECHOTYPE2] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_echotype3] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResEchotype3($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_echotype3 !== $v) {
            $this->res_echotype3 = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ECHOTYPE3] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_authorization] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResAuthorization($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_authorization !== $v) {
            $this->res_authorization = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_AUTHORIZATION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_order_number] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResOrderNumber($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_order_number !== $v) {
            $this->res_order_number = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ORDER_NUMBER] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_reference] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResReference($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_reference !== $v) {
            $this->res_reference = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_REFERENCE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_status] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResStatus($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_status !== $v) {
            $this->res_status = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_STATUS] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_avs_result] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResAvsResult($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_avs_result !== $v) {
            $this->res_avs_result = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_AVS_RESULT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_security_result] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResSecurityResult($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_security_result !== $v) {
            $this->res_security_result = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_SECURITY_RESULT] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_mac] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResMac($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_mac !== $v) {
            $this->res_mac = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_MAC] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_decline_code] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResDeclineCode($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_decline_code !== $v) {
            $this->res_decline_code = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_DECLINE_CODE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_tran_date] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResTranDate($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_tran_date !== $v) {
            $this->res_tran_date = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_TRAN_DATE] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_merchant_name] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResMerchantName($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_merchant_name !== $v) {
            $this->res_merchant_name = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_MERCHANT_NAME] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_version] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResVersion($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_version !== $v) {
            $this->res_version = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_VERSION] = true;
        }

        return $this;
    }

    /**
     * Set the value of [res_echoserver] column.
     *
     * @param string|null $v New value
     *
     * @return $this
     */
    public function setResEchoserver($v)
    {
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->res_echoserver !== $v) {
            $this->res_echoserver = $v;
            $this->modifiedColumns[ResultResTableMap::COL_RES_ECHOSERVER] = true;
        }

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
        return true;
    }

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows. This is needed, for example,
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
     * @throws \Propel\Runtime\Exception\PropelException - Any caught Exception will be rewrapped as a PropelException.
     *
     * @return int next starting column
     */
    public function hydrate(array $row, int $startcol = 0, bool $rehydrate = false, string $indexType = TableMap::TYPE_NUM): int
    {
        try {
            $useNumericIndex = $indexType === TableMap::TYPE_NUM;

            $rowIndex = $useNumericIndex ? $startcol + 0 : ResultResTableMap::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_id = $columnValue !== null ? (int)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 1 : ResultResTableMap::translateFieldName('ResEchotype1', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_echotype1 = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 2 : ResultResTableMap::translateFieldName('ResEchotype2', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_echotype2 = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 3 : ResultResTableMap::translateFieldName('ResEchotype3', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_echotype3 = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 4 : ResultResTableMap::translateFieldName('ResAuthorization', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_authorization = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 5 : ResultResTableMap::translateFieldName('ResOrderNumber', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_order_number = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 6 : ResultResTableMap::translateFieldName('ResReference', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_reference = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 7 : ResultResTableMap::translateFieldName('ResStatus', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_status = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 8 : ResultResTableMap::translateFieldName('ResAvsResult', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_avs_result = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 9 : ResultResTableMap::translateFieldName('ResSecurityResult', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_security_result = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 10 : ResultResTableMap::translateFieldName('ResMac', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_mac = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 11 : ResultResTableMap::translateFieldName('ResDeclineCode', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_decline_code = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 12 : ResultResTableMap::translateFieldName('ResTranDate', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_tran_date = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 13 : ResultResTableMap::translateFieldName('ResMerchantName', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_merchant_name = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 14 : ResultResTableMap::translateFieldName('ResVersion', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_version = $columnValue !== null ? (string)$columnValue : null;

            $rowIndex = $useNumericIndex ? $startcol + 15 : ResultResTableMap::translateFieldName('ResEchoserver', TableMap::TYPE_PHPNAME, $indexType);
            $columnValue = $row[$rowIndex];
            $this->res_echoserver = $columnValue !== null ? (string)$columnValue : null;

            $this->resetModified();
            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16;
        } catch (Exception $e) {
            throw new PropelException('Error populating \ChurchCRM\model\ChurchCRM\ResultRes object', 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database. It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
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
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con (optional) The ConnectionInterface connection to use.
     *
     * @throws \Propel\Runtime\Exception\PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     *
     * @return void
     */
    public function reload(bool $deep = false, ?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException('Cannot reload a deleted object.');
        }

        if ($this->isNew()) {
            throw new PropelException('Cannot reload an unsaved object.');
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ResultResTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildResultResQuery::create(null, $this->buildPkeyCriteria())->fetch($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row || $row === true) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) { // also de-associate any related objects?
        }
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @see ResultRes::setDeleted()
     * @see ResultRes::isDeleted()
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function delete(?ConnectionInterface $con = null): void
    {
        if ($this->isDeleted()) {
            throw new PropelException('This object has already been deleted.');
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildResultResQuery::create()
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
     * method. This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     */
    public function save(?ConnectionInterface $con = null): int
    {
        if ($this->isDeleted()) {
            throw new PropelException('You cannot save an object that has been deleted.');
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ResultResTableMap::addInstanceToPool($this);
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
     * @see static::save()
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int The number of rows affected by this insert/update and any referring fk objects' save() operations.
     */
    protected function doSave(ConnectionInterface $con): int
    {
        if ($this->alreadyInSave) {
            return 0;
        }

        $affectedRows = 0; // initialize var to track total num of affected rows
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

        $this->alreadyInSave = false;

        return $affectedRows;
    }

    /**
     * Insert the row in the database.
     *
     * @see static::doSave()
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @throws \RuntimeException
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    protected function doInsert(ConnectionInterface $con): void
    {
        $modifiedColumns = [];
        $index = 0;
        $this->modifiedColumns[ResultResTableMap::COL_RES_ID] = true;
        if ($this->res_id !== null) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ResultResTableMap::COL_RES_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ID)) {
            $modifiedColumns[':p' . $index++] = 'res_ID';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE1)) {
            $modifiedColumns[':p' . $index++] = 'res_echotype1';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE2)) {
            $modifiedColumns[':p' . $index++] = 'res_echotype2';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE3)) {
            $modifiedColumns[':p' . $index++] = 'res_echotype3';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_AUTHORIZATION)) {
            $modifiedColumns[':p' . $index++] = 'res_authorization';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ORDER_NUMBER)) {
            $modifiedColumns[':p' . $index++] = 'res_order_number';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_REFERENCE)) {
            $modifiedColumns[':p' . $index++] = 'res_reference';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_STATUS)) {
            $modifiedColumns[':p' . $index++] = 'res_status';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_AVS_RESULT)) {
            $modifiedColumns[':p' . $index++] = 'res_avs_result';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_SECURITY_RESULT)) {
            $modifiedColumns[':p' . $index++] = 'res_security_result';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_MAC)) {
            $modifiedColumns[':p' . $index++] = 'res_mac';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_DECLINE_CODE)) {
            $modifiedColumns[':p' . $index++] = 'res_decline_code';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_TRAN_DATE)) {
            $modifiedColumns[':p' . $index++] = 'res_tran_date';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_MERCHANT_NAME)) {
            $modifiedColumns[':p' . $index++] = 'res_merchant_name';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_VERSION)) {
            $modifiedColumns[':p' . $index++] = 'res_version';
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOSERVER)) {
            $modifiedColumns[':p' . $index++] = 'res_EchoServer';
        }

        $sql = sprintf(
            'INSERT INTO result_res (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns)),
        );

        try {
            $stmt = $con->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException("Failed to build PreparedStatement for SQL '$sql'");
            }
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'res_ID':
                        $stmt->bindValue($identifier, $this->res_id, PDO::PARAM_INT);

                        break;
                    case 'res_echotype1':
                        $stmt->bindValue($identifier, $this->res_echotype1, PDO::PARAM_STR);

                        break;
                    case 'res_echotype2':
                        $stmt->bindValue($identifier, $this->res_echotype2, PDO::PARAM_STR);

                        break;
                    case 'res_echotype3':
                        $stmt->bindValue($identifier, $this->res_echotype3, PDO::PARAM_STR);

                        break;
                    case 'res_authorization':
                        $stmt->bindValue($identifier, $this->res_authorization, PDO::PARAM_STR);

                        break;
                    case 'res_order_number':
                        $stmt->bindValue($identifier, $this->res_order_number, PDO::PARAM_STR);

                        break;
                    case 'res_reference':
                        $stmt->bindValue($identifier, $this->res_reference, PDO::PARAM_STR);

                        break;
                    case 'res_status':
                        $stmt->bindValue($identifier, $this->res_status, PDO::PARAM_STR);

                        break;
                    case 'res_avs_result':
                        $stmt->bindValue($identifier, $this->res_avs_result, PDO::PARAM_STR);

                        break;
                    case 'res_security_result':
                        $stmt->bindValue($identifier, $this->res_security_result, PDO::PARAM_STR);

                        break;
                    case 'res_mac':
                        $stmt->bindValue($identifier, $this->res_mac, PDO::PARAM_STR);

                        break;
                    case 'res_decline_code':
                        $stmt->bindValue($identifier, $this->res_decline_code, PDO::PARAM_STR);

                        break;
                    case 'res_tran_date':
                        $stmt->bindValue($identifier, $this->res_tran_date, PDO::PARAM_STR);

                        break;
                    case 'res_merchant_name':
                        $stmt->bindValue($identifier, $this->res_merchant_name, PDO::PARAM_STR);

                        break;
                    case 'res_version':
                        $stmt->bindValue($identifier, $this->res_version, PDO::PARAM_STR);

                        break;
                    case 'res_EchoServer':
                        $stmt->bindValue($identifier, $this->res_echoserver, PDO::PARAM_STR);

                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);

            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setResId((int)$pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @see static::doSave()
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface $con
     *
     * @return int Number of updated rows
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
     *
     * @return mixed Value of field.
     */
    public function getByName(string $name, string $type = TableMap::TYPE_PHPNAME)
    {
        /** @var int $pos */
        $pos = ResultResTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->getByPosition($pos);
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos Position in XML schema
     *
     * @return mixed Value of field at $pos
     */
    public function getByPosition(int $pos)
    {
        return match ($pos) {
            0 => $this->getResId(),
            1 => $this->getResEchotype1(),
            2 => $this->getResEchotype2(),
            3 => $this->getResEchotype3(),
            4 => $this->getResAuthorization(),
            5 => $this->getResOrderNumber(),
            6 => $this->getResReference(),
            7 => $this->getResStatus(),
            8 => $this->getResAvsResult(),
            9 => $this->getResSecurityResult(),
            10 => $this->getResMac(),
            11 => $this->getResDeclineCode(),
            12 => $this->getResTranDate(),
            13 => $this->getResMerchantName(),
            14 => $this->getResVersion(),
            15 => $this->getResEchoserver(),
            default => null
        };
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
     * @param array<string, array<string|bool>> $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array<mixed> An associative array containing the field names (as keys) and field values
     */
    public function toArray(
        string $keyType = TableMap::TYPE_PHPNAME,
        bool $includeLazyLoadColumns = true,
        array $alreadyDumpedObjects = []
    ): array {
        if (isset($alreadyDumpedObjects['ResultRes'][$this->hashCode()])) {
            return ['*RECURSION*'];
        }
        $alreadyDumpedObjects['ResultRes'][$this->hashCode()] = true;
        $keys = ResultResTableMap::getFieldNames($keyType);
        $result = [
            $keys[0] => $this->getResId(),
            $keys[1] => $this->getResEchotype1(),
            $keys[2] => $this->getResEchotype2(),
            $keys[3] => $this->getResEchotype3(),
            $keys[4] => $this->getResAuthorization(),
            $keys[5] => $this->getResOrderNumber(),
            $keys[6] => $this->getResReference(),
            $keys[7] => $this->getResStatus(),
            $keys[8] => $this->getResAvsResult(),
            $keys[9] => $this->getResSecurityResult(),
            $keys[10] => $this->getResMac(),
            $keys[11] => $this->getResDeclineCode(),
            $keys[12] => $this->getResTranDate(),
            $keys[13] => $this->getResMerchantName(),
            $keys[14] => $this->getResVersion(),
            $keys[15] => $this->getResEchoserver(),
        ];
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
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
     *
     * @return $this
     */
    public function setByName(string $name, $value, string $type = TableMap::TYPE_PHPNAME)
    {
        /** @var int $pos */
        $pos = ResultResTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        $this->setByPosition($pos, $value);

        return $this;
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     *
     * @return $this
     */
    public function setByPosition(int $pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setResId($value);

                break;
            case 1:
                $this->setResEchotype1($value);

                break;
            case 2:
                $this->setResEchotype2($value);

                break;
            case 3:
                $this->setResEchotype3($value);

                break;
            case 4:
                $this->setResAuthorization($value);

                break;
            case 5:
                $this->setResOrderNumber($value);

                break;
            case 6:
                $this->setResReference($value);

                break;
            case 7:
                $this->setResStatus($value);

                break;
            case 8:
                $this->setResAvsResult($value);

                break;
            case 9:
                $this->setResSecurityResult($value);

                break;
            case 10:
                $this->setResMac($value);

                break;
            case 11:
                $this->setResDeclineCode($value);

                break;
            case 12:
                $this->setResTranDate($value);

                break;
            case 13:
                $this->setResMerchantName($value);

                break;
            case 14:
                $this->setResVersion($value);

                break;
            case 15:
                $this->setResEchoserver($value);

                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST). This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param array<mixed> $arr An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this
     */
    public function fromArray(array $arr, string $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ResultResTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setResId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setResEchotype1($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setResEchotype2($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setResEchotype3($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setResAuthorization($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setResOrderNumber($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setResReference($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setResStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setResAvsResult($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setResSecurityResult($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setResMac($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setResDeclineCode($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setResTranDate($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setResMerchantName($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setResVersion($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setResEchoserver($arr[$keys[15]]);
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
     * @param mixed $parser A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this
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
        $tableMap = ResultResTableMap::getTableMap();
        $criteria = new Criteria(ResultResTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ResultResTableMap::COL_RES_ID)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_ID'), $this->res_id);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE1)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_echotype1'), $this->res_echotype1);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE2)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_echotype2'), $this->res_echotype2);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOTYPE3)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_echotype3'), $this->res_echotype3);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_AUTHORIZATION)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_authorization'), $this->res_authorization);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ORDER_NUMBER)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_order_number'), $this->res_order_number);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_REFERENCE)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_reference'), $this->res_reference);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_STATUS)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_status'), $this->res_status);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_AVS_RESULT)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_avs_result'), $this->res_avs_result);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_SECURITY_RESULT)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_security_result'), $this->res_security_result);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_MAC)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_mac'), $this->res_mac);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_DECLINE_CODE)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_decline_code'), $this->res_decline_code);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_TRAN_DATE)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_tran_date'), $this->res_tran_date);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_MERCHANT_NAME)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_merchant_name'), $this->res_merchant_name);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_VERSION)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_version'), $this->res_version);
        }
        if ($this->isColumnModified(ResultResTableMap::COL_RES_ECHOSERVER)) {
            $criteria->setUpdateValue($tableMap->getColumn('res_EchoServer'), $this->res_echoserver);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether they have been modified.
     *
     * @return \Propel\Runtime\ActiveQuery\Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria(): Criteria
    {
        $tableMap = ResultResTableMap::getTableMap();
        $query = ChildResultResQuery::create();
        $res_IDColumn = new LocalColumnExpression($query, $tableMap->getName(), $tableMap->getColumn('res_ID'));
        $query->addAnd($res_IDColumn, $this->res_id);

        return $query;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @throws \RuntimeException
     *
     * @return string|int Hashcode
     */
    public function hashCode()
    {
        $pkIsValid = $this->getResId() !== null;

        if ($pkIsValid) {
            $json = json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE);
            if ($json === false) {
                throw new RuntimeException('Failed to encode PK as JSON.');
            }

            return crc32($json);
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     *
     * @return int|null
     */
    public function getPrimaryKey()
    {
        return $this->getResId();
    }

    /**
     * Generic method to set the primary key (res_id column).
     *
     * @param int|null $key Primary key.
     *
     * @return void
     */
    public function setPrimaryKey(?int $key = null): void
    {
        $this->setResId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     *
     * @return bool
     */
    public function isPrimaryKeyNull(): bool
    {
        return $this->getResId() === null;
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of \ChurchCRM\model\ChurchCRM\ResultRes (or compatible) type.
     * @param bool $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param bool $makeNew Whether to reset autoincrement PKs and make the object new.
     *
     * @return void
     */
    public function copyInto(object $copyObj, bool $deepCopy = false, bool $makeNew = true): void
    {
        $copyObj->setResEchotype1($this->getResEchotype1());
        $copyObj->setResEchotype2($this->getResEchotype2());
        $copyObj->setResEchotype3($this->getResEchotype3());
        $copyObj->setResAuthorization($this->getResAuthorization());
        $copyObj->setResOrderNumber($this->getResOrderNumber());
        $copyObj->setResReference($this->getResReference());
        $copyObj->setResStatus($this->getResStatus());
        $copyObj->setResAvsResult($this->getResAvsResult());
        $copyObj->setResSecurityResult($this->getResSecurityResult());
        $copyObj->setResMac($this->getResMac());
        $copyObj->setResDeclineCode($this->getResDeclineCode());
        $copyObj->setResTranDate($this->getResTranDate());
        $copyObj->setResMerchantName($this->getResMerchantName());
        $copyObj->setResVersion($this->getResVersion());
        $copyObj->setResEchoserver($this->getResEchoserver());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setResId(null); // this is a auto-increment column, so set to default value
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
     *
     * @return static Clone of current object.
     */
    public function copy(bool $deepCopy = false)
    {
        $clazz = static::class;
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
     *
     * @return void
     */
    public function initRelation($relationName): void
    {
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
        $this->res_id = null;
        $this->res_echotype1 = null;
        $this->res_echotype2 = null;
        $this->res_echotype3 = null;
        $this->res_authorization = null;
        $this->res_order_number = null;
        $this->res_reference = null;
        $this->res_status = null;
        $this->res_avs_result = null;
        $this->res_security_result = null;
        $this->res_mac = null;
        $this->res_decline_code = null;
        $this->res_tran_date = null;
        $this->res_merchant_name = null;
        $this->res_version = null;
        $this->res_echoserver = null;
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
     *
     * @return static
     */
    public function clearAllReferences(bool $deep = false): static
    {
        return $this;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->exportTo(ResultResTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return bool
     */
    public function preSave(?ConnectionInterface $con = null): bool
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postSave(?ConnectionInterface $con = null): void
    {
    }

    /**
     * Code to be run before inserting to database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return bool
     */
    public function preInsert(?ConnectionInterface $con = null): bool
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postInsert(?ConnectionInterface $con = null): void
    {
    }

    /**
     * Code to be run before updating the object in database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return bool
     */
    public function preUpdate(?ConnectionInterface $con = null): bool
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postUpdate(?ConnectionInterface $con = null): void
    {
    }

    /**
     * Code to be run before deleting the object in database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return bool
     */
    public function preDelete(?ConnectionInterface $con = null): bool
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @return void
     */
    public function postDelete(?ConnectionInterface $con = null): void
    {
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
     * @throws \Propel\Runtime\Exception\BadMethodCallException
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (strpos($name, 'get') === 0) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (strpos($name, 'from') === 0) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (strpos($name, 'to') === 0) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }
}
