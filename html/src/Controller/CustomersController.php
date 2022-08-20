<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 * @method \App\Model\Entity\Customer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Companies', 'Prefectures'],
        ];
        $customers = $this->paginate($this->Customers);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => ['Companies', 'Prefectures', 'Sales'],
        ]);

        $this->set(compact('customer'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('顧客を登録しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('顧客を登録できませんでした。'));
        }

        $companies = $this->Customers->Companies->find('list', [
            'keyField' => 'id',
            'valueField' => 'company_name'
        ])->all();

        $prefectures = $this->Customers->Prefectures->find('list', [
            'keyField' => 'id',
            'valueField' => 'pref_name'
        ])->all();
        $this->set(compact('customer', 'companies', 'prefectures'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customer = $this->Customers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('顧客を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('顧客を更新できませんでした。'));
        }

        $companies = $this->Customers->Companies->find('list', [
            'keyField' => 'id',
            'valueField' => 'company_name'
        ])->all();

        $prefectures = $this->Customers->Prefectures->find('list', [
            'keyField' => 'id',
            'valueField' => 'pref_name'
        ])->all();

        $this->set(compact('customer', 'companies', 'prefectures'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('顧客を削除しました。'));
        } else {
            $this->Flash->error(__('顧客を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
