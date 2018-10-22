<?php
declare(strict_types=1);

namespace DataSource\Jogo;

use Atlas\Mapper\Record;

/**
 * @method JogoRow getRow()
 */
class JogoRecord extends Record
{
    use JogoFields;
}
