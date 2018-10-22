<?php
declare(strict_types=1);

namespace DataSource\Time;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method TimeTable getTable()
 * @method TimeRelationships getRelationships()
 * @method TimeRecord|null fetchRecord($primaryVal, array $with = [])
 * @method TimeRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method TimeRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method TimeRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method TimeRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method TimeRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method TimeSelect select(array $whereEquals = [])
 * @method TimeRecord newRecord(array $fields = [])
 * @method TimeRecord[] newRecords(array $fieldSets)
 * @method TimeRecordSet newRecordSet(array $records = [])
 * @method TimeRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method TimeRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Time extends Mapper
{
}
