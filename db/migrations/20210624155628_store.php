<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Store extends AbstractMigration
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
      $store = $this->table('store', array('id' => 'store_id'));
      $store->addColumn('store_name', 'string', ['limit' => 225])
            ->addColumn('store_phone', 'string', ['limit' => 225, 'null' => true])
            ->addColumn('store_address', 'string', ['limit' => 225, 'null' => true])
            ->addColumn('store_description','string', ['limit' => 255, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
