<?php
declare(strict_types=1);

namespace DataSource\Local;

use Atlas\Mapper\RecordSet;

/**
 * @method LocalRecord offsetGet($offset)
 * @method LocalRecord appendNew(array $fields = [])
 * @method LocalRecord|null getOneBy(array $whereEquals)
 * @method LocalRecordSet getAllBy(array $whereEquals)
 * @method LocalRecord|null detachOneBy(array $whereEquals)
 * @method LocalRecordSet detachAllBy(array $whereEquals)
 * @method LocalRecordSet detachAll()
 * @method LocalRecordSet detachDeleted()
 */
class LocalRecordSet extends RecordSet
{
}
