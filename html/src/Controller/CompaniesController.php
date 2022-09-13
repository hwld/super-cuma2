<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 * @method \App\Model\Entity\Company[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController
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
            'contain' => ['BusinessCategories'],
            'sortableFields' => [
                'company_name',
                'company_kana',
                'BusinessCategories.business_category_name',
            ]
        ];
        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();

        $company = $this->Companies->newEmptyEntity();
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->getData());
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('会社 {0} を登録しました。', $company->company_name));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('会社を登録できませんでした。'));
        }

        $businessCategories = $this->Companies->BusinessCategories->find('list')->all();

        $this->set(compact('company', 'businessCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $company = $this->Companies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $company = $this->Companies->patchEntity($company, $this->request->getData());
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('会社を更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('会社を更新できませんでした。'));
        }

        $businessCategories = $this->Companies->BusinessCategories->find('list')->all();

        $this->set(compact('company', 'businessCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('会社を削除しました。'));
        } else {
            $this->Flash->error(__('会社を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
