<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\Time;

use Atlas\Table\Table;

/**
 * @method TimeRow|null fetchRow($primaryVal)
 * @method TimeRow[] fetchRows(array $primaryVals)
 * @method TimeTableSelect select(array $whereEquals = [])
 * @method TimeRow newRow(array $cols = [])
 * @method TimeRow newSelectedRow(array $cols)
 */
class TimeTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'times';

    const COLUMNS = [
        'id' => array (
  'name' => 'id',
  'type' => 'int',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => true,
  'primary' => true,
  'options' => NULL,
),
        'nome' => array (
  'name' => 'nome',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'sigla' => array (
  'name' => 'sigla',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'path' => array (
  'name' => 'path',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'created' => array (
  'name' => 'created',
  'type' => 'datetime',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'updated' => array (
  'name' => 'updated',
  'type' => 'datetime',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
    ];

    const COLUMN_NAMES = [
        'id',
        'nome',
        'sigla',
        'path',
        'created',
        'updated',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'nome' => null,
        'sigla' => null,
        'path' => null,
        'created' => null,
        'updated' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = 'id';

    const AUTOINC_SEQUENCE = null;
}
