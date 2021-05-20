<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class User extends AbstractMigration
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
      // buat tabel bernama 'users'
      $users = $this->table('users', array('id' => 'id_user'));
      
      // buat kolom-kolom untuk users
      $users->addColumn('username', 'string', ['limit' => 64])
            ->addColumn('name', 'string', ['limit' => 64])
            ->addColumn('email', 'string', ['limit' => 64])
            ->addColumn('password','string', ['limit' => 255])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
