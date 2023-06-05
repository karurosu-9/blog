<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use Cake\Event\EventInterface;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AdminController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        //ログインしなくてもアクセス許可するアクション
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
        if (in_array($this->request->getParam('action'), ['login', 'logout'])) {
            $this->Authorization->skipAuthorization();
        }
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->success(__('ログインしました'));
            return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('ユーザー名かパスワードが正しくありません'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        //ログインした場合はリダイレクト
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['action' => 'login']);
        }
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->Posts = $this->getTableLocator()->get('Posts');
        $this->Tags = $this->getTableLocator()->get('Tags');
        $this->PostsTags = $this->getTableLocator()->get('PostsTags');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $keyword = $this->request->getQuery('keyword');

        $users = $this->Users->find('all');

        if (!empty($keyword)) {
            $users->where(['username LIKE' => '%' . $keyword . '%']);
        }

        $this->paginate = [
            'limit' => 5,
            'order' => [
                'id' => 'ASC',
            ],
        ];

        $users = $this->paginate($users);

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
            'contain' => ['Posts'],
        ]);

        $this->paginate = [
            'limit' => 5,
            'order' => [
                'Posts.created' => 'desc',
            ],
        ];

        $posts = $this->Posts->find('all')->where(['Posts.user_id' => $user->id])->contain(['Users'])
            ->order(['Posts.created' => 'DESC']);

        $posts = $this->paginate($posts);

        $this->set(['user' => $user, 'posts' => $posts]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Authentication->setIdentity($user);
                $this->Flash->success(__('ログインしました'));
                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
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
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
        $user = $this->Users->get($id, ['contain' => 'Posts']);
        $post = $this->Posts->find()->where(['user_id' => $id])->contain(['Tags'])->first();

        if ($this->Users->delete($user) && $this->Posts->deleteAll([$post->user_id])) {
            $this->PostsTags->deleteAll(['post_id' => $post->id]);
            $this->Authentication->logout();
            $this->Flash->success(__('The user has been deletted.'));
            return $this->redirect(['action' => 'login']);
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
    }
}
