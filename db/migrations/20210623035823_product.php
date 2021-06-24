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
            ->addColumn('product_qty', 'integer')
            ->addColumn('is_promo', 'boolean')
            ->addColumn('product_image', 'string', ['limit' => 225, 'null' => true])
            ->addColumn('is_active', 'boolean')
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();

          // `nama_barang` varchar(100) NULL,
          // `harga_beli` int(11) NULL,
          // `harga_jual` int(11) NULL,
          // `laba` int(11) NULL,
          // `satuan` varchar(50) NULL,
          // `setok` int(11) NULL,
          // `mulai_promo` date NULL,
          // `ahir_promo` date NULL,
          // `jenis_promo` varchar(50) NULL,
          // `potongan` int(11) NULL,
          // `harga_ahir` int(11) NULL,
          // `setatus_promo` int(1) NULL,
          // `setatus_barang` int(1) NULL
    }
}
