<?php
declare(strict_types=1);

namespace DataSource\Local;

use Atlas\Mapper\Record;

/**
 * @method LocalRow getRow()
 */
class LocalRecord extends Record
{
    use LocalFields;
}
