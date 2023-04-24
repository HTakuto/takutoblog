<?php
  include 'lib/secure.php';
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

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .bg-red {
        background-color: #223377 !important;
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/blog.css" rel="stylesheet">
  </head>
  <body>

  <?php include('lib/nav.php'); ?>

  <main class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>記事の投稿</h1>
        <form action="post.php" method="post">
          <div class="mb-3">
            <label class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">本文</label>
            <textarea name="body" class="form-control" rows="10"></textarea>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
        </form>
      </div>
    </div><!-- /.row -->
  </main><!-- /.container -->
  </body>
</html>
