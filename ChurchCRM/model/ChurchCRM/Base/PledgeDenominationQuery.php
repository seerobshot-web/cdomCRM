<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Base;

use ChurchCRM\model\ChurchCRM\Map\PledgeDenominationTableMap;
use ChurchCRM\model\ChurchCRM\PledgeDenomination as ChildPledgeDenomination;
use ChurchCRM\model\ChurchCRM\PledgeDenominationQuery as ChildPledgeDenominationQuery;
use Exception;
use PDO;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\TypedModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Propel;

/**
 * Base class that represents a query for the `pledge_denominations_pdem` table.
 *
 * Cash denomination counts recorded per pledge/payment GroupKey for a deposit (cash-counting workflow). Column plg_depID mirrors the name used in FinancialService raw SQL.
 *
 * @method static orderById($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pdem_id column
 * @method static orderByGroupKey($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pdem_plg_GroupKey column
 * @method static orderByDepId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the plg_depID column
 * @method static orderByDenominationId($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pdem_denominationID column
 * @method static orderByDenominationQuantity($order = \Propel\Runtime\ActiveQuery\Criteria::ASC) Order by the pdem_denominationQuantity column
 *
 * @method static groupById() Group by the pdem_id column
 * @method static groupByGroupKey() Group by the pdem_plg_GroupKey column
 * @method static groupByDepId() Group by the plg_depID column
 * @method static groupByDenominationId() Group by the pdem_denominationID column
 * @method static groupByDenominationQuantity() Group by the pdem_denominationQuantity column
 *
 * @method static leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method static rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method static innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method static leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method static rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method static innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination matching the query
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination findOneOrCreate(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination matching the query, or a new \ChurchCRM\model\ChurchCRM\PledgeDenomination object populated from the query conditions when no match is found
 *
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOneById(int $pdem_id) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_id column
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOneByGroupKey(string $pdem_plg_GroupKey) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_plg_GroupKey column
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOneByDepId(int $plg_depID) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the plg_depID column
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOneByDenominationId(int $pdem_denominationID) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_denominationID column
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination|null findOneByDenominationQuantity(int $pdem_denominationQuantity) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_denominationQuantity column
 *
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requirePk($key, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the \ChurchCRM\model\ChurchCRM\PledgeDenomination by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOne(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOneById(int $pdem_id) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOneByGroupKey(string $pdem_plg_GroupKey) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_plg_GroupKey column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOneByDepId(int $plg_depID) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the plg_depID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOneByDenominationId(int $pdem_denominationID) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_denominationID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method \ChurchCRM\model\ChurchCRM\PledgeDenomination requireOneByDenominationQuantity(int $pdem_denominationQuantity) Return the first \ChurchCRM\model\ChurchCRM\PledgeDenomination filtered by the pdem_denominationQuantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\PledgeDenominationCollection|array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> find(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects based on current ModelCriteria
 * @method \ChurchCRM\model\ChurchCRM\Base\Collection\PledgeDenominationCollection findObjects(\Propel\Runtime\Connection\ConnectionInterface|null $con = null) Get \ChurchCRM\model\ChurchCRM\PledgeDenomination objects in ObjectCollection
 *
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> findById(int|array<int> $pdem_id) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects filtered by the pdem_id column
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> findByGroupKey(string|array<string> $pdem_plg_GroupKey) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects filtered by the pdem_plg_GroupKey column
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> findByDepId(int|array<int> $plg_depID) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects filtered by the plg_depID column
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> findByDenominationId(int|array<int> $pdem_denominationID) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects filtered by the pdem_denominationID column
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\PledgeDenomination> findByDenominationQuantity(int|array<int> $pdem_denominationQuantity) Return \ChurchCRM\model\ChurchCRM\PledgeDenomination objects filtered by the pdem_denominationQuantity column
 *
 * @method array<\ChurchCRM\model\ChurchCRM\PledgeDenomination>|\Propel\Runtime\Util\PropelModelPager<mixed> paginate($page = 1, $maxPerPage = 10, \Propel\Runtime\Connection\ConnectionInterface|null $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 * @template ParentQuery of \Propel\Runtime\ActiveQuery\ModelCriteria|null = null
 * @extends \Propel\Runtime\ActiveQuery\TypedModelCriteria<ParentQuery>
 */
abstract class PledgeDenominationQuery extends TypedModelCriteria
{
    /**
     * @var string
     */
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of PledgeDenominationQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string|null $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct(
        string $dbName = 'default',
        string $modelName = '\\ChurchCRM\\model\\ChurchCRM\\PledgeDenomination',
        ?string $modelAlias = null
    ) {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPledgeDenominationQuery object. XS
     *
     * @param string|null $modelAlias The alias of a model in the query
     * @param \Propel\Runtime\ActiveQuery\Criteria|null $criteria Optional Criteria to build the query from
     *
     * @return \ChurchCRM\model\ChurchCRM\PledgeDenominationQuery<null>
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildPledgeDenominationQuery) {
            return $criteria;
        }
        $query = new ChildPledgeDenominationQuery();
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
     * @return \ChurchCRM\model\ChurchCRM\Base\PledgeDenomination|mixed|array the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PledgeDenominationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (!$this->isEmpty()) {
            return $this->findPkComplex($key, $con);
        }

