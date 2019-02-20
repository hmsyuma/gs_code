<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>読書データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">データ一覧</a></div>
    </div>
  </nav> 
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>本のブックマーク　フォーム</legend>
     <label>書籍名<input type="text" name="book_name"></label><br>
     <label>URL：<input type="text" name="url"></label><br>
     <label>画像アップロード<input type="file" name="upfile"></label><br>
     <label>感想<textArea name="coment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
