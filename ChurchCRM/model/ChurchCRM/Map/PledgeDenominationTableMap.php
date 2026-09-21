<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Map;

use ChurchCRM\model\ChurchCRM\PledgeDenomination;
use ChurchCRM\model\ChurchCRM\PledgeDenominationQuery;
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
 * This class defines the structure of the 'pledge_denominations_pdem' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PledgeDenominationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'ChurchCRM.model.ChurchCRM.Map.PledgeDenominationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pledge_denominations_pdem';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PledgeDenomination';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\ChurchCRM\\model\\ChurchCRM\\PledgeDenomination';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'ChurchCRM.model.ChurchCRM.PledgeDenomination';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the pdem_id field
     */
    public const COL_PDEM_ID = 'pledge_denominations_pdem.pdem_id';

    /**
     * the column name for the pdem_plg_GroupKey field
     */
    public const COL_PDEM_PLG_GROUPKEY = 'pledge_denominations_pdem.pdem_plg_GroupKey';

    /**
     * the column name for the plg_depID field
     */
    public const COL_PLG_DEPID = 'pledge_denominations_pdem.plg_depID';

    /**
     * the column name for the pdem_denominationID field
     */
    public const COL_PDEM_DENOMINATIONID = 'pledge_denominations_pdem.pdem_denominationID';

    /**
     * the column name for the pdem_denominationQuantity field
     */
    public const COL_PDEM_DENOMINATIONQUANTITY = 'pledge_denominations_pdem.pdem_denominationQuantity';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * @var class-string<\ChurchCRM\model\ChurchCRM\Base\Collection\PledgeDenominationCollection>
     */
    public const DEFAULT_OBJECT_COLLECTION = '\ChurchCRM\model\ChurchCRM\Base\Collection\PledgeDenominationCollection';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['Id', 'GroupKey', 'DepId', 'DenominationId', 'DenominationQuantity', ],
        self::TYPE_CAMELNAME     => ['id', 'groupKey', 'depId', 'denominationId', 'denominationQuantity', ],
        self::TYPE_COLNAME       => [PledgeDenominationTableMap::COL_PDEM_ID, PledgeDenominationTableMap::COL_PDEM_PLG_GROUPKEY, PledgeDenominationTableMap::COL_PLG_DEPID, PledgeDenominationTableMap::COL_PDEM_DENOMINATIONID, PledgeDenominationTableMap::COL_PDEM_DENOMINATIONQUANTITY, ],
        self::TYPE_FIELDNAME     => ['pdem_id', 'pdem_plg_GroupKey', 'plg_depID', 'pdem_denominationID', 'pdem_denominationQuantity', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['Id' => 0, 'GroupKey' => 1, 'DepId' => 2, 'DenominationId' => 3, 'DenominationQuantity' => 4, ],
        self::TYPE_CAMELNAME     => ['id' => 0, 'groupKey' => 1, 'depId' => 2, 'denominationId' => 3, 'denominationQuantity' => 4, ],
        self::TYPE_COLNAME       => [PledgeDenominationTableMap::COL_PDEM_ID => 0, PledgeDenominationTableMap::COL_PDEM_PLG_GROUPKEY => 1, PledgeDenominationTableMap::COL_PLG_DEPID => 2, PledgeDenominationTableMap::COL_PDEM_DENOMINATIONID => 3, PledgeDenominationTableMap::COL_PDEM_DENOMINATIONQUANTITY => 4, ],
        self::TYPE_FIELDNAME     => ['pdem_id' => 0, 'pdem_plg_GroupKey' => 1, 'plg_depID' => 2, 'pdem_denominationID' => 3, 'pdem_denominationQuantity' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string, string>
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'PDEM_ID',
        'PledgeDenomination.Id' => 'PDEM_ID',
        'id' => 'PDEM_ID',
        'pledgeDenomination.id' => 'PDEM_ID',
        'PledgeDenominationTableMap::COL_PDEM_ID' => 'PDEM_ID',
        'COL_PDEM_ID' => 'PDEM_ID',
        'pdem_id' => 'PDEM_ID',
        'pledge_denominations_pdem.pdem_id' => 'PDEM_ID',
        'GroupKey' => 'PDEM_PLG_GROUPKEY',
        'PledgeDenomination.GroupKey' => 'PDEM_PLG_GROUPKEY',
        'groupKey' => 'PDEM_PLG_GROUPKEY',
        'pledgeDenomination.groupKey' => 'PDEM_PLG_GROUPKEY',
        'PledgeDenominationTableMap::COL_PDEM_PLG_GROUPKEY' => 'PDEM_PLG_GROUPKEY',
        'COL_PDEM_PLG_GROUPKEY' => 'PDEM_PLG_GROUPKEY',
        'pdem_plg_GroupKey' => 'PDEM_PLG_GROUPKEY',
        'pledge_denominations_pdem.pdem_plg_GroupKey' => 'PDEM_PLG_GROUPKEY',
        'DepId' => 'PLG_DEPID',
        'PledgeDenomination.DepId' => 'PLG_DEPID',
        'depId' => 'PLG_DEPID',
        'pledgeDenomination.depId' => 'PLG_DEPID',
        'PledgeDenominationTableMap::COL_PLG_DEPID' => 'PLG_DEPID',
        'COL_PLG_DEPID' => 'PLG_DEPID',
        'plg_depID' => 'PLG_DEPID',
        'pledge_denominations_pdem.plg_depID' => 'PLG_DEPID',
        'DenominationId' => 'PDEM_DENOMINATIONID',
        'PledgeDenomination.DenominationId' => 'PDEM_DENOMINATIONID',
        'denominationId' => 'PDEM_DENOMINATIONID',
        'pledgeDenomination.denominationId' => 'PDEM_DENOMINATIONID',
        'PledgeDenominationTableMap::COL_PDEM_DENOMINATIONID' => 'PDEM_DENOMINATIONID',
        'COL_PDEM_DENOMINATIONID' => 'PDEM_DENOMINATIONID',
        'pdem_denominationID' => 'PDEM_DENOMINATIONID',
        'pledge_denominations_pdem.pdem_denominationID' => 'PDEM_DENOMINATIONID',
        'DenominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
        'PledgeDenomination.DenominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
        'denominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
        'pledgeDenomination.denominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
        'PledgeDenominationTableMap::COL_PDEM_DENOMINATIONQUANTITY' => 'PDEM_DENOMINATIONQUANTITY',
        'COL_PDEM_DENOMINATIONQUANTITY' => 'PDEM_DENOMINATIONQUANTITY',
        'pdem_denominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
        'pledge_denominations_pdem.pdem_denominationQuantity' => 'PDEM_DENOMINATIONQUANTITY',
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
        $this->setName('pledge_denominations_pdem');
        $this->setPhpName('PledgeDenomination');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ChurchCRM\\model\\ChurchCRM\\PledgeDenomination');
        $this->setPackage('ChurchCRM.model.ChurchCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pdem_id', 'Id', 'SMALLINT', true, 9, null);
        $this->addColumn('pdem_plg_GroupKey', 'GroupKey', 'VARCHAR', true, 64, null);
        $this->addColumn('plg_depID', 'DepId', 'SMALLINT', false, 9, null);
        $this->addColumn('pdem_denominationID', 'DenominationId', 'SMALLINT', true, 9, 0);
        $this->addColumn('pdem_denominationQuantity', 'DenominationQuantity', 'INTEGER', false, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string)$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        $idIx = $indexType === TableMap::TYPE_NUM
            ? 0 + $offset
            : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType);

        return (int)$row[$idIx];
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
        return $withPrefix ? PledgeDenominationTableMap::CLASS_DEFAULT : PledgeDenominationTableMap::OM_CLASS;
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
     * @return array (PledgeDenomination object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PledgeDenominationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (($obj = PledgeDenominationTableMap::getInstanceFromPool($key)) !== null) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PledgeDenominationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PledgeDenominationTableMap::OM_CLASS;
            /** @var PledgeDenomination $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PledgeDenominationTableMap::addInstanceToPool($obj, $key);
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
            $key = PledgeDenominationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (($obj = PledgeDenominationTableMap::getInstanceFromPool($key)) !== null) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new PledgeDenomination();
                $obj->hydrate($row);
                $results[] = $obj;
                PledgeDenominationTableMap::addInstanceToPool($obj, $key);
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
        $tableAlias = $alias ?: 'pledge_denominations_pdem';
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PDEM_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PDEM_PLG_GROUPKEY']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PLG_DEPID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PDEM_DENOMINATIONID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['PDEM_DENOMINATIONQUANTITY']));
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
            $criteria->removeSelectColumn(PledgeDenominationTableMap::COL_PDEM_ID);
            $criteria->removeSelectColumn(PledgeDenominationTableMap::COL_PDEM_PLG_GROUPKEY);
            $criteria->removeSelectColumn(PledgeDenominationTableMap::COL_PLG_DEPID);
            $criteria->removeSelectColumn(PledgeDenominationTableMap::COL_PDEM_DENOMINATIONID);
            $criteria->removeSelectColumn(PledgeDenominationTableMap::COL_PDEM_DENOMINATIONQUANTITY);
        } else {
            $criteria->removeSelectColumn($alias . '.pdem_id');
            $criteria->removeSelectColumn($alias . '.pdem_plg_GroupKey');
            $criteria->removeSelectColumn($alias . '.plg_depID');
            $criteria->removeSelectColumn($alias . '.pdem_denominationID');
            $criteria->removeSelectColumn($alias . '.pdem_denominationQuantity');
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
        return Propel::getServiceContainer()->getDatabaseMap(PledgeDenominationTableMap::DATABASE_NAME)->getTable(PledgeDenominationTableMap::TABLE_NAME);
    }

    /**
     * @deprecated Delete via model or PledgeDenominationQuery.
     *
     * Performs a DELETE on the database, given a PledgeDenomination or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PledgeDenomination object or primary key or array of primary keys
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
        trigger_deprecation('Propel', '2.0', 'TableMap::doDelete() should not be used anymore, delete via model or PledgeDenominationQuery');

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PledgeDenominationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            $criteria = $values;
        } elseif ($values instanceof PledgeDenomination) { // it's a model object
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PledgeDenominationTableMap::DATABASE_NAME);
            $criteria->addAnd(PledgeDenominationTableMap::COL_PDEM_ID, (array)$values, Criteria::IN);
        }

        $query = PledgeDenominationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PledgeDenominationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array)$values as $singleval) {
                PledgeDenominationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pledge_denominations_pdem table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PledgeDenominationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PledgeDenomination or Criteria object.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria|\ChurchCRM\model\ChurchCRM\PledgeDenomination $criteria
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
            $con = Propel::getServiceContainer()->getWriteConnection(PledgeDenominationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
            $criteria->turnFiltersToUpdateValues();
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PledgeDenomination object
        }

        if ($criteria->hasUpdateValue(PledgeDenominationTableMap::COL_PDEM_ID)) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (PledgeDenominationTableMap::COL_PDEM_ID)');
        }

        // Set the correct dbName
        $query = PledgeDenominationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }
}
