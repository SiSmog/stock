<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TicketFixture
 */
class TicketFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ticket';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'ticketid' => 1,
                'barcode' => 1,
                'unitprice' => 1,
                'quantity' => 1,
                'date' => 1658363251,
            ],
        ];
        parent::init();
    }
}
