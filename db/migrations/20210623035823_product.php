<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Product extends AbstractMigration
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
      $product = $this->table('product', array('id' => 'product_id'));
      $product->addColumn('product_name', 'string', ['limit' => 225])
            ->addColumn('purchase_price', 'float')
            ->addColumn('selling_price', 'float')
            ->addColumn('unit', 'string', ['limit' => 225])
            ->addColumn('product_qty', 'integer')
            ->addColumn('is_promo', 'boolean', ['default' => false])
            ->addColumn('product_image', 'string', ['limit' => 225, 'null' => true])
            ->addColumn('is_active', 'boolean', ['default' => false])
            ->addColumn('is_delete', 'boolean', ['default' => false])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
