<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Permision extends AbstractMigration
{
  /**
   * Change Method.
   *
   * Write your reversible migrations using this method.
   *
   * More information on writing migrations is available here:
   * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
   *
   * Remember to call "create()" or "update()" and NOT "save()" when working
   * with the Table class.
   */
  public function change(): void
  {
    $permisions = $this->table('permisions', array('id' => 'permision_id'));
    $permisions->addColumn('user_id', 'integer')
      ->addColumn('read', 'boolean', ['default' => true])
      ->addColumn('create', 'boolean', ['default' => false])
      ->addColumn('update', 'boolean', ['default' => false])
      ->addColumn('delete', 'boolean', ['default' => false])
      ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      // ->addIndex(array('user_id'), array('unique' => true))
      ->addForeignKey('user_id', 'users', 'user_id', array('delete' => 'NO_ACTION', 'update' => 'NO_ACTION'))
      ->create();
  }
}
