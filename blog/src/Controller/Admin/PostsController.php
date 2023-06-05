<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AdminController
{

    public $paginate = [
        'limit' => 6,
        'contatin' => ['Users'],
        'order' => [
            'Posts.created' => 'desc'
        ]
    ];


    public function initialize(): void
    {
        parent::initialize();
        $this->Tags = $this->getTableLocator()->get('Tags');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 6,
            'order' => [
                'Posts.created' => 'desc'
            ]
        ];

        $keyword = $this->request->getQuery('Keyword');

        $query= $this->Posts->find()->contain(['Users']);
        if (!empty($keyword)) {
            $query->where(['Users.username like' => '%' . $keyword . '%']);
        }

        $posts = $this->paginate($query);

        $this->set(compact('posts'));
    }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //ログインユーザーの情報の取得
        $user = $this->request->getAttribute('identity');

        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Tags'],
        ]);

        $data = [
            'user' => $user,
            'post' => $post,
        ];

        $this->set($data);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->request->getAttribute('identity');
            $getData = $this->request->getData();
            $postData = $this->Posts->patchEntity($post, $getData);
            $postData['user_id'] = $user->id;

            if ($this->Posts->save($postData)) {
                $this->Flash->success(__('The post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The post could not be saved. Please, try again.'));
            }
        }
        $tags = $this->Tags->find('list');

        $this->set(['post' => $post, 'tags' => $tags]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => [''],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }

        $tags = $this->Tags->find('list');

        $this->set(compact('post'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id, ['contain' => 'Tags']);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
