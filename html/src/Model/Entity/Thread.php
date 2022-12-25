<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Thread Entity
 *
 * @property int $id
 * @property string $thread_name
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ReceivedMail[] $received_mails
 * @property \App\Model\Entity\SendMail[] $send_mails
 */
class Thread extends Entity
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
        'thread_name' => true,
        'created' => true,
        'modified' => true,
        'received_mails' => true,
        'send_mails' => true,
    ];
}
