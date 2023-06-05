<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Controle Panel</title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.1/normalize.css">
    <?= $this->Html->css('milligram.min.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?php
    $user = $this->request->getAttribute('identity');
    ?>
    <nav class="top-nav">
        <div class="top-nav-title">
            <?= $this->Html->link('Control Panel', ['controller' => 'Posts', 'action' => 'index']); ?>
        </div>
        <?php if ($user !== null) : ?>
            <div class="top-nav-links">
                <?= $this->Html->link('ログアウト', ['controller' => 'Users', 'action' => 'logout']); ?>
            </div>
        <?php endif; ?>
        <?php if ($user !== null) : ?>
            <div><span style="font-weight: bold;">ログインユーザー：　『<?= $this->Html->link($user->username, ['controller' => 'Users', 'action' => 'view', $user->id]) ?>』</span></div>
        <?php endif; ?>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render(); ?>
            <?= $this->fetch('content'); ?>
        </div>
    </main>
    <footer>

    </footer>
</body>
