<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Order extends AbstractMigration
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
        $order = $this->table('order', array('id' => 'order_id'));
        $order->addColumn('order_code', 'string', ['limit' => 225])
              ->addColumn('user_id', 'integer')
              ->addColumn('product_id', 'integer')
              ->addColumn('product_name','string', ['limit' => 255])
              ->addColumn('price', 'float')
              ->addColumn('qty', 'integer')
              ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}
