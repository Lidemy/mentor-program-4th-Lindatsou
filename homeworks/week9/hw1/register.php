<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">

    <title>│ 留言板 │註冊</title>
  <!--    讓網頁不會自動因手機螢幕變小而扭曲，使得RWD網頁能正常執行-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./normalize.css">
    <link rel="stylesheet" href="./style.css">
  </head>

  <body>
    <header class="warning">
      <strong>注意！本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。</strong>
    </header>

    <main class="board">
      <div>
        <a class="board__btn" href="index.php">首頁</a>
        <a class="board__btn" href="login.php">登入</a>
      </div>
      <h1 class="board__title">Register</h1>
      <?php 
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $errMsg = 'Error';
          if ($code === '1') {
            $errMsg = '欄位不得為空白';
          } else if ($code === '2') {
            $errMsg = '此帳號已被註冊';
          }
          echo '<h3 class="errMsg">Error：' . $errMsg . '</h3>';
        }      
      ?>
      <form class="board__new-content" method="POST" action="handle_register.php">
        <div class="board__user-info">
          <span>暱稱：</span>
          <input type="text" name="nickname" />
        </div>
        <div class="board__user-info">
          <span>帳號：</span>
          <input type="text" name="username" />
        </div>
        <div class="board__user-info">
          <span>密碼：</span>
          <input type="password" name="password" />
        </div>
        <input class="board__submit-btn" type="submit" />
      </form>
      <hr></hr>

    </main>
  </body>
</html>