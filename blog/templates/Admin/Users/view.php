<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <?= $this->Html->link(__('User List'), ['action' => 'index']) ?>
            <div class="button" style="float: right;">
                <?= $this->Form->postLink('退会', ['action' => 'delete', $user->id], ['confirm' => '退会してもよろしいですか？']) ?>
            </div>
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
            </table>
            <br>
            <table>
                <h4>投稿記事一覧</h4>
                <tr>
                    <th><?= __('Title'); ?></th>
                </tr>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td>・　<?= $this->Html->link(h($post->title), ['controller' => 'Posts', 'action' => 'view', $post->id]); ?></td>
                    </tr>
                <?php endforeach;?>
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
</div>
