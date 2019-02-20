<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザーログイン画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="bm_select.php">ユーザ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_login_act.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ログイン画面</legend>
     <label>id：<input type="text" name="lid"></label><br>
     <label>pass：<input type="text" name="lpw"></label><br>     
     <input type="submit" value="ログイン">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>