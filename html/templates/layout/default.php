<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= "顧客管理システム - " ?>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css('/bootstrap/css/bootstrap') ?>
    <?= $this->Html->script('/bootstrap/js/bootstrap', ['defer' => true]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <style>
        .required .col-form-label:after {
            content: '*';
            color: red;
        }

        a.sort {
            color: inherit;
            text-decoration: none;
        }

        .btn.border:hover {
            background-color: rgb(0, 0, 0, 0.05) !important;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container-lg">
            <a class="navbar-brand" href="/customers">顧客管理システム</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/customers">顧客</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/businessCategories">業種</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/companies">会社</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">製品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sales">売上</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            データ集計
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/datatotals/customers-by-industry">業種ごとの顧客数</a></li>
                            <li><a class="dropdown-item" href="/datatotals/sales-ranking-by-product">製品別売上ランキング</a>
                            </li>
                            <li><a class="dropdown-item" href="/datatotals/avg-customer-unit-price">平均客単価</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">ユーザー</a>
                    </li>
                </ul>
                <?= $this->Form->create(null, [
                            'url' => [
                                'controller' => 'Users',
                                'action' => 'logout'
                            ]
                        ]) ?>
                <form class="d-flex" action="/users/logout" method="POST">
                    <button class="btn btn-outline-light" type="submit">ログアウト</button>
                </form>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </nav>
    <main class="main">
        <div class="container-lg pt-3">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <div style="height: 100px;"></div>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>