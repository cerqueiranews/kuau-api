<?php
declare(strict_types=1);

namespace DataSource\Jogo;

use Atlas\Mapper\RecordSet;

/**
 * @method JogoRecord offsetGet($offset)
 * @method JogoRecord appendNew(array $fields = [])
 * @method JogoRecord|null getOneBy(array $whereEquals)
 * @method JogoRecordSet getAllBy(array $whereEquals)
 * @method JogoRecord|null detachOneBy(array $whereEquals)
 * @method JogoRecordSet detachAllBy(array $whereEquals)
 * @method JogoRecordSet detachAll()
 * @method JogoRecordSet detachDeleted()
 */
class JogoRecordSet extends RecordSet
{
}
