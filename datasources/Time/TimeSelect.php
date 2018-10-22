<?php
declare(strict_types=1);

namespace DataSource\Time;

use Atlas\Mapper\MapperSelect;

/**
 * @method TimeRecord|null fetchRecord()
 * @method TimeRecord[] fetchRecords()
 * @method TimeRecordSet fetchRecordSet()
 */
class TimeSelect extends MapperSelect
{
}
