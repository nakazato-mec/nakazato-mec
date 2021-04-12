<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 */
class EmployeesTable extends Table
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

        $this->setTable('employees');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Positions' ,['foreignKey'=>'position_id','bindingKey'=>'id']);
        // $this->belongsTo('Positions')->setForeignKey('position');
        //多くの従業員は必ず一つの役職(なしも含む)を持っている。従業員は役職に所属（belongsTo）している。
        //Employeesの役職(int型)はPositionsのIDと連携している。
        //foreignKeyにはこのテーブルの連携させたいカラムを指定。bindingKeyには相手側の連携させたいカラムを指定する。
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
            ->integer('id')//値が数値であることを示す。
            ->allowEmptyString('id', null, 'create');//値がnullであることを許可する。また、引数のcreateは新規作成時であることを示す。

        $validator
            ->scalar('name')//値が文字列であることを示す。
            ->maxLength('name', 30,'30字以内にしてください')
            // ->requirePresence('name', 'create',$message='氏名を入力してください')
            ->notEmptyString('name','氏名を入力してください');

        $validator
            ->integer('position_id')
            ->allowEmptyString('position_id');

        return $validator;
    }
}
