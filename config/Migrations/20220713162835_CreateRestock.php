<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateRestock extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('restock' ,['id' => true]);

        // restockid
        $table->addColumn("restockid", "biginteger", [
            "null" => false ,
            "limit" => 30
        ]);
        // barcode
        $table->addColumn("barcode", "biginteger", [
            "limit" => 12
        ]);
        // unitprice
        $table->addColumn("unitprice", "float", [
            "null" => false
        ]);
        // quantity
        $table->addColumn("quantity", "integer", [
            "limit" => 11,
            "null" => false
        ]);
        
        
        // date
        $table->addColumn("date", "timestamp", [
            "default" => 'CURRENT_TIMESTAMP'
        ]);
        $table->create();
    }
}
