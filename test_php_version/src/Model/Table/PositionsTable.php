<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Positions Model
 *
 * @method \App\Model\Entity\Position get($primaryKey, $options = [])
 * @method \App\Model\Entity\Position newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Position[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Position|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Position saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Position patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Position[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Position findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PositionsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('positions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Employees',['foreignKey'=>'id','bindingKey'=>'position_id']);
        // $this->hasMany('Employees')->setForeignKey('id');
        //役職一つに対して複数人従業員がいる。1つの役職は多くの従業員を持っている(hasMany)といえる。
        // Employeesと同様に設定する。
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('position_name')
            ->maxLength('position_name', 100)
            ->requirePresence('position_name', 'create')
            ->notEmptyString('position_name');

        return $validator;
    }
}
