<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Sales Controller
 *
 * @property \App\Model\Table\SalesTable $Sales
 * @method \App\Model\Entity\Sale[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SalesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Customers', 'Products'],
            'sortableFields' => [
                'purchase_date',
                'Customers.name',
                'Products.product_name',
                'amount',
            ],
        ];
        $sales_data = $this->paginate($this->Sales);
        $sales = $sales_data->map(function ($sale) {
            return [
                'data' => $sale,
                'permissions' => [
                    'canEdit' => $this->Authorization->can($sale, 'edit'),
                    'canDelete' => $this->Authorization->can($sale, 'delete')
                ]
            ];
        });

        $emptySale = $this->Sales->newEmptyEntity();
        $canAdd = $this->Authorization->can($emptySale, 'add');

        $this->set([
            'sales' => $sales,
            'canAdd' => $canAdd,
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sale = $this->Sales->newEmptyEntity();
        $this->Authorization->authorize($sale);

        if ($this->request->is('post')) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('売上を登録しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('売上を登録できませんでした。'));
        }

        $customers = $this->Sales->Customers->find('list')->all();
        $products = $this->Sales->Products->find('list')->all();

        $this->set(compact('sale', 'customers', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sale = $this->Sales->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($sale);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $sale = $this->Sales->patchEntity($sale, $this->request->getData());
            if ($this->Sales->save($sale)) {
                $this->Flash->success(__('売上を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('売上を更新できませんでした。'));
        }

        $customers = $this->Sales->Customers->find('list')->all();
        $products = $this->Sales->Products->find('list')->all();

        $this->set(compact('sale', 'customers', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sale id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $sale = $this->Sales->get($id);
        $this->Authorization->authorize($sale);

        if ($this->Sales->delete($sale)) {
            $this->Flash->success(__('売上を削除しました。'));
        } else {
            $this->Flash->error(__('売上を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
