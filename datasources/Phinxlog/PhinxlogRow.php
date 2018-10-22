<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\Phinxlog;

use Atlas\Table\Row;

/**
 * @property mixed $version bigint(19,0) NOT NULL
 * @property mixed $migration_name varchar(100)
 * @property mixed $start_time timestamp
 * @property mixed $end_time timestamp
 * @property mixed $breakpoint tinyint(3,0) NOT NULL
 */
class PhinxlogRow extends Row
{
    protected $cols = [
        'version' => null,
        'migration_name' => null,
        'start_time' => null,
        'end_time' => null,
        'breakpoint' => '0',
    ];
}