<?php


use Phinx\Migration\AbstractMigration;

class AddForeignKeyJogos extends AbstractMigration
{

    public function up()
    {
        $table = $this->table('jogos');
        $table->addForeignKey('mandante', 'times', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
              ->addForeignKey('visitante', 'times', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
              ->addForeignKey('local', 'locais', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
              ->save();
    }

    public function down()
    {
        $table = $this->table('jogos');
        $table->dropForeignKey('mandante')
              ->dropForeignKey('visitante')
              ->dropForeignKey('local')
              ->save();
    }
}
