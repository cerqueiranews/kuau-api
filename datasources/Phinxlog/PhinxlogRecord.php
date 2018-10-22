<?php
declare(strict_types=1);

namespace DataSource\Phinxlog;

use Atlas\Mapper\Record;

/**
 * @method PhinxlogRow getRow()
 */
class PhinxlogRecord extends Record
{
    use PhinxlogFields;
}
