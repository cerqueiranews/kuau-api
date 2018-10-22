<?php
declare(strict_types=1);

namespace DataSource\Time;

use Atlas\Mapper\RecordSet;

/**
 * @method TimeRecord offsetGet($offset)
 * @method TimeRecord appendNew(array $fields = [])
 * @method TimeRecord|null getOneBy(array $whereEquals)
 * @method TimeRecordSet getAllBy(array $whereEquals)
 * @method TimeRecord|null detachOneBy(array $whereEquals)
 * @method TimeRecordSet detachAllBy(array $whereEquals)
 * @method TimeRecordSet detachAll()
 * @method TimeRecordSet detachDeleted()
 */
class TimeRecordSet extends RecordSet
{
}
