<div class="posts view content">
<h2>「<?= h($tag->title) ?>」</h2>
<?php foreach ($posts as $post): ?>
    <p>投稿日： <?= $post->created->i18nFormat('YYYY-MM-dd HH:mm:dd') ?></p>
    <h3 style="margin-bottom: 0;"><?= h($post->title) ?></h3>
    <?= $this->Text->autoParagraph(h($post->description)) ?>
    <p><small>
        <?php if (!empty($post->tags)): ?>
            <?php foreach ($post->tags as $tag): ?>
                <div>・<?= $this->Html->link(h($tag->title), ['action' => 'view', $tag->id]) ?></div>
            <?php endforeach;?>
        <?php endif; ?>
        <p>投稿者： <?= h($post->user->username) ?></p>
    </small></p>
    <br>
    <?=
    $this->Html->link('記事を読む', ['controller' => 'Posts', 'action' => 'view', $post->id], ['clss' => 'button'])
    ?>
    <hr>
<?php endforeach; ?>
<?php if ($this->Paginator->total() > 1): ?>
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
<?php endif; ?>
<br>
<br>
<?= $this->Html->link('タグ一覧へ戻る', ['action' => 'index'], ['class' => 'button']) ?>
</div>
