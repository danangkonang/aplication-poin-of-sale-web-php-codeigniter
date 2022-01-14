<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Member extends AbstractMigration
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
    $members = $this->table('members', array('id' => 'member_id'));
    $members->addColumn('member_name', 'string', ['limit' => 225])
          ->addColumn('member_email', 'string', ['limit' => 225])
          ->addColumn('member_telephone', 'string', ['limit' => 225])
          ->addColumn('discount', 'integer', ['default' => 0])
          ->addColumn('created_by', 'integer')
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->create();
  }
}
