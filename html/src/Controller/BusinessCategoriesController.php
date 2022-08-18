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
        $businessCategories = $this->paginate($this->BusinessCategories, ['limit' => 10]);

        $this->set(compact('businessCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Business Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $businessCategory = $this->BusinessCategories->get($id, [
            'contain' => ['Companies'],
        ]);

        $this->set(compact('businessCategory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $businessCategory = $this->BusinessCategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $businessCategory = $this->BusinessCategories->patchEntity($businessCategory, $this->request->getData());
            if ($this->BusinessCategories->save($businessCategory)) {
                $this->Flash->success(__('The business category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business category could not be saved. Please, try again.'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $businessCategory = $this->BusinessCategories->patchEntity($businessCategory, $this->request->getData());
            if ($this->BusinessCategories->save($businessCategory)) {
                $this->Flash->success(__('The business category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The business category could not be saved. Please, try again.'));
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
        if ($this->BusinessCategories->delete($businessCategory)) {
            $this->Flash->success(__('The business category has been deleted.'));
        } else {
            $this->Flash->error(__('The business category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
