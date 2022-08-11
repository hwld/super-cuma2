<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Prefectures Controller
 *
 * @property \App\Model\Table\PrefecturesTable $Prefectures
 * @method \App\Model\Entity\Prefecture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PrefecturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $prefectures = $this->paginate($this->Prefectures);

        $this->set(compact('prefectures'));
    }

    /**
     * View method
     *
     * @param string|null $id Prefecture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prefecture = $this->Prefectures->get($id, [
            'contain' => ['Customers'],
        ]);

        $this->set(compact('prefecture'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prefecture = $this->Prefectures->newEmptyEntity();
        if ($this->request->is('post')) {
            $prefecture = $this->Prefectures->patchEntity($prefecture, $this->request->getData());
            if ($this->Prefectures->save($prefecture)) {
                $this->Flash->success(__('The prefecture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prefecture could not be saved. Please, try again.'));
        }
        $this->set(compact('prefecture'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Prefecture id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prefecture = $this->Prefectures->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prefecture = $this->Prefectures->patchEntity($prefecture, $this->request->getData());
            if ($this->Prefectures->save($prefecture)) {
                $this->Flash->success(__('The prefecture has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The prefecture could not be saved. Please, try again.'));
        }
        $this->set(compact('prefecture'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Prefecture id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prefecture = $this->Prefectures->get($id);
        if ($this->Prefectures->delete($prefecture)) {
            $this->Flash->success(__('The prefecture has been deleted.'));
        } else {
            $this->Flash->error(__('The prefecture could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
