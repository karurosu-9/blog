<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Query;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TagsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->Posts = $this->getTableLocator()->get('Posts');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->paginate = [
            'limit' => 30,
            'order' => [
                'Tags.created' => 'desc',
            ]
        ];
        $tags = $this->paginate($this->Tags);

        $this->set(compact('tags'));
    }

    /**
     * View method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $tag = $this->Tags->get($id, [
            'contain' => ['Posts'],
        ]);

        $posts = $this->Posts->find()
            ->matching('Tags', function (Query $q) use ($id) {
                return $q->where(['Tags.id' => $id]);
            });

            $this->paginate = [
                'limit' => 30,
                'contain' => ['Tags', 'Users'],
                'order' => [
                    'Posts.created' => 'desc'
                ]
            ];

        $posts = $this->paginate($posts);

        $data = [
            'tag' => $tag,
            'posts' => $posts,
        ];

        $this->set($data);
    }
}
