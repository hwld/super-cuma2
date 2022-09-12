<?php

declare(strict_types=1);

namespace App\Controller;

use App\Firebase;
use Cake\Event\EventInterface;
use Kreait\Firebase\Factory;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login']);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('login');

        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/customers';
            return $this->redirect($target);
        }

        // 初めてログインしたユーザーの登録処理を行う
        if ($this->request->is('post')) {
            $serviceAccount = Firebase::getServiceAccountPath();
            $auth = (new Factory())->withServiceAccount($serviceAccount)->createAuth();

            $data = $this->request->getData();
            $idToken = $data['idToken'];
            $verifiedIdToken = $auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            // ユーザーを登録する
            $firebase_user = $auth->getUser($uid);
            $username = $firebase_user->displayName;
            $email = $firebase_user->email;

            $newUser = $this->Users->newEmptyEntity();
            $newUser = $this->Users->patchEntity($newUser, [
                    'username' => $username,
                    'email' => $email,
                    'uid' => $uid
                ]);
            $savedUser = $this->Users->save($newUser);

            // ユーザーをセッションに保存する
            $this->Authentication->setIdentity($savedUser);

            $target = $this->Authentication->getLoginRedirect() ?? '/customers';
            return $this->redirect($target);
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザーを更新しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ユーザーを更新できませんでした。'));
        }

        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('ユーザーを削除しました。'));
        } else {
            $this->Flash->error(__('ユーザーを削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
