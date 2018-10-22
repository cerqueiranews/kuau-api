<?php
declare(strict_types=1);

namespace DataSource\Jogo;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;
use DataSource\Time\Time;

/**
 * @method JogoTable getTable()
 * @method JogoRelationships getRelationships()
 * @method JogoRecord|null fetchRecord($primaryVal, array $with = [])
 * @method JogoRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method JogoRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method JogoRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method JogoRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method JogoRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method JogoSelect select(array $whereEquals = [])
 * @method JogoRecord newRecord(array $fields = [])
 * @method JogoRecord[] newRecords(array $fieldSets)
 * @method JogoRecordSet newRecordSet(array $records = [])
 * @method JogoRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method JogoRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Jogo extends Mapper
{
    protected function setRelated()
    {
        $this->manyToOne('nome', Time::CLASS)
            ->on([
                'visitante' => 'id',
            ]);
    }
}
