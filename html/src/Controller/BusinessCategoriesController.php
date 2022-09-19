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

        $businessCategories_data = $this->paginate($this->BusinessCategories, ['limit' => 10]);
        $businessCategories = $businessCategories_data->map(function ($category) {
            return [
                'data' => $category,
                'permissions' => [
                    'canEdit' => $this->Authorization->can($category, 'edit'),
                    'canDelete' => $this->Authorization->can($category, 'delete')
                ]
            ];
        });

        $canAdd = $this->Authorization->can($this->BusinessCategories->newEmptyEntity(), 'add');

        $this->set([
            'businessCategories' => $businessCategories,
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
        $businessCategory = $this->BusinessCategories->newEmptyEntity();
        $this->Authorization->authorize($businessCategory);

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
        $businessCategory = $this->BusinessCategories->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($businessCategory);

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
        $this->request->allowMethod(['post', 'delete']);

        $businessCategory = $this->BusinessCategories->get($id);
        $this->Authorization->authorize($businessCategory);

        if ($this->BusinessCategories->delete($businessCategory)) {
            $this->Flash->success(__('業種を削除しました。'));
        } else {
            $this->Flash->error(__('業種の削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
