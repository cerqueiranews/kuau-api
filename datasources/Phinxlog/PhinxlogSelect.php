<?php
declare(strict_types=1);

namespace DataSource\Phinxlog;

use Atlas\Mapper\MapperSelect;

/**
 * @method PhinxlogRecord|null fetchRecord()
 * @method PhinxlogRecord[] fetchRecords()
 * @method PhinxlogRecordSet fetchRecordSet()
 */
class PhinxlogSelect extends MapperSelect
{
}
