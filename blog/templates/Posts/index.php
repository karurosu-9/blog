<h1>一般ユーザー</h1>
<div class="content">
    <?php foreach ($posts as $post): ?>
        <p><small>投稿日： <?= h($post->created->i18nFormat('YYYY-MM-dd HH:mm:dd')); ?></small></p>
        <h3 style="margin-bottom: 0;"><?= h($post->title); ?></h3>
        <?= $this->Text->autoParagraph(h($post->description)); ?>
        <br>
        <?= $this->Html->link('記事を読む', ['action' => 'view', $post->id]); ?>
        <hr>
    <?php endforeach; ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< First'); ?>
            <?= $this->Paginator->prev('< Prev'); ?>
            <?= $this->Paginator->numbers(); ?>
            <?= $this->Paginator->next('next >'); ?>
            <?= $this->Paginator->last('Last >>'); ?>
        </ul>
    </div>
</div>
