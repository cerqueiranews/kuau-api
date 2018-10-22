<?php
declare(strict_types=1);

namespace DataSource\Local;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method LocalTable getTable()
 * @method LocalRelationships getRelationships()
 * @method LocalRecord|null fetchRecord($primaryVal, array $with = [])
 * @method LocalRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method LocalRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method LocalRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method LocalRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method LocalRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method LocalSelect select(array $whereEquals = [])
 * @method LocalRecord newRecord(array $fields = [])
 * @method LocalRecord[] newRecords(array $fieldSets)
 * @method LocalRecordSet newRecordSet(array $records = [])
 * @method LocalRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method LocalRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Local extends Mapper
{
}
