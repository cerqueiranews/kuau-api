<?php
declare(strict_types=1);

namespace DataSource\Time;

use Atlas\Mapper\Record;

/**
 * @method TimeRow getRow()
 */
class TimeRecord extends Record
{
    use TimeFields;
}
