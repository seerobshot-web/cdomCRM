<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Base;

use ChurchCRM\model\ChurchCRM\Map\ResultResTableMap;
use ChurchCRM\model\ChurchCRM\ResultRes as ChildResultRes;
use ChurchCRM\model\ChurchCRM\ResultResQuery as ChildResultResQuery;
use Exception;
use PDO;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\TypedModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * Base class that represents a query for the `result_res` table.
 *
 * contains the results of authorizations from electronic payments
 *
 * @method static orderByResId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_ID column
 * @method static orderByResEchotype1($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_echotype1 column
 * @method static orderByResEchotype2($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_echotype2 column
 * @method static orderByResEchotype3($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_echotype3 column
 * @method static orderByResAuthorization($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_authorization column
 * @method static orderByResOrderNumber($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_order_number column
 * @method static orderByResReference($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_reference column
 * @method static orderByResStatus($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_status column
 * @method static orderByResAvsResult($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_avs_result column
 * @method static orderByResSecurityResult($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_security_result column
 * @method static orderByResMac($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_mac column
 * @method static orderByResDeclineCode($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_decline_code column
 * @method static orderByResTranDate($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_tran_date column
 * @method static orderByResMerchantName($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_merchant_name column
 * @method static orderByResVersion($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_version column
 * @method static orderByResEchoserver($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the res_EchoServer column
 *
 * @method static groupByResId() Group by the res_ID column
 * @method static groupByResEchotype1() Group by the res_echotype1 column
 * @method static groupByResEchotype2() Group by the res_echotype2 column
 * @method static groupByResEchotype3() Group by the res_echotype3 column
 * @method static groupByResAuthorization() Group by the res_authorization column
 * @method static groupByResOrderNumber() Group by the res_order_number column
 * @method static groupByResReference() Group by the res_reference column
 * @method static groupByResStatus() Group by the res_status column
 * @method static groupByResAvsResult() Group by the res_avs_result column
 * @method static groupByResSecurityResult() Group by the res_security_result column
 * @method static groupByResMac() Group by the res_mac column
 * @method static groupByResDeclineCode() Group by the res_decline_code column
 * @method static groupByResTranDate() Group by the res_tran_date column
 * @method static groupByResMerchantName() Group by the res_merchant_name column
 * @method static groupByResVersion() Group by the res_version column
 * @method static groupByResEchoserver() Group by the res_EchoServer column
 *
 * @method static leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method static rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method static innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method static leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method static rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method static innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\ResultRes matching the query
 * @method \ChurchCRM\model\ChurchCRM\ResultRes findOneOrCreate(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\ResultRes matching the query, or a new \ChurchCRM\model\ChurchCRM\ResultRes object populated from the query conditions when no match is found
 *
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResId(int $res_ID) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_ID column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResEchotype1(string $res_echotype1) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype1 column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResEchotype2(string $res_echotype2) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype2 column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResEchotype3(string $res_echotype3) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype3 column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResAuthorization(string $res_authorization) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_authorization column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResOrderNumber(string $res_order_number) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_order_number column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResReference(string $res_reference) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_reference column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResStatus(string $res_status) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_status column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResAvsResult(string $res_avs_result) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_avs_result column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResSecurityResult(string $res_security_result) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_security_result column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResMac(string $res_mac) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_mac column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResDeclineCode(string $res_decline_code) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_decline_code column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResTranDate(string $res_tran_date) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_tran_date column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResMerchantName(string $res_merchant_name) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_merchant_name column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResVersion(string $res_version) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_version column
 * @method \ChurchCRM\model\ChurchCRM\ResultRes|null findOneByResEchoserver(string $res_EchoServer) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_EchoServer column
 *
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requirePk($key, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the \ChurchCRM\model\ChurchCRM\ResultRes by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\ResultRes matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResId(int $res_ID) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_ID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResEchotype1(string $res_echotype1) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResEchotype2(string $res_echotype2) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResEchotype3(string $res_echotype3) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_echotype3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResAuthorization(string $res_authorization) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_authorization column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResOrderNumber(string $res_order_number) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_order_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResReference(string $res_reference) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResStatus(string $res_status) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResAvsResult(string $res_avs_result) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_avs_result column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResSecurityResult(string $res_security_result) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_security_result column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResMac(string $res_mac) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_mac column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResDeclineCode(string $res_decline_code) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_decline_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResTranDate(string $res_tran_date) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_tran_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResMerchantName(string $res_merchant_name) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_merchant_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResVersion(string $res_version) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_version column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\ResultRes requireOneByResEchoserver(string $res_EchoServer) Return the first \ChurchCRM\model\ChurchCRM\ResultRes filtered by the res_EchoServer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\ResultResCollection|array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> find(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return \ChurchCRM\model\ChurchCRM\ResultRes objects based on current ModelCriteria
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\ResultResCollection findObjects(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Get \ChurchCRM\model\ChurchCRM\ResultRes objects in ObjectCollection
 *
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResId(int|array<int> $res_ID) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_ID column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResEchotype1(string|array<string> $res_echotype1) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_echotype1 column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResEchotype2(string|array<string> $res_echotype2) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_echotype2 column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResEchotype3(string|array<string> $res_echotype3) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_echotype3 column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResAuthorization(string|array<string> $res_authorization) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_authorization column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResOrderNumber(string|array<string> $res_order_number) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_order_number column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResReference(string|array<string> $res_reference) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_reference column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResStatus(string|array<string> $res_status) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_status column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResAvsResult(string|array<string> $res_avs_result) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_avs_result column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResSecurityResult(string|array<string> $res_security_result) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_security_result column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResMac(string|array<string> $res_mac) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_mac column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResDeclineCode(string|array<string> $res_decline_code) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_decline_code column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResTranDate(string|array<string> $res_tran_date) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_tran_date column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResMerchantName(string|array<string> $res_merchant_name) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_merchant_name column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResVersion(string|array<string> $res_version) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_version column
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\ResultRes> findByResEchoserver(string|array<string> $res_EchoServer) Return \ChurchCRM\model\ChurchCRM\ResultRes objects filtered by the res_EchoServer column
 *
 * @method array<\ChurchCRM\model\ChurchCRM\ResultRes>|\Propel\Runtime\Util\PropelModelPager<mixed> paginate($page = 1, $maxPerPage = 10, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 * @template ParentQuery of \Propel\Runtime\ActiveQuery\ModelCriteria|null = null
 * @extends \Propel\Runtime\ActiveQuery\TypedModelCriteria<ParentQuery>
 */
abstract class ResultResQuery extends TypedModelCriteria
{
    /**
     * @var string
     */
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of ResultResQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string|null $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct(
        string $dbName = 'default',
        string $modelName = '\\ChurchCRM\\model\\ChurchCRM\\ResultRes',
        ?string $modelAlias = null
    ) {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildResultResQuery object. XS
     *
     * @param string|null $modelAlias The alias of a model in the query
     * @param \Propel\Runtime\ActiveQuery\Criteria|null $criteria Optional Criteria to build the query from
     *
     * @return \ChurchCRM\model\ChurchCRM\ResultResQuery<null>
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildResultResQuery) {
            return $criteria;
        }
        $query = new ChildResultResQuery();
        if ($modelAlias !== null) {
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
     * $obj = $c->findPk(12, $con);
     * </code>
     *
     * @param int $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \ChurchCRM\model\ChurchCRM\Base\ResultRes|mixed|array the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ResultResTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (!$this->isEmpty()) {
            return $this->findPkComplex($key, $con);
        }

        $poolKey = (string)$key;
        $obj = ResultResTableMap::getInstanceFromPool($poolKey);
        if ($obj !== null) {
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return \ChurchCRM\model\ChurchCRM\ResultRes|null A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con): ?ChildResultRes
    {
        $sql = 'SELECT res_ID, res_echotype1, res_echotype2, res_echotype3, res_authorization, res_order_number, res_reference, res_status, res_avs_result, res_security_result, res_mac, res_decline_code, res_tran_date, res_merchant_name, res_version, res_EchoServer FROM result_res WHERE res_ID = :p0';
        $stmt = $con->prepare($sql);
        if (is_bool($stmt)) {
            throw new PropelException('Failed to initialize statement');
        }
        $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);

            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;

        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ($row) {
            $obj = new ChildResultRes();
            $obj->hydrate($row);
            $poolKey = (string)$key;
            ResultResTableMap::addInstanceToPool($obj, $poolKey);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface $con A connection object
     *
     * @return \ChurchCRM\model\ChurchCRM\Base\ResultRes|mixed|array|null the result, formatted by the current formatter
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
     *
     * @param array $keys Primary keys to use for the query
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con an optional connection object
     *
     * @return \Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\Base\ResultRes>|mixed|array the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (!$con) {
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
     * @return $this
     */
    public function filterByPrimaryKey($key)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_ID');
        $this->addUsingOperator($resolvedColumn, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array $keys The list of primary key values to use for the query
     *
     * @return static
     */
    public function filterByPrimaryKeys(array $keys)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_ID');
        $this->addUsingOperator($resolvedColumn, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the res_ID column
     *
     * Example usage:
     * <code>
     * $query->filterByResId(1234); // WHERE res_ID = 1234
     * $query->filterByResId(array(12, 34)); // WHERE res_ID IN (12, 34)
     * $query->filterByResId(array('min' => 12)); // WHERE res_ID > 12
     * </code>
     *
     * @param mixed $resId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResId($resId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_ID');
        if (is_array($resId)) {
            $useMinMax = false;
            if (isset($resId['min'])) {
                $this->addUsingOperator($resolvedColumn, $resId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resId['max'])) {
                $this->addUsingOperator($resolvedColumn, $resId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $resId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_echotype1 column
     *
     * Example usage:
     * <code>
     * $query->filterByResEchotype1('fooValue'); // WHERE res_echotype1 = 'fooValue'
     * $query->filterByResEchotype1('%fooValue%', Criteria::LIKE); // WHERE res_echotype1 LIKE '%fooValue%'
     * $query->filterByResEchotype1(['foo', 'bar']); // WHERE res_echotype1 IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resEchotype1 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResEchotype1($resEchotype1 = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_echotype1');
        if ($comparison === null && is_array($resEchotype1)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resEchotype1, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_echotype2 column
     *
     * Example usage:
     * <code>
     * $query->filterByResEchotype2('fooValue'); // WHERE res_echotype2 = 'fooValue'
     * $query->filterByResEchotype2('%fooValue%', Criteria::LIKE); // WHERE res_echotype2 LIKE '%fooValue%'
     * $query->filterByResEchotype2(['foo', 'bar']); // WHERE res_echotype2 IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resEchotype2 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResEchotype2($resEchotype2 = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_echotype2');
        if ($comparison === null && is_array($resEchotype2)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resEchotype2, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_echotype3 column
     *
     * Example usage:
     * <code>
     * $query->filterByResEchotype3('fooValue'); // WHERE res_echotype3 = 'fooValue'
     * $query->filterByResEchotype3('%fooValue%', Criteria::LIKE); // WHERE res_echotype3 LIKE '%fooValue%'
     * $query->filterByResEchotype3(['foo', 'bar']); // WHERE res_echotype3 IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resEchotype3 The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResEchotype3($resEchotype3 = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_echotype3');
        if ($comparison === null && is_array($resEchotype3)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resEchotype3, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_authorization column
     *
     * Example usage:
     * <code>
     * $query->filterByResAuthorization('fooValue'); // WHERE res_authorization = 'fooValue'
     * $query->filterByResAuthorization('%fooValue%', Criteria::LIKE); // WHERE res_authorization LIKE '%fooValue%'
     * $query->filterByResAuthorization(['foo', 'bar']); // WHERE res_authorization IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resAuthorization The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResAuthorization($resAuthorization = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_authorization');
        if ($comparison === null && is_array($resAuthorization)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resAuthorization, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_order_number column
     *
     * Example usage:
     * <code>
     * $query->filterByResOrderNumber('fooValue'); // WHERE res_order_number = 'fooValue'
     * $query->filterByResOrderNumber('%fooValue%', Criteria::LIKE); // WHERE res_order_number LIKE '%fooValue%'
     * $query->filterByResOrderNumber(['foo', 'bar']); // WHERE res_order_number IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resOrderNumber The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResOrderNumber($resOrderNumber = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_order_number');
        if ($comparison === null && is_array($resOrderNumber)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resOrderNumber, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByResReference('fooValue'); // WHERE res_reference = 'fooValue'
     * $query->filterByResReference('%fooValue%', Criteria::LIKE); // WHERE res_reference LIKE '%fooValue%'
     * $query->filterByResReference(['foo', 'bar']); // WHERE res_reference IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resReference The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResReference($resReference = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_reference');
        if ($comparison === null && is_array($resReference)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resReference, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_status column
     *
     * Example usage:
     * <code>
     * $query->filterByResStatus('fooValue'); // WHERE res_status = 'fooValue'
     * $query->filterByResStatus('%fooValue%', Criteria::LIKE); // WHERE res_status LIKE '%fooValue%'
     * $query->filterByResStatus(['foo', 'bar']); // WHERE res_status IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resStatus The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResStatus($resStatus = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_status');
        if ($comparison === null && is_array($resStatus)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resStatus, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_avs_result column
     *
     * Example usage:
     * <code>
     * $query->filterByResAvsResult('fooValue'); // WHERE res_avs_result = 'fooValue'
     * $query->filterByResAvsResult('%fooValue%', Criteria::LIKE); // WHERE res_avs_result LIKE '%fooValue%'
     * $query->filterByResAvsResult(['foo', 'bar']); // WHERE res_avs_result IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resAvsResult The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResAvsResult($resAvsResult = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_avs_result');
        if ($comparison === null && is_array($resAvsResult)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resAvsResult, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_security_result column
     *
     * Example usage:
     * <code>
     * $query->filterByResSecurityResult('fooValue'); // WHERE res_security_result = 'fooValue'
     * $query->filterByResSecurityResult('%fooValue%', Criteria::LIKE); // WHERE res_security_result LIKE '%fooValue%'
     * $query->filterByResSecurityResult(['foo', 'bar']); // WHERE res_security_result IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resSecurityResult The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResSecurityResult($resSecurityResult = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_security_result');
        if ($comparison === null && is_array($resSecurityResult)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resSecurityResult, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_mac column
     *
     * Example usage:
     * <code>
     * $query->filterByResMac('fooValue'); // WHERE res_mac = 'fooValue'
     * $query->filterByResMac('%fooValue%', Criteria::LIKE); // WHERE res_mac LIKE '%fooValue%'
     * $query->filterByResMac(['foo', 'bar']); // WHERE res_mac IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resMac The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResMac($resMac = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_mac');
        if ($comparison === null && is_array($resMac)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resMac, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_decline_code column
     *
     * Example usage:
     * <code>
     * $query->filterByResDeclineCode('fooValue'); // WHERE res_decline_code = 'fooValue'
     * $query->filterByResDeclineCode('%fooValue%', Criteria::LIKE); // WHERE res_decline_code LIKE '%fooValue%'
     * $query->filterByResDeclineCode(['foo', 'bar']); // WHERE res_decline_code IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resDeclineCode The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResDeclineCode($resDeclineCode = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_decline_code');
        if ($comparison === null && is_array($resDeclineCode)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resDeclineCode, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_tran_date column
     *
     * Example usage:
     * <code>
     * $query->filterByResTranDate('fooValue'); // WHERE res_tran_date = 'fooValue'
     * $query->filterByResTranDate('%fooValue%', Criteria::LIKE); // WHERE res_tran_date LIKE '%fooValue%'
     * $query->filterByResTranDate(['foo', 'bar']); // WHERE res_tran_date IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resTranDate The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResTranDate($resTranDate = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_tran_date');
        if ($comparison === null && is_array($resTranDate)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resTranDate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_merchant_name column
     *
     * Example usage:
     * <code>
     * $query->filterByResMerchantName('fooValue'); // WHERE res_merchant_name = 'fooValue'
     * $query->filterByResMerchantName('%fooValue%', Criteria::LIKE); // WHERE res_merchant_name LIKE '%fooValue%'
     * $query->filterByResMerchantName(['foo', 'bar']); // WHERE res_merchant_name IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resMerchantName The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResMerchantName($resMerchantName = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_merchant_name');
        if ($comparison === null && is_array($resMerchantName)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resMerchantName, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_version column
     *
     * Example usage:
     * <code>
     * $query->filterByResVersion('fooValue'); // WHERE res_version = 'fooValue'
     * $query->filterByResVersion('%fooValue%', Criteria::LIKE); // WHERE res_version LIKE '%fooValue%'
     * $query->filterByResVersion(['foo', 'bar']); // WHERE res_version IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resVersion The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResVersion($resVersion = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_version');
        if ($comparison === null && is_array($resVersion)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resVersion, $comparison);

        return $this;
    }

    /**
     * Filter the query on the res_EchoServer column
     *
     * Example usage:
     * <code>
     * $query->filterByResEchoserver('fooValue'); // WHERE res_EchoServer = 'fooValue'
     * $query->filterByResEchoserver('%fooValue%', Criteria::LIKE); // WHERE res_EchoServer LIKE '%fooValue%'
     * $query->filterByResEchoserver(['foo', 'bar']); // WHERE res_EchoServer IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $resEchoserver The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByResEchoserver($resEchoserver = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('res_EchoServer');
        if ($comparison === null && is_array($resEchoserver)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $resEchoserver, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param \ChurchCRM\model\ChurchCRM\ResultRes|null $resultRes Object to remove from the list of results
     *
     * @return $this
     */
    public function prune(?ChildResultRes $resultRes = null)
    {
        if ($resultRes) {
            $resolvedColumn = $this->resolveLocalColumnByName('res_ID');
            $this->addUsingOperator($resolvedColumn, $resultRes->getResId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the result_res table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0;
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ResultResTableMap::clearInstancePool();
            ResultResTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver). This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ResultResTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ResultResTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ResultResTableMap::removeInstanceFromPool($criteria);
            $affectedRows += ModelCriteria::delete($con);
            ResultResTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }
}
