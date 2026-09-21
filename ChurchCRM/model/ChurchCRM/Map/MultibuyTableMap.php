<?php

/**
 * MIT License. This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ChurchCRM\model\ChurchCRM\Map;

use ChurchCRM\model\ChurchCRM\Multibuy;
use ChurchCRM\model\ChurchCRM\MultibuyQuery;
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
 * This class defines the structure of the 'multibuy_mb' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class MultibuyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'ChurchCRM.model.ChurchCRM.Map.MultibuyTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'multibuy_mb';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'Multibuy';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\ChurchCRM\\model\\ChurchCRM\\Multibuy';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'ChurchCRM.model.ChurchCRM.Multibuy';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the mb_ID field
     */
    public const COL_MB_ID = 'multibuy_mb.mb_ID';

    /**
     * the column name for the mb_per_ID field
     */
    public const COL_MB_PER_ID = 'multibuy_mb.mb_per_ID';

    /**
     * the column name for the mb_item_ID field
     */
    public const COL_MB_ITEM_ID = 'multibuy_mb.mb_item_ID';

    /**
     * the column name for the mb_count field
     */
    public const COL_MB_COUNT = 'multibuy_mb.mb_count';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * @var class-string<\ChurchCRM\model\ChurchCRM\Base\Collection\MultibuyCollection>
     */
    public const DEFAULT_OBJECT_COLLECTION = '\ChurchCRM\model\ChurchCRM\Base\Collection\MultibuyCollection';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['MbId', 'MbPerId', 'MbItemId', 'MbCount', ],
        self::TYPE_CAMELNAME     => ['mbId', 'mbPerId', 'mbItemId', 'mbCount', ],
        self::TYPE_COLNAME       => [MultibuyTableMap::COL_MB_ID, MultibuyTableMap::COL_MB_PER_ID, MultibuyTableMap::COL_MB_ITEM_ID, MultibuyTableMap::COL_MB_COUNT, ],
        self::TYPE_FIELDNAME     => ['mb_ID', 'mb_per_ID', 'mb_item_ID', 'mb_count', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['MbId' => 0, 'MbPerId' => 1, 'MbItemId' => 2, 'MbCount' => 3, ],
        self::TYPE_CAMELNAME     => ['mbId' => 0, 'mbPerId' => 1, 'mbItemId' => 2, 'mbCount' => 3, ],
        self::TYPE_COLNAME       => [MultibuyTableMap::COL_MB_ID => 0, MultibuyTableMap::COL_MB_PER_ID => 1, MultibuyTableMap::COL_MB_ITEM_ID => 2, MultibuyTableMap::COL_MB_COUNT => 3, ],
        self::TYPE_FIELDNAME     => ['mb_ID' => 0, 'mb_per_ID' => 1, 'mb_item_ID' => 2, 'mb_count' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string, string>
     */
    protected $normalizedColumnNameMap = [
        'MbId' => 'MB_ID',
        'Multibuy.MbId' => 'MB_ID',
        'mbId' => 'MB_ID',
        'multibuy.mbId' => 'MB_ID',
        'MultibuyTableMap::COL_MB_ID' => 'MB_ID',
        'COL_MB_ID' => 'MB_ID',
        'mb_ID' => 'MB_ID',
        'multibuy_mb.mb_ID' => 'MB_ID',
        'MbPerId' => 'MB_PER_ID',
        'Multibuy.MbPerId' => 'MB_PER_ID',
        'mbPerId' => 'MB_PER_ID',
        'multibuy.mbPerId' => 'MB_PER_ID',
        'MultibuyTableMap::COL_MB_PER_ID' => 'MB_PER_ID',
        'COL_MB_PER_ID' => 'MB_PER_ID',
        'mb_per_ID' => 'MB_PER_ID',
        'multibuy_mb.mb_per_ID' => 'MB_PER_ID',
        'MbItemId' => 'MB_ITEM_ID',
        'Multibuy.MbItemId' => 'MB_ITEM_ID',
        'mbItemId' => 'MB_ITEM_ID',
        'multibuy.mbItemId' => 'MB_ITEM_ID',
        'MultibuyTableMap::COL_MB_ITEM_ID' => 'MB_ITEM_ID',
        'COL_MB_ITEM_ID' => 'MB_ITEM_ID',
        'mb_item_ID' => 'MB_ITEM_ID',
        'multibuy_mb.mb_item_ID' => 'MB_ITEM_ID',
        'MbCount' => 'MB_COUNT',
        'Multibuy.MbCount' => 'MB_COUNT',
        'mbCount' => 'MB_COUNT',
        'multibuy.mbCount' => 'MB_COUNT',
        'MultibuyTableMap::COL_MB_COUNT' => 'MB_COUNT',
        'COL_MB_COUNT' => 'MB_COUNT',
        'mb_count' => 'MB_COUNT',
        'multibuy_mb.mb_count' => 'MB_COUNT',
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
        $this->setName('multibuy_mb');
        $this->setPhpName('Multibuy');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ChurchCRM\\model\\ChurchCRM\\Multibuy');
        $this->setPackage('ChurchCRM.model.ChurchCRM');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('mb_ID', 'MbId', 'SMALLINT', true, 9, null);
        $this->addColumn('mb_per_ID', 'MbPerId', 'SMALLINT', true, 9, 0);
        $this->addColumn('mb_item_ID', 'MbItemId', 'SMALLINT', true, 9, 0);
        $this->addColumn('mb_count', 'MbCount', 'DECIMAL', false, 8, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)] === null || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string)$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType)];
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
        $mbIdIx = $indexType === TableMap::TYPE_NUM
            ? 0 + $offset
            : self::translateFieldName('MbId', TableMap::TYPE_PHPNAME, $indexType);

        return (int)$row[$mbIdIx];
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
        return $withPrefix ? MultibuyTableMap::CLASS_DEFAULT : MultibuyTableMap::OM_CLASS;
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
     * @return array (Multibuy object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = MultibuyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (($obj = MultibuyTableMap::getInstanceFromPool($key)) !== null) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MultibuyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MultibuyTableMap::OM_CLASS;
            /** @var Multibuy $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MultibuyTableMap::addInstanceToPool($obj, $key);
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
            $key = MultibuyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (($obj = MultibuyTableMap::getInstanceFromPool($key)) !== null) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new Multibuy();
                $obj->hydrate($row);
                $results[] = $obj;
                MultibuyTableMap::addInstanceToPool($obj, $key);
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
        $tableAlias = $alias ?: 'multibuy_mb';
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['MB_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['MB_PER_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['MB_ITEM_ID']));
        $criteria->addSelectColumn(new LocalColumnExpression($criteria, $tableAlias, $tableMap->columns['MB_COUNT']));
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
            $criteria->removeSelectColumn(MultibuyTableMap::COL_MB_ID);
            $criteria->removeSelectColumn(MultibuyTableMap::COL_MB_PER_ID);
            $criteria->removeSelectColumn(MultibuyTableMap::COL_MB_ITEM_ID);
            $criteria->removeSelectColumn(MultibuyTableMap::COL_MB_COUNT);
        } else {
            $criteria->removeSelectColumn($alias . '.mb_ID');
            $criteria->removeSelectColumn($alias . '.mb_per_ID');
            $criteria->removeSelectColumn($alias . '.mb_item_ID');
            $criteria->removeSelectColumn($alias . '.mb_count');
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
        return Propel::getServiceContainer()->getDatabaseMap(MultibuyTableMap::DATABASE_NAME)->getTable(MultibuyTableMap::TABLE_NAME);
    }

    /**
     * @deprecated Delete via model or MultibuyQuery.
     *
     * Performs a DELETE on the database, given a Multibuy or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or Multibuy object or primary key or array of primary keys
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
        trigger_deprecation('Propel', '2.0', 'TableMap::doDelete() should not be used anymore, delete via model or MultibuyQuery');

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(MultibuyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            $criteria = $values;
        } elseif ($values instanceof Multibuy) { // it's a model object
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MultibuyTableMap::DATABASE_NAME);
            $criteria->addAnd(MultibuyTableMap::COL_MB_ID, (array)$values, Criteria::IN);
        }

        $query = MultibuyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MultibuyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array)$values as $singleval) {
                MultibuyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the multibuy_mb table.
     *
     * @param \Propel\Runtime\Connection\ConnectionInterface|null $con the connection to use
     *
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return MultibuyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Multibuy or Criteria object.
     *
     * @param \Propel\Runtime\ActiveQuery\Criteria|\ChurchCRM\model\ChurchCRM\Multibuy $criteria
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
            $con = Propel::getServiceContainer()->getWriteConnection(MultibuyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria;
            $criteria->turnFiltersToUpdateValues();
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Multibuy object
        }

        if ($criteria->hasUpdateValue(MultibuyTableMap::COL_MB_ID)) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (MultibuyTableMap::COL_MB_ID)');
        }

        // Set the correct dbName
        $query = MultibuyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }
}
