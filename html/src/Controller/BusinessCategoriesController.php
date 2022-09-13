<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * BusinessCategories Controller
 *
 * @property \App\Model\Table\BusinessCategoriesTable $BusinessCategories
 * @method \App\Model\Entity\BusinessCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BusinessCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $businessCategories = $this->paginate($this->BusinessCategories, ['limit' => 10]);

        $this->set(compact('businessCategories'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $businessCategory = $this->BusinessCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $businessCategory = $this->BusinessCategories->patchEntity($businessCategory, $this->request->getData());
            if ($this->BusinessCategories->save($businessCategory)) {
                $this->Flash->success(__('業種 "{0}" を登録しました。', $businessCategory->business_category_name));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('業種を登録できませんでした。'));
        }
        $this->set(compact('businessCategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Business Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $businessCategory = $this->BusinessCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $businessCategory = $this->BusinessCategories->patchEntity($businessCategory, $this->request->getData());
            if ($this->BusinessCategories->save($businessCategory)) {
                $this->Flash->success(__('業種を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('業種を更新できませんでした。'));
        }
        $this->set(compact('businessCategory'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Business Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $businessCategory = $this->BusinessCategories->get($id);
        if ($this->BusinessCategories->delete($businessCategory)) {
            $this->Flash->success(__('業種を削除しました。'));
        } else {
            $this->Flash->error(__('業種の削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
