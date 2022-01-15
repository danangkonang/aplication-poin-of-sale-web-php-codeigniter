<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Merchant extends AbstractMigration
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
    $merchant = $this->table('merchants', array('id' => 'merchant_id'));
    $merchant->addColumn('merchant_name', 'string', ['limit' => 225])
          ->addColumn('merchant_telephone', 'string', ['limit' => 225, 'null' => true])
          ->addColumn('merchant_address', 'string', ['limit' => 225, 'null' => true])
          ->addColumn('merchant_description','string', ['limit' => 255, 'null' => true])
          ->addColumn('created_by', 'integer')
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addIndex(array('created_by'))
          ->addForeignKey('created_by', 'users', 'user_id', array('delete'=> 'NO_ACTION', 'update'=> 'NO_ACTION'))
          ->create();
  }
}
