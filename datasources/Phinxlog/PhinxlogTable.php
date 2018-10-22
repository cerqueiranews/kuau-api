<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\Phinxlog;

use Atlas\Table\Table;

/**
 * @method PhinxlogRow|null fetchRow($primaryVal)
 * @method PhinxlogRow[] fetchRows(array $primaryVals)
 * @method PhinxlogTableSelect select(array $whereEquals = [])
 * @method PhinxlogRow newRow(array $cols = [])
 * @method PhinxlogRow newSelectedRow(array $cols)
 */
class PhinxlogTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'phinxlog';

    const COLUMNS = [
        'version' => array (
  'name' => 'version',
  'type' => 'bigint',
  'size' => 19,
  'scale' => 0,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => true,
  'options' => NULL,
),
        'migration_name' => array (
  'name' => 'migration_name',
  'type' => 'varchar',
  'size' => 100,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'start_time' => array (
  'name' => 'start_time',
  'type' => 'timestamp',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'end_time' => array (
  'name' => 'end_time',
  'type' => 'timestamp',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'breakpoint' => array (
  'name' => 'breakpoint',
  'type' => 'tinyint',
  'size' => 3,
  'scale' => 0,
  'notnull' => true,
  'default' => '0',
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
    ];

    const COLUMN_NAMES = [
        'version',
        'migration_name',
        'start_time',
        'end_time',
        'breakpoint',
    ];

    const COLUMN_DEFAULTS = [
        'version' => null,
        'migration_name' => null,
        'start_time' => null,
        'end_time' => null,
        'breakpoint' => '0',
    ];

    const PRIMARY_KEY = [
        'version',
    ];

    const AUTOINC_COLUMN = null;

    const AUTOINC_SEQUENCE = null;
}