<?php


use Phinx\Migration\AbstractMigration;

class CreateTableJogos extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('locais');
        $table->addColumn('nome', 'string')
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime')
              ->addIndex('nome',  ['limit' => 10])
              ->create();

        $table = $this->table('jogos');
        $table->addColumn('local', 'integer')
              ->addColumn('horario','datetime')
              ->addColumn('mandante', 'integer')
              ->addColumn('visitante', 'integer')
              ->addColumn('descricao', 'string')
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime')
              ->addIndex('local')
              ->addIndex('horario')
              ->addIndex(['horario', 'mandante'], ['unique' => true])
              ->addIndex(['horario', 'visitante'], ['unique' => true])
              ->create();
    }
}
