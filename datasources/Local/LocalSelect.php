<?php
declare(strict_types=1);

namespace DataSource\Local;

use Atlas\Mapper\MapperSelect;

/**
 * @method LocalRecord|null fetchRecord()
 * @method LocalRecord[] fetchRecords()
 * @method LocalRecordSet fetchRecordSet()
 */
class LocalSelect extends MapperSelect
{
}
