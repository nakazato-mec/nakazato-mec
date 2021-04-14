<?php
namespace App\Controller;//スーパークラスであるcontrollerを名前空間に指定しておくのが一般的

use App\Controller\AppController;
use Cake\Log\Log;

/**
 * Employees Controller
 *
 * @property \App\Model\Table\EmployeesTable $Employees
 *
 * @method \App\Model\Entity\Employee[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmployeesController extends AppController
//MVCモデルのアプリケーションの名前は命名規約に則りEmployeesとしURLの中でも使用される。
//URLは「http://ドメイン/アプリケーション/アクション」となる。
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $employees = $this->paginate($this->Employees->find('all')->contain(['Positions']));
        /*thisはこのクラスのオブジェクトを示す。 
        CakePHPではURLでWebアプリケーションが呼び出された時点で対応するcontrollerが自動でインスタンス化され、
        そのインスタンスのメソッドが呼び出される。
        このオブジェクトのpaginateメソッドを呼び出している。
        $this->pagenate(検索するテーブルのインスタンス)でDBのデータを取得して変数に格納している。
        $employeesにはDBのデータが格納されている。
        */
        $this->set(compact('employees'));
        /*set(変数,値)で値を変数としてviewに設定できる。
        compact関数は引数を変数化し、配列とする機能がある。'employees'=>$employees
        よって$this->set(compact('employees'));の記述は$this->set("employees",$employees)と同じで、
        この記述で上で宣言された$employeesをビューで使用することが出来る。
        */

        // $employee = $this->Employees->newEntity();
        // if ($this->request->is(['post','put'])) {
        //     // Log::debug('テスト');
        //     $new_data = $this->request->getData();
        //     $employee = $this->Employees->newEntity($new_data);
        //     // $employee = $this->Employees->patchEntity($employee, $this->request->getData());
        //     Log::debug(var_dump($employee));
        //     if ($this->Employees->save($employee)) {
        //         return $this->redirect(['action' => 'thanks']);
        //     }
        //     $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        // }
        // $this->set(compact('employee'));
    }

    /**
     * View method
     *
     * @param string|null $id Employee id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $employee = $this->Employees->get($id, [
            'contain' => [],
        ]);
        /*単一のエンティティを取得するメソッドがget()で引数にはDBのテーブルに設定してあるプライマリーキーを指定する。
        'contain' => []で取得したエンティティに関連するエンティティを取得する。
        []に'Comment'と記載すればDBのCommentテーブルを取得する。※モデルの設定も必要
        なお、エンティティとはDBのテーブルの個々のレコード(データ)を意味している。
        */

        $this->set('employee', $employee);
        // index()と同様でビューで使用できるようにする。
    
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $employee = $this->Employees->newEntity();
        /*newEntityは新規にエンティティを作成する際に使用する関数。
        この状態だと中身の空っぽのエンティティを作成する。
        */
        if ($this->request->is(['post','put'])) {
            /*条件文にて処理条件を指定。
            isメソッドはユーザーからのリクエストメソッドがGETかPOSTかを判定する。
            メソッドがPOSTであった場合に以下の処理を行う。
            なおPUTは同じくHTTPリクエストメソッドの一つでサーバーにデータの追加・更新をするメソッドとなる。
            PUTとPOSTの違いはサーバーに送るデータの送り方が異なり、セキュリティの面ではPOSTが好ましい。
            PUTは送る際、パラメーターがURLに記載されてしまう。
            */
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());
            /*patchEntityはエンティティの中身を更新するメソッド。
            第一引数にエンティティを指定、第二引数にデータを指定して、データをエンティティに入れ込む(更新)することが出来る。
            第二引数に指定されているgetData()はリクエストとして送られてきたデータを取得するメソッド。
            なお、このpatchEntityを使用するにはフォームの作成をフォームヘルパーで作成する必要がある。
            */
            if ($this->Employees->save($employee)) {
                /*save()でエンティティを保存する。このメソッドはデータの保存が問題なく行われれば、戻り値としてtrueを返す。
                $this->Flash->success(__('登録が完了しました。'));
                登録が問題なく終わった際に出力を行う関数
                */

                return $this->redirect(['action' => 'thanks']);
                //redirect()は転送先のURLやアクション(メソッド)を指定し、処理を行う関数。
                //ここではアクションとしてindexを指定し、index()が行われる。
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.　入力部分に不備があります。登録できません。'));
            //エラー分の出力
        }
        $this->set(compact('employee'));
    }
    // /**
    //  * Edit method
    //  *
    //  * @param string|null $id Employee id.
    //  * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function edit($id = null)
    // {
    //     $employee = $this->Employees->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $employee = $this->Employees->patchEntity($employee, $this->request->getData());
    //         if ($this->Employees->save($employee)) {
    //             $this->Flash->success(__('The employee has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The employee could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('employee'));
    // }

    // /**
    //  * Delete method
    //  *
    //  * @param string|null $id Employee id.
    //  * @return \Cake\Http\Response|null Redirects to index.
    //  * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    //  */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $employee = $this->Employees->get($id);
    //     if ($this->Employees->delete($employee)) {
    //         $this->Flash->success(__('The employee has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function thanks()
    {
        $employees = $this->paginate($this->Employees->find('all')->contain(['Positions']));
        // $employee = $this->Employees->newEntity();
        // if ($this->request->is(['post','put'])) {
        //      $employee = $this->Employees->patchEntity($employee, $this->request->getData());
        //      if ($this->Employees->save($employee)) {
        //         return $this->redirect(['action' => 'thanks']);
        //     }
        //     $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        // }
        // $this->set(compact('employee'));
        $this->set(compact('employees'));
    }

    // public function searchView()
    // {
    //     $employees = $this->paginate($this->Employees->find('all')->contain(['Positions']));
    //     $this->set(compact('employees'));
    // }
    public function search()
    {
        $employees = $this->paginate($this->Employees->find('all')->contain(['Positions']));
        $allcounts = $employees->count();
        $this->set('allcounts',$allcounts);
        $employee = $this->Employees->newEntity($this->request->getdata());//使用しないエンティティの作成は問題ない?
        $this->set(compact('employees'));
        $this->set('employee',$employee);
        $results=[];
        $count=null;
        $name=null;
        // if (!$this->request->data['name'] ==''){
        if ($this->request->is('post')) {
            //リクエストメソッドがPOSTか確認
            $name =$this->request->data['name'];
            //ビューから取得したデータのnameを変数に代入
            $results=$this->Employees->find()->where(['name like'=>'%'.$name.'%'])->contain(['Positions']);
            $count = $results->count();
            //DBのオブジェクトからfindメソッドを呼び出す。引数を入れない場合は全てのレコードからデータを検索するメソッドとなる。
            //その先のwwhereで条件を指定。[]内の左に条件(nameはカラム名、likeはあいまい検索を示す)、右に値を代入(%は右左に何か文字がある可能性を示す)。
            
        }
        $noResult='該当者がおりません';
        $this->set('name',$name);
        $this->set('noResult',$noResult);
        $this->set('results',$results);
        $this->set('count',$count);
        // }else{$noinput = '未入力';
        //     $this->set('noinput',$noinput);}   
        // foreach($employees as $employee){
        //     if ($_POST == $employee->name){
        //         $results = $employee;
        //         $this->set(compact('results'));
        //     }else{
        //         $noResult = '検索結果はありません。';s
        //         $this->set(compact('noResult'));
        //     }
        // }
        // return $this->redirect(['action'=>'searchView']);
        
    }

}