        $poolKey = (string)$key;
        $obj = PledgeDenominationTableMap::getInstanceFromPool($poolKey);
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
     * @return \ChurchCRM\model\ChurchCRM\PledgeDenomination|null A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con): ?ChildPledgeDenomination
    {
        $sql = 'SELECT pdem_id, pdem_plg_GroupKey, plg_depID, pdem_denominationID, pdem_denominationQuantity FROM pledge_denominations_pdem WHERE pdem_id = :p0';
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
            $obj = new ChildPledgeDenomination();
            $obj->hydrate($row);
            $poolKey = (string)$key;
            PledgeDenominationTableMap::addInstanceToPool($obj, $poolKey);
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
     * @return \ChurchCRM\model\ChurchCRM\Base\PledgeDenomination|mixed|array|null the result, formatted by the current formatter
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
     * @return \Propel\Runtime\Collection\Collection<\ChurchCRM\model\ChurchCRM\Base\PledgeDenomination>|mixed|array the list of results, formatted by the current formatter
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
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_id');
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
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_id');
        $this->addUsingOperator($resolvedColumn, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the pdem_id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE pdem_id = 1234
     * $query->filterById(array(12, 34)); // WHERE pdem_id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE pdem_id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_id');
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingOperator($resolvedColumn, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingOperator($resolvedColumn, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pdem_plg_GroupKey column
     *
     * Example usage:
     * <code>
     * $query->filterByGroupKey('fooValue'); // WHERE pdem_plg_GroupKey = 'fooValue'
     * $query->filterByGroupKey('%fooValue%', Criteria::LIKE); // WHERE pdem_plg_GroupKey LIKE '%fooValue%'
     * $query->filterByGroupKey(['foo', 'bar']); // WHERE pdem_plg_GroupKey IN ('foo', 'bar')
     * </code>
     *
     * @param array<string>|string|null $groupKey The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByGroupKey($groupKey = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_plg_GroupKey');
        if ($comparison === null && is_array($groupKey)) {
            $comparison = Criteria::IN;
        }
        $this->addUsingOperator($resolvedColumn, $groupKey, $comparison);

        return $this;
    }

    /**
     * Filter the query on the plg_depID column
     *
     * Example usage:
     * <code>
     * $query->filterByDepId(1234); // WHERE plg_depID = 1234
     * $query->filterByDepId(array(12, 34)); // WHERE plg_depID IN (12, 34)
     * $query->filterByDepId(array('min' => 12)); // WHERE plg_depID > 12
     * </code>
     *
     * @param mixed $depId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByDepId($depId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('plg_depID');
        if (is_array($depId)) {
            $useMinMax = false;
            if (isset($depId['min'])) {
                $this->addUsingOperator($resolvedColumn, $depId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($depId['max'])) {
                $this->addUsingOperator($resolvedColumn, $depId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $depId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pdem_denominationID column
     *
     * Example usage:
     * <code>
     * $query->filterByDenominationId(1234); // WHERE pdem_denominationID = 1234
     * $query->filterByDenominationId(array(12, 34)); // WHERE pdem_denominationID IN (12, 34)
     * $query->filterByDenominationId(array('min' => 12)); // WHERE pdem_denominationID > 12
     * </code>
     *
     * @param mixed $denominationId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByDenominationId($denominationId = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_denominationID');
        if (is_array($denominationId)) {
            $useMinMax = false;
            if (isset($denominationId['min'])) {
                $this->addUsingOperator($resolvedColumn, $denominationId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($denominationId['max'])) {
                $this->addUsingOperator($resolvedColumn, $denominationId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $denominationId, $comparison);

        return $this;
    }

    /**
     * Filter the query on the pdem_denominationQuantity column
     *
     * Example usage:
     * <code>
     * $query->filterByDenominationQuantity(1234); // WHERE pdem_denominationQuantity = 1234
     * $query->filterByDenominationQuantity(array(12, 34)); // WHERE pdem_denominationQuantity IN (12, 34)
     * $query->filterByDenominationQuantity(array('min' => 12)); // WHERE pdem_denominationQuantity > 12
     * </code>
     *
     * @param mixed $denominationQuantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this
     */
    public function filterByDenominationQuantity($denominationQuantity = null, ?string $comparison = null)
    {
        $resolvedColumn = $this->resolveLocalColumnByName('pdem_denominationQuantity');
        if (is_array($denominationQuantity)) {
            $useMinMax = false;
            if (isset($denominationQuantity['min'])) {
                $this->addUsingOperator($resolvedColumn, $denominationQuantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($denominationQuantity['max'])) {
                $this->addUsingOperator($resolvedColumn, $denominationQuantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if ($comparison === null) {
                $comparison = Criteria::IN;
            }
        }
        $this->addUsingOperator($resolvedColumn, $denominationQuantity, $comparison);

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param \ChurchCRM\model\ChurchCRM\PledgeDenomination|null $pledgeDenomination Object to remove from the list of results
     *
     * @return $this
     */
    public function prune(?ChildPledgeDenomination $pledgeDenomination = null)
    {
        if ($pledgeDenomination) {
            $resolvedColumn = $this->resolveLocalColumnByName('pdem_id');
            $this->addUsingOperator($resolvedColumn, $pledgeDenomination->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pledge_denominations_pdem table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (!$con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PledgeDenominationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0;
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PledgeDenominationTableMap::clearInstancePool();
            PledgeDenominationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PledgeDenominationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PledgeDenominationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PledgeDenominationTableMap::removeInstanceFromPool($criteria);
            $affectedRows += ModelCriteria::delete($con);
            PledgeDenominationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }
}
