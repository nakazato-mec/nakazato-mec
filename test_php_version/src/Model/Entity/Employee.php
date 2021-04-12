<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employee Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $position
 */
class Employee extends Entity
//テーブルのレコードについての設定を記述したクラス。
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        //$_accessibleはDBのテーブルのフィールドに対する保護設定を記述している。
        //name・positionともにアクセスが許可されている。
        'name' => true,
        'position_id' => true,
    ];
}
