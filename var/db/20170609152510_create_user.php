<?php

use Phinx\Migration\AbstractMigration;

class CreateUser extends AbstractMigration
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
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('user',['id' => false,'primary_key' => 'id']);
        $table->addColumn('id','string',['limit' => 36]);
        $table->addColumn('email', 'string', ['limit' => 255]);
        $table->addColumn('password', 'string', ['limit' => 255]);
        $table->addColumn('created', 'datetime');
        $table->addColumn('updated', 'datetime');
        $table->create();
    }
}
