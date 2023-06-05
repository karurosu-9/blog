<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Post $post
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Post'), ['action' => 'edit', $post->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Post'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Posts'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Post'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="posts view content">
            <h3><?= h($post->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($post->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($post->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $post->published ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($post->description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Body') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($post->body)); ?>
                </blockquote>
            </div>
            <br>
            <p style="font-weight: bold;"><small>投稿者： <?= h($post->user->username); ?></small></p>
            <small>関連タグ：
                <?php if (!empty($post->tags)) : ?>
                    <?php foreach ($post->tags as $tag) : ?>
                        <p>・ <?= $this->Html->link(h($tag->title), ['controller' => 'Tags', 'action' => 'view', $tag->id]) ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </small>
            <br>
            <br>
            <?php if ($post->user_id === $user->id) : ?>
                <div class="button">
                    <?= $this->Html->link('Edit', ['action' => 'edit']); ?>
                </div>
                <div class="button">
                    <?= $this->Form->postLink('Delete', ['action' => 'delete', $post->id], ['confirm' => '投稿を削除してもよろしいですか？']); ?>
                </div>
            <?php endif; ?>
            <br>
            <br>
        </div>
    </div>
</div>
