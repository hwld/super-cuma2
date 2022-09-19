<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Customer;
use Cake\Core\App;
use Cake\Database\Expression\QueryExpression;
use Cake\I18n\FrozenDate;
use Cake\ORM\Query;
use App\ViewData\Operable;

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
        $this->Authorization->skipAuthorization();

        $customers_query = $this->Customers->find()->contain(['Companies', 'Prefectures']);

        // 検索時の処理
        $action = $this->request->getQuery('action');
        if ($action == 'search') {
            $customers_query = $this->searchQuery($customers_query, $this->request->getQueryParams());
        }

        // 顧客情報の他に、その顧客を編集できるか、削除できるかをデータとして持たせる。
        $customers_array = $this->paginate($customers_query)->toArray();
        $customers = array_map(function (Customer $customer) {
            $canEdit = $this->Authorization->can($customer, 'edit');
            $canDelete = $this->Authorization->can($customer, 'delete');

            return new Operable($customer, $canEdit, $canDelete);
        }, $customers_array);

        $prefectures = $this->Customers->Prefectures->find('list')->all();

        $emptyCustomer = $this->Customers->newEmptyEntity();
        $canAdd = $this->Authorization->can($emptyCustomer, 'add');

        $this->set([
            'customers' => $customers,
            'prefectures' => $prefectures,
            'canAdd' => $canAdd,
        ]);
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
        $this->Authorization->skipAuthorization();

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
        $this->Authorization->authorize($customer);
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('顧客を登録しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('顧客を登録できませんでした。'));
        }

        $companies = $this->Customers->Companies->find('list')->all();
        $prefectures = $this->Customers->Prefectures->find('list')->all();

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
        $this->Authorization->authorize($customer);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('顧客を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('顧客を更新できませんでした。'));
        }

        $companies = $this->Customers->Companies->find('list')->all();
        $prefectures = $this->Customers->Prefectures->find('list')->all();

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
        $this->Authorization->authorize($customer);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('顧客を削除しました。'));
        } else {
            $this->Flash->error(__('顧客を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * @param \Cake\ORM\Query $query
     * @param array $searchParams
     * @return \Cake\ORM\Query
     */
    private function searchQuery($query, $searchParams)
    {
        return $query->where(function (QueryExpression $exp, Query $q) use ($searchParams) {
            $customer_cd = $searchParams['customer_cd'] ?? '';
            $customer_name = $searchParams['name'] ?? '';
            $customer_kana = $searchParams['kana'] ?? '';
            $company_name = $searchParams['company_name'] ?? '';
            $pref_id = $searchParams['pref_id'] ?? '';
            $phone = $searchParams['phone'] ?? '';
            $email = $searchParams['email'] ?? '';
            $lasttrade_start_text = $searchParams['lasttrade_start'] ?? '';
            $lasttrade_end_text = $searchParams['lasttrade_end'] ?? '';

            $exp = $exp->like('customer_cd', '%'.$customer_cd.'%')
                ->like('name', '%'.$customer_name.'%')
                ->like('kana', '%'.$customer_kana.'%')
                ->like('phone', '%'.$phone.'%')
                ->like('email', '%'.$email.'%');

            if ($company_name != '') {
                $exp  = $exp->like('Companies.company_name', '%'.$company_name.'%');
            }

            if ($pref_id != '') {
                $exp = $exp->eq('Prefectures.id', $pref_id);
            }

            // 最終取引日の開始日か終了日どちらか一方でも入力されていれば
            if ($lasttrade_start_text !== '' || $lasttrade_end_text !== '') {
                $lasttrade_start = match ($lasttrade_start_text !== '') {
                    true => FrozenDate::createFromFormat('Y-m-d', $lasttrade_start_text),
                    false => FrozenDate::now()->subYear(100),
                };
                $lasttrade_end = match ($lasttrade_end_text !== '') {
                    true => FrozenDate::createFromFormat('Y-m-d', $lasttrade_end_text),
                    false => FrozenDate::now()->addYear(100)
                };

                $exp = $exp->between('lasttrade', $lasttrade_start, $lasttrade_end);
            }

            return $exp;
        });
    }
}
