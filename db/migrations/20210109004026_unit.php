<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Unit extends AbstractMigration
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
    $units = $this->table('units', array('id' => 'unit_id'));
    $units->addColumn('unit', 'string', ['limit' => 225, 'null' => true])
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addIndex(array('unit'), array('unique' => true))
          ->create();
  }
}
