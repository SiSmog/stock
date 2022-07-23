<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Restock Entity
 *
 * @property int $id
 * @property int $restockid
 * @property int $barcode
 * @property float $unitprice
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $date
 */
class Restock extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'restockid' => true,
        'barcode' => true,
        'unitprice' => true,
        'quantity' => true,
        'date' => true,
    ];
}
