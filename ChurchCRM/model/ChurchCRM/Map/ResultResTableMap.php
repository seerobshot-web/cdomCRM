<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Map;

use ChurchCRM\model\ChurchCRM\ResultRes;
use ChurchCRM\model\ChurchCRM\ResultResQuery;
use Propel\Runtime\ActiveQuery\ColumnResolver\ColumnExpression\LocalColumnExpression;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Propel\Runtime\Propel;


/**
 * This class defines the structure of the 'result_res' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ResultResTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'ChurchCRM.model.ChurchCRM.Map.ResultResTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'result_res';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'ResultRes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\ChurchCRM\\model\\ChurchCRM\\ResultRes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'ChurchCRM.model.ChurchCRM.ResultRes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the res_ID field
     */
    public const COL_RES_ID = 'result_res.res_ID';

    /**
     * the column name for the res_echotype1 field
     */
    public const COL_RES_ECHOTYPE1 = 'result_res.res_echotype1';

    /**
     * the column name for the res_echotype2 field
     */
    public const COL_RES_ECHOTYPE2 = 'result_res.res_echotype2';

    /**
     * the column name for the res_echotype3 field
     */
    public const COL_RES_ECHOTYPE3 = 'result_res.res_echotype3';

    /**
     * the column name for the res_authorization field
     */
    public const COL_RES_AUTHORIZATION = 'result_res.res_authorization';

    /**
     * the column name for the res_order_number field
     */
    public const COL_RES_ORDER_NUMBER = 'result_res.res_order_number';

    /**
     * the column name for the res_reference field
     */
    public const COL_RES_REFERENCE = 'result_res.res_reference';

    /**
     * the column name for the res_status field
     */
    public const COL_RES_STATUS = 'result_res.res_status';

    /**
     * the column name for the res_avs_result field
     */
    public const COL_RES_AVS_RESULT = 'result_res.res_avs_result';

    /**
     * the column name for the res_security_result field
     */
    public const COL_RES_SECURITY_RESULT = 'result_res.res_security_result';

    /**
     * the column name for the res_mac field
     */
    public const COL_RES_MAC = 'result_res.res_mac';

    /**
     * the column name for the res_decline_code field
     */
    public const COL_RES_DECLINE_CODE = 'result_res.res_decline_code';

    /**
     * the column name for the res_tran_date field
     */
    public const COL_RES_TRAN_DATE = 'result_res.res_tran_date';

    /**
     * the column name for the res_merchant_name field
     */
    public const COL_RES_MERCHANT_NAME = 'result_res.res_merchant_name';

    /**
     * the column name for the res_version field
     */
    public const COL_RES_VERSION = 'result_res.res_version';

    /**
     * the column name for the res_EchoServer field
     */
    public const COL_RES_ECHOSERVER = 'result_res.res_EchoServer';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * @var class-string<\ChurchCRM\model\ChurchCRM\Base\Collection\ResultResCollection>
     */
    public const DEFAULT_OBJECT_COLLECTION = '\ChurchCRM\model\ChurchCRM\Base\Collection\ResultResCollection';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['ResId', 'ResEchotype1', 'ResEchotype2', 'ResEchotype3', 'ResAuthorization', 'ResOrderNumber', 'ResReference', 'ResStatus', 'ResAvsResult', 'ResSecurityResult', 'ResMac', 'ResDeclineCode', 'ResTranDate', 'ResMerchantName', 'ResVersion', 'ResEchoserver', ],
        self::TYPE_CAMELNAME     => ['resId', 'resEchotype1', 'resEchotype2', 'resEchotype3', 'resAuthorization', 'resOrderNumber', 'resReference', 'resStatus', 'resAvsResult', 'resSecurityResult', 'resMac', 'resDeclineCode', 'resTranDate', 'resMerchantName', 'resVersion', 'resEchoserver', ],
        self::TYPE_COLNAME       => [ResultResTableMap::COL_RES_ID, ResultResTableMap::COL_RES_ECHOTYPE1, ResultResTableMap::COL_RES_ECHOTYPE2, ResultResTableMap::COL_RES_ECHOTYPE3, ResultResTableMap::COL_RES_AUTHORIZATION, ResultResTableMap::COL_RES_ORDER_NUMBER, ResultResTableMap::COL_RES_REFERENCE, ResultResTableMap::COL_RES_STATUS, ResultResTableMap::COL_RES_AVS_RESULT, ResultResTableMap::COL_RES_SECURITY_RESULT, ResultResTableMap::COL_RES_MAC, ResultResTableMap::COL_RES_DECLINE_CODE, ResultResTableMap::COL_RES_TRAN_DATE, ResultResTableMap::COL_RES_MERCHANT_NAME, ResultResTableMap::COL_RES_VERSION, ResultResTableMap::COL_RES_ECHOSERVER, ],
        self::TYPE_FIELDNAME     => ['res_ID', 'res_echotype1', 'res_echotype2', 'res_echotype3', 'res_authorization', 'res_order_number', 'res_reference', 'res_status', 'res_avs_result', 'res_security_result', 'res_mac', 'res_decline_code', 'res_tran_date', 'res_merchant_name', 'res_version', 'res_EchoServer', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['ResId' => 0, 'ResEchotype1' => 1, 'ResEchotype2' => 2, 'ResEchotype3' => 3, 'ResAuthorization' => 4, 'ResOrderNumber' => 5, 'ResReference' => 6, 'ResStatus' => 7, 'ResAvsResult' => 8, 'ResSecurityResult' => 9, 'ResMac' => 10, 'ResDeclineCode' => 11, 'ResTranDate' => 12, 'ResMerchantName' => 13, 'ResVersion' => 14, 'ResEchoserver' => 15, ],
        self::TYPE_CAMELNAME     => ['resId' => 0, 'resEchotype1' => 1, 'resEchotype2' => 2, 'resEchotype3' => 3, 'resAuthorization' => 4, 'resOrderNumber' => 5, 'resReference' => 6, 'resStatus' => 7, 'resAvsResult' => 8, 'resSecurityResult' => 9, 'resMac' => 10, 'resDeclineCode' => 11, 'resTranDate' => 12, 'resMerchantName' => 13, 'resVersion' => 14, 'resEchoserver' => 15, ],
        self::TYPE_COLNAME       => [ResultResTableMap::COL_RES_ID => 0, ResultResTableMap::COL_RES_ECHOTYPE1 => 1, ResultResTableMap::COL_RES_ECHOTYPE2 => 2, ResultResTableMap::COL_RES_ECHOTYPE3 => 3, ResultResTableMap::COL_RES_AUTHORIZATION => 4, ResultResTableMap::COL_RES_ORDER_NUMBER => 5, ResultResTableMap::COL_RES_REFERENCE => 6, ResultResTableMap::COL_RES_STATUS => 7, ResultResTableMap::COL_RES_AVS_RESULT => 8, ResultResTableMap::COL_RES_SECURITY_RESULT => 9, ResultResTableMap::COL_RES_MAC => 10, ResultResTableMap::COL_RES_DECLINE_CODE => 11, ResultResTableMap::COL_RES_TRAN_DATE => 12, ResultResTableMap::COL_RES_MERCHANT_NAME => 13, ResultResTableMap::COL_RES_VERSION => 14, ResultResTableMap::COL_RES_ECHOSERVER => 15, ],
        self::TYPE_FIELDNAME     => ['res_ID' => 0, 'res_echotype1' => 1, 'res_echotype2' => 2, 'res_echotype3' => 3, 'res_authorization' => 4, 'res_order_number' => 5, 'res_reference' => 6, 'res_status' => 7, 'res_avs_result' => 8, 'res_security_result' => 9, 'res_mac' => 10, 'res_decline_code' => 11, 'res_tran_date' => 12, 'res_merchant_name' => 13, 'res_version' => 14, 'res_EchoServer' => 15, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string, string>
     */
    protected $normalizedColumnNameMap = [
        'ResId' => 'RES_ID',
        'ResultRes.ResId' => 'RES_ID',
        'resId' => 'RES_ID',
        'resultRes.resId' => 'RES_ID',
        'ResultResTableMap::COL_RES_ID' => 'RES_ID',
        'COL_RES_ID' => 'RES_ID',
        'res_ID' => 'RES_ID',
        'result_res.res_ID' => 'RES_ID',
        'ResEchotype1' => 'RES_ECHOTYPE1',
        'ResultRes.ResEchotype1' => 'RES_ECHOTYPE1',
        'resEchotype1' => 'RES_ECHOTYPE1',
        'resultRes.resEchotype1' => 'RES_ECHOTYPE1',
        'ResultResTableMap::COL_RES_ECHOTYPE1' => 'RES_ECHOTYPE1',
        'COL_RES_ECHOTYPE1' => 'RES_ECHOTYPE1',
        'res_echotype1' => 'RES_ECHOTYPE1',
        'result_res.res_echotype1' => 'RES_ECHOTYPE1',
        'ResEchotype2' => 'RES_ECHOTYPE2',
        'ResultRes.ResEchotype2' => 'RES_ECHOTYPE2',
        'resEchotype2' => 'RES_ECHOTYPE2',
        'resultRes.resEchotype2' => 'RES_ECHOTYPE2',
        'ResultResTableMap::COL_RES_ECHOTYPE2' => 'RES_ECHOTYPE2',
        'COL_RES_ECHOTYPE2' => 'RES_ECHOTYPE2',
        'res_echotype2' => 'RES_ECHOTYPE2',
        'result_res.res_echotype2' => 'RES_ECHOTYPE2',
        'ResEchotype3' => 'RES_ECHOTYPE3',
        'ResultRes.ResEchotype3' => 'RES_ECHOTYPE3',
        'resEchotype3' => 'RES_ECHOTYPE3',
        'resultRes.resEchotype3' => 'RES_ECHOTYPE3',
        'ResultResTableMap::COL_RES_ECHOTYPE3' => 'RES_ECHOTYPE3',
        'COL_RES_ECHOTYPE3' => 'RES_ECHOTYPE3',
        'res_echotype3' => 'RES_ECHOTYPE3',
        'result_res.res_echotype3' => 'RES_ECHOTYPE3',
        'ResAuthorization' => 'RES_AUTHORIZATION',
        'ResultRes.ResAuthorization' => 'RES_AUTHORIZATION',
        'resAuthorization' => 'RES_AUTHORIZATION',
        'resultRes.resAuthorization' => 'RES_AUTHORIZATION',
        'ResultResTableMap::COL_RES_AUTHORIZATION' => 'RES_AUTHORIZATION',
        'COL_RES_AUTHORIZATION' => 'RES_AUTHORIZATION',
        'res_authorization' => 'RES_AUTHORIZATION',
        'result_res.res_authorization' => 'RES_AUTHORIZATION',
        'ResOrderNumber' => 'RES_ORDER_NUMBER',
        'ResultRes.ResOrderNumber' => 'RES_ORDER_NUMBER',
        'resOrderNumber' => 'RES_ORDER_NUMBER',
        'resultRes.resOrderNumber' => 'RES_ORDER_NUMBER',
        'ResultResTableMap::COL_RES_ORDER_NUMBER' => 'RES_ORDER_NUMBER',
        'COL_RES_ORDER_NUMBER' => 'RES_ORDER_NUMBER',
        'res_order_number' => 'RES_ORDER_NUMBER',
        'result_res.res_order_number' => 'RES_ORDER_NUMBER',
        'ResReference' => 'RES_REFERENCE',
        'ResultRes.ResReference' => 'RES_REFERENCE',
        'resReference' => 'RES_REFERENCE',
        'resultRes.resReference' => 'RES_REFERENCE',
        'ResultResTableMap::COL_RES_REFERENCE' => 'RES_REFERENCE',
        'COL_RES_REFERENCE' => 'RES_REFERENCE',
        'res_reference' => 'RES_REFERENCE',
        'result_res.res_reference' => 'RES_REFERENCE',
        'ResStatus' => 'RES_STATUS',
        'ResultRes.ResStatus' => 'RES_STATUS',
        'resStatus' => 'RES_STATUS',
        'resultRes.resStatus' => 'RES_STATUS',
        'ResultResTableMap::COL_RES_STATUS' => 'RES_STATUS',
        'COL_RES_STATUS' => 'RES_STATUS',
        'res_status' => 'RES_STATUS',
        'result_res.res_status' => 'RES_STATUS',
        'ResAvsResult' => 'RES_AVS_RESULT',
        'ResultRes.ResAvsResult' => 'RES_AVS_RESULT',
        'resAvsResult' => 'RES_AVS_RESULT',
        'resultRes.resAvsResult' => 'RES_AVS_RESULT',
        'ResultResTableMap::COL_RES_AVS_RESULT' => 'RES_AVS_RESULT',
        'COL_RES_AVS_RESULT' => 'RES_AVS_RESULT',
        'res_avs_result' => 'RES_AVS_RESULT',
        'result_res.res_avs_result' => 'RES_AVS_RESULT',
        'ResSecurityResult' => 'RES_SECURITY_RESULT',
        'ResultRes.ResSecurityResult' => 'RES_SECURITY_RESULT',
        'resSecurityResult' => 'RES_SECURITY_RESULT',
        'resultRes.resSecurityResult' => 'RES_SECURITY_RESULT',
        'ResultResTableMap::COL_RES_SECURITY_RESULT' => 'RES_SECURITY_RESULT',
        'COL_RES_SECURITY_RESULT' => 'RES_SECURITY_RESULT',
        'res_security_result' => 'RES_SECURITY_RESULT',
        'result_res.res_security_result' => 'RES_SECURITY_RESULT',
        'ResMac' => 'RES_MAC',
        'ResultRes.ResMac' => 'RES_MAC',
        'resMac' => 'RES_MAC',
        'resultRes.resMac' => 'RES_MAC',
        'ResultResTableMap::COL_RES_MAC' => 'RES_MAC',
        'COL_RES_MAC' => 'RES_MAC',
        'res_mac' => 'RES_MAC',
        'result_res.res_mac' => 'RES_MAC',
        'ResDeclineCode' => 'RES_DECLINE_CODE',
        'ResultRes.ResDeclineCode' => 'RES_DECLINE_CODE',
        'resDeclineCode' => 'RES_DECLINE_CODE',
        'resultRes.resDeclineCode' => 'RES_DECLINE_CODE',
        'ResultResTableMap::COL_RES_DECLINE_CODE' => 'RES_DECLINE_CODE',
        'COL_RES_DECLINE_CODE' => 'RES_DECLINE_CODE',
        'res_decline_code' => 'RES_DECLINE_CODE',
        'result_res.res_decline_code' => 'RES_DECLINE_CODE',
        'ResTranDate' => 'RES_TRAN_DATE',
        'ResultRes.ResTranDate' => 'RES_TRAN_DATE',
        'resTranDate' => 'RES_TRAN_DATE',
        'resultRes.resTranDate' => 'RES_TRAN_DATE',
        'ResultResTableMap::COL_RES_TRAN_DATE' => 'RES_TRAN_DATE',
        'COL_RES_TRAN_DATE' => 'RES_TRAN_DATE',
        'res_tran_date' => 'RES_TRAN_DATE',
        'result_res.res_tran_date' => 'RES_TRAN_DATE',
        'ResMerchantName' => 'RES_MERCHANT_NAME',
        'ResultRes.ResMerchantName' => 'RES_MERCHANT_NAME',
        'resMerchantName' => 'RES_MERCHANT_NAME',
        'resultRes.resMerchantName' => 'RES_MERCHANT_NAME',
        'ResultResTableMap::COL_RES_MERCHANT_NAME' => 'RES_MERCHANT_NAME',
        'COL_RES_MERCHANT_NAME' => 'RES_MERCHANT_NAME',
        'res_merchant_name' => 'RES_MERCHANT_NAME',
        'result_res.res_merchant_name' => 'RES_MERCHANT_NAME',
        'ResVersion' => 'RES_VERSION',
        'ResultRes.ResVersion' => 'RES_VERSION',
        'resVersion' => 'RES_VERSION',
        'resultRes.resVersion' => 'RES_VERSION',
        'ResultResTableMap::COL_RES_VERSION' => 'RES_VERSION',
        'COL_RES_VERSION' => 'RES_VERSION',
        'res_version' => 'RES_VERSION',
        'result_res.res_version' => 'RES_VERSION',
        'ResEchoserver' => 'RES_ECHOSERVER',
        'ResultRes.ResEchoserver' => 'RES_ECHOSERVER',
        'resEchoserver' => 'RES_ECHOSERVER',
        'resultRes.resEchoserver' => 'RES_ECHOSERVER',
        'ResultResTableMap::COL_RES_ECHOSERVER' => 'RES_ECHOSERVER',
        'COL_RES_ECHOSERVER' => 'RES_ECHOSERVER',
        'res_EchoServer' => 'RES_ECHOSERVER',
        'result_res.res_EchoServer' => 'RES_ECHOSERVER',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('result_res');
        $this->setPhpName('ResultRes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ChurchCRM\\model\\ChurchCRM\\ResultRes');
        $this->setPackage('ChurchCRM.model.ChurchCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('res_ID', 'ResId', 'SMALLINT', true, 9, null);
        $this->addColumn('res_echotype1', 'ResEchotype1', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_echotype2', 'ResEchotype2', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_echotype3', 'ResEchotype3', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_authorization', 'ResAuthorization', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_order_number', 'ResOrderNumber', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_reference', 'ResReference', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_status', 'ResStatus', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_avs_result', 'ResAvsResult', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_security_result', 'ResSecurityResult', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_mac', 'ResMac', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_decline_code', 'ResDeclineCode', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_tran_date', 'ResTranDate', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_merchant_name', 'ResMerchantName', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_version', 'ResVersion', 'LONGVARCHAR', true, null, null);
        $this->addColumn('res_EchoServer', 'ResEchoserver', 'LONGVARCHAR', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)] === null || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string)$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.
     * For tables with a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        $resIdIx = $indexType === TableMap::TYPE_NUM
            ? 0 + $offset
            : self::translateFieldName('ResId', TableMap::TYPE_PHPNAME, $indexType);

        return (int)$row[$resIdIx];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     *
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? ResultResTableMap::CLASS_DEFAULT : ResultResTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
     *                           One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return array (ResultRes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = ResultResTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (($obj = ResultResTableMap::getInstanceFromPool($key)) !== null) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ResultResTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ResultResTableMap::OM_CLASS;
            /** @var ResultRes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ResultResTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param \Propel\Runtime\DataFetcher\DataFetcherInterface $dataFetcher
     *
     * @return array<object>
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ResultResTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (($obj = ResultResTableMap::getInstanceFromPool($key)) !== null) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new ResultRes();
                $obj->hydrate($row);
                $results[] = $obj;
                ResultResTableMap::addInstanceToPool($obj, $key);
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
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     *
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        $tableMap = static::getTableMap();
        $tableAlias = $alias ?: 'result_res';
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ECHOTYPE1']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ECHOTYPE2']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ECHOTYPE3']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_AUTHORIZATION']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ORDER_NUMBER']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_REFERENCE']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_STATUS']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_AVS_RESULT']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_SECURITY_RESULT']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_MAC']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_DECLINE_CODE']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_TRAN_DATE']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_MERCHANT_NAME']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_VERSION']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['RES_ECHOSERVER']));
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if ($alias === null) {
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ID);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ECHOTYPE1);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ECHOTYPE2);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ECHOTYPE3);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_AUTHORIZATION);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ORDER_NUMBER);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_REFERENCE);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_STATUS);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_AVS_RESULT);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_SECURITY_RESULT);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_MAC);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_DECLINE_CODE);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_TRAN_DATE);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_MERCHANT_NAME);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_VERSION);
            $criteria->removeSelectColumn(ResultResTableMap::COL_RES_ECHOSERVER);
        } else {
            $criteria->removeSelectColumn($alias . '.res_ID');
            $criteria->removeSelectColumn($alias . '.res_echotype1');
            $criteria->removeSelectColumn($alias . '.res_echotype2');
            $criteria->removeSelectColumn($alias . '.res_echotype3');
            $criteria->removeSelectColumn($alias . '.res_authorization');
            $criteria->removeSelectColumn($alias . '.res_order_number');
            $criteria->removeSelectColumn($alias . '.res_reference');
            $criteria->removeSelectColumn($alias . '.res_status');
            $criteria->removeSelectColumn($alias . '.res_avs_result');
            $criteria->removeSelectColumn($alias . '.res_security_result');
            $criteria->removeSelectColumn($alias . '.res_mac');
            $criteria->removeSelectColumn($alias . '.res_decline_code');
            $criteria->removeSelectColumn($alias . '.res_tran_date');
            $criteria->removeSelectColumn($alias . '.res_merchant_name');
            $criteria->removeSelectColumn($alias . '.res_version');
            $criteria->removeSelectColumn($alias . '.res_EchoServer');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     *
     * @return static
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(ResultResTableMap::DATABASE_NAME)->getTable(ResultResTableMap::TABLE_NAME);
    }

    /**
     * @deprecated Delete via model or ResultResQuery.
     *
     * Performs a DELETE on the database, given a ResultRes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or ResultRes object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return int The number of affected rows (if supported by underlying database driver). This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     */
    public static function doDelete($values, ?ConnectionInterface $con = null): int
    {
        trigger_deprecation('Propel', '2.0', 'TableMap::doDelete() should not be used anymore, delete via model or ResultResQuery');

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            $criteria = $values;
        } elseif ($values instanceof ResultRes) { // it's a model object
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ResultResTableMap::DATABASE_NAME);
            $criteria->addAnd(ResultResTableMap::COL_RES_ID, (array)$values, Criteria::IN);
        }

        $query = ResultResQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ResultResTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array)$values as $singleval) {
                ResultResTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the result_res table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return ResultResQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ResultRes or Criteria object.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria|\ChurchCRM\model\ChurchCRM\ResultRes $criteria
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     *
     * @return mixed The new primary key.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
            $criteria->turnFiltersToUpdateValues();
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ResultRes object
        }

        if ($criteria->hasUpdateValue(ResultResTableMap::COL_RES_ID)) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (ResultResTableMap::COL_RES_ID)');
        }

        // Set the correct dbName
        $query = ResultResQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }
}
