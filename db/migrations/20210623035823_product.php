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
    $product = $this->table('products', array('id' => 'product_id'));
    $product->addColumn('barcode', 'string')
      ->addColumn('kind_id', 'integer')
      ->addColumn('product_name', 'string', ['limit' => 225])
      ->addColumn('purchase_price', 'float')
      ->addColumn('selling_price', 'float')
      ->addColumn('unit', 'string', ['limit' => 225])
      ->addColumn('product_qty', 'integer')
      ->addColumn('product_image', 'string', ['limit' => 225, 'null' => true])
      ->addColumn('is_promo', 'boolean', ['default' => false])
      ->addColumn('start_promo', 'timestamp', ['null' => true])
      ->addColumn('end_promo', 'timestamp', ['null' => true])
      ->addColumn('promo_type', 'string', ['null' => true])
      ->addColumn('piece', 'integer', ['null' => true])
      ->addColumn('end_price', 'integer', ['null' => true])
      ->addColumn('is_active', 'boolean', ['default' => false])
      ->addColumn('is_delete', 'boolean', ['default' => false])
      ->addColumn('created_by', 'integer', ['null' => true])
      ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
      ->addIndex(array('barcode'), array('unique' => true))
      ->addForeignKey('kind_id', 'kind_products', 'kind_id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
      ->addForeignKey('unit', 'units', 'unit')
      ->create();
  }
}
