<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Transaction extends AbstractMigration
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
    $transaction = $this->table('transactions', array('id' => 'transaction_id'));
    $transaction->addColumn('transaction_code', 'string', ['limit' => 225])
      ->addColumn('member_id', 'integer', ['null' => true])
      ->addColumn('product_id', 'integer')
      ->addColumn('product_name', 'string', ['limit' => 255])
      ->addColumn('price', 'float')
      ->addColumn('qty', 'integer')
      ->addColumn('created_by', 'integer', ['null' => true])
      ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addIndex(array('member_id'), array('unique' => true))
      ->addForeignKey('member_id', 'members', 'member_id', array('delete' => 'SET_NULL', 'update' => 'NO_ACTION'))
      ->addForeignKey('product_id', 'products', 'product_id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
      ->create();
  }
}
