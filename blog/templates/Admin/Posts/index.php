<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Post> $posts
 */
?>
<div class="posts index content">
    <?php
    echo $this->Form->create(null, ['type' => 'get']);
    echo '<fildset>';
    echo $this->Form->control('Keyword');
    echo '</fildset>';
    echo $this->Form->button(__('Search'));
    echo $this->Form->end();
    ?>
    <?= $this->Html->link(__('New Post'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Posts') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('user') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= __('Published') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $this->Number->format($post->id) ?></td>
                    <td><?= $this->Html->link(h($post->title), ['action' => 'view', $post->id]); ?></td>
                    <td><?= $this->Html->link(h($post->user->username), ['controller' => 'Users', 'action' => 'view', $post->user->id]); ?></td>
                    <td><?= h($post->created); ?></td>
                    <td><?= h($post->published) ? '〇' : '☓' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?php
            echo $this->Paginator->first('<< First');
            echo $this->Paginator->prev('< Prev');
            echo $this->Paginator->numbers();
            echo $this->Paginator->next('Next >');
            echo $this->Paginator->last('Last >>');
            ?>
        </ul>
    </div>
</div>
