<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_select.php"> 読書感想一覧</a>　
      <a class="navbar-brand" href="bm_insert_view.php"> 読書感想登録</a>　
      
      <?php if($_SESSION["kanri_flg"]=="1"){ ?>
          <a class="navbar-brand" href="user.php">利用者登録</a>　
          <a class="navbar-brand" href="user_select.php">利用者一覧</a>　
      <?php } ?>

      <a class="navbar-brand" href="bm_logout.php">ログアウト</a>
      </div>
    </div>
  </nav>