<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $products_data = $this->paginate($this->Products);
        $products = $products_data->map(function ($product) {
            return [
                'data' => $product,
                'permissions' => [
                    'canEdit' => $this->Authorization->can($product, 'edit'),
                    'canDelete' => $this->Authorization->can($product, 'delete')
                ]
            ];
        });

        $emptyProduct = $this->Products->newEmptyEntity();
        $canAdd = $this->Authorization->can($emptyProduct, 'add');

        $this->set([
            'products' => $products,
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
        $product = $this->Products->newEmptyEntity();
        $this->Authorization->authorize($product);

        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('製品を登録しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('製品を登録できませんでした。'));
        }
        $this->set(compact('product'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($product);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('製品を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('製品を更新できませんでした。'));
        }
        $this->set(compact('product'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        $product = $this->Products->get($id);
        $this->Authorization->authorize($product);

        if ($this->Products->delete($product)) {
            $this->Flash->success(__('製品を削除しました。'));
        } else {
            $this->Flash->error(__('製品を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
