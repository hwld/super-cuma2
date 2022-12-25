<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Expression\QueryExpression;
use Cake\Database\Query as DatabaseQuery;
use Cake\ORM\Query;

/**
 * Threads Controller
 *
 * @property \App\Model\Table\ThreadsTable $Threads
 * @method \App\Model\Entity\Thread[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ThreadsController extends AppController
{
    /**
     * @return \App\Model\Table\SendMailsTable
     */
    public function getSendMails()
    {
        return $this->getTableLocator()->get("SendMails");
    }

    /**
     * @return \App\Model\Table\ReceivedMailsTable
     */
    public function getReceivedMails()
    {
        return $this->getTableLocator()->get("ReceivedMails");
    }

    /**
     * 空のQuery
     */
    public function getEmptyQuery()
    {
        /**
         * 実際は空ではないが、空として扱う。
         * selectやfromを設定しないとThreadsテーブルになる
        */
        return $this->Threads->find();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();

        $mailSelects = [
            'title' => 'title',
            'body' => 'body',
            'created' => 'created',
            'thread_id' => 'thread_id',
        ];

        $sendMailsQuery = $this->getSendMails()->find()
            ->select([...$mailSelects]);
        $receivedMailsQuery = $this->getReceivedMails()->find()
            ->select([...$mailSelects]);

        // send_mails, received_mailsをunionしたmails
        $allMailsQuery = $sendMailsQuery->union($receivedMailsQuery);

        // スレッドごとの最初のメール
        $firstMailsSubQuery = $this->getEmptyQuery()
            ->select(1)
            ->from(['MailsSub' => $allMailsQuery])
            ->where(function (QueryExpression $exp) {
                return $exp
                    ->equalFields('Mails.thread_id', 'MailsSub.thread_id')
                    ->add('Mails.created > MailsSub.created');
            });
        $firstMailsByThread = $this->getEmptyQuery()
            ->select([
                'thread_id' => 'thread_id',
                'first_mail_title' => $this->getEmptyQuery()->func()->max("Mails.title"),
            ])
            ->from(['Mails' => $allMailsQuery])
            ->where(function (QueryExpression $exp) use ($firstMailsSubQuery) {
                return $exp->notExists($firstMailsSubQuery);
            })
            ->group(['Mails.thread_id']);

        // スレッドごとの最新のメール
        $lastMailsSubQuery = $this->getEmptyQuery()
            ->select(1)
            ->from(['MailsSub' => $allMailsQuery])
            ->where(function (QueryExpression $exp) {
                return $exp
                    ->equalFields('Mails.thread_id', 'MailsSub.thread_id')
                    ->add('Mails.created < MailsSub.created');
            });
        $lastMailsByThread = $this->getEmptyQuery()
            ->select([
                'thread_id' => 'thread_id',
                'last_mail_body' => $this->getEmptyQuery()->func()->max("Mails.body"),
            ])
            ->from(['Mails' => $allMailsQuery])
            ->where(function (QueryExpression $exp) use ($lastMailsSubQuery) {
                return $exp->notExists($lastMailsSubQuery);
            })
            ->group(['Mails.thread_id']);

        // スレッドの情報と、最初、最後のメールの情報を取得する
        $threads = $this->Threads->find()
            ->select([
                'f.first_mail_title',
                'l.last_mail_body'
            ])
            ->enableAutoFields()
            ->join([
                'table' => $firstMailsByThread,
                'alias' => 'f',
                'type' => 'LEFT',
                'conditions' => 'Threads.id = f.thread_id'
            ])
            ->join([
                'table' => $lastMailsByThread,
                'alias' => 'l',
                'type' => 'LEFT',
                'conditions' => 'Threads.id = l.thread_id'
            ])
            ->all();

        $this->set([
            'threads' => $this->paginate($this->Threads->find())
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $thread = $this->Threads->get($id, [
            'contain' => ['ReceivedMails', 'SendMails'],
        ]);

        $this->set(compact('thread'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $thread = $this->Threads->newEmptyEntity();
        if ($this->request->is('post')) {
            $thread = $this->Threads->patchEntity($thread, $this->request->getData());
            if ($this->Threads->save($thread)) {
                $this->Flash->success(__('The thread has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The thread could not be saved. Please, try again.'));
        }
        $this->set(compact('thread'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $thread = $this->Threads->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $thread = $this->Threads->patchEntity($thread, $this->request->getData());
            if ($this->Threads->save($thread)) {
                $this->Flash->success(__('The thread has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The thread could not be saved. Please, try again.'));
        }
        $this->set(compact('thread'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Thread id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $thread = $this->Threads->get($id);
        if ($this->Threads->delete($thread)) {
            $this->Flash->success(__('The thread has been deleted.'));
        } else {
            $this->Flash->error(__('The thread could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
