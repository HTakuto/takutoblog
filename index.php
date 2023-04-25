<?php
  include 'lib/connect.php';
  include 'lib/queryArticle.php';
  include 'lib/article.php';
  include 'lib/queryCategory.php';

  $queryArticle = new QueryArticle();
  $queryCategory = new QueryCategory();

  // メニューの準備
  $monthly = $queryArticle->getMonthlyArchiveMenu();
  $category = $queryCategory->getCategoryMenu();

  $limit = 5;
  $page = 1;
  $month = null;
  $title = "";
  $category_id = null;

  // ページ数の決定
  if (!empty($_GET['page']) && intval($_GET['page']) > 0){ 
    $page = intval($_GET['page']);
  }

  // 月指定
  if (!empty($_GET['month'])){
    $month = $_GET['month'];
    $title = $month.'の投稿一覧';
  }

  // カテゴリー別
  if (isset($_GET['category'])){
    if (isset($category[$_GET['category']])){
      $title = 'カテゴリー：'.$category[$_GET['category']]['name'];
      $category_id = intval($_GET['category']);
    } else {
      $title = 'カテゴリーなし';
      $category_id = 0;
    }   
  }

  $pager = $queryArticle->getPager($page, $limit, $month, $category_id);
?>
<!doctype html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TakutoBlog</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <style>
      body {
        padding-top: 5rem;
      }
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      div.p-4.mb-3.bg-light.rounded {
        text-align: center; /* imgの親要素を中央揃えにする */
      }

      /* アイコン画像を○の形にし、サイズを修正する */
      div.p-4.mb-3.bg-light.rounded .img {
        border-radius: 50%; /* 正円に近い形状にする */
        width: 100px; /* 幅を100ピクセルにする */
        height: 100px; /* 高さを100ピクセルにする */
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/blog.css" rel="stylesheet">
  </head>
  <body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="/takutoblog/">TakutoBlog.</a>
  </div>
</nav>

<main class="container">
  <div class="row">
    <div class="col-md-8">
    <?php if (!empty($title)): ?>
      <h2><?php echo $title ?></h2>
    <?php endif ?>
    <?php if ($pager['articles']): ?>
    <?php foreach ($pager['articles'] as $article): ?>
        <article class="blog-post">
          <h2 class="blog-post-title">
            <a href="view.php?id=<?php echo $article->getId() ?>">
              <?php echo $article->getTitle() ?>
            </a>
          </h2>
          <p class="blog-post-meta"><?php echo $article->getCreatedAt() ?></p>
          <?php echo nl2br($article->getBody()) ?>
        </article>
    <?php endforeach ?>
    <?php else: ?>
          <div class="alert alert-success">
            <p>記事はありません。</p>
          </div>
    <?php endif ?>
    <?php if (!empty($pager['total'])): ?>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
    <?php for ($i = 1; $i <= ceil($pager['total'] / $limit); $i++): ?>
      <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ?><?php echo $month? '&month='.$month : '' ?><?php echo !is_null($category_id)? '&category='.$category_id : '' ?>"><?php echo $i ?></a></li> 
    <?php endfor ?>
        </ul>
      </nav>
    <?php endif ?>
    </div>

    <div class="col-md-4">
      <div class="p-4 mb-3 bg-light rounded">
        <img src="Takutoicon.jpg" alt="アイコン画像">
        <br>
        <br>
        <h4>Takuto</h4>
        <p class="mb-0">PHPが得意なエンジニアです。</p>
      </div>

      <div class="p-4">
        <h4>アーカイブ</h4>
        <ol class="list-unstyled mb-0">
        <?php foreach($monthly as $m): ?>
          <li><a href="index.php?month=<?php echo $m['month'] ?>"><?php echo $m['month'] ?> (<?php echo $m['count'] ?>)</a></li>
        <?php endforeach ?>
        </ol>
      </div>
      <div class="p-4">
        <h4>カテゴリ別アーカイブ</h4>
        <ol class="list-unstyled mb-0">
          <?php foreach ($category as $c): ?>
            <li><a href="index.php?category=<?php echo $c['id']? $c['id']: 0 ?>"><?php echo $c['name']? $c['name']: 'カテゴリーなし' ?>(<?php echo $c['count'] ?>)</a></li>
          <?php endforeach ?>
        </ol>
      </div>
    </div>

  </div><!-- /.row -->

</main><!-- /.container -->

  </body>
</html>
