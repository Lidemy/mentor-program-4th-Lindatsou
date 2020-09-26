<?php 
  /* 使用 php 內建 session 機制必須加這一行 */
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  /*
    1. 從 cookie 裡面讀取 PHPSESSID (token)
    2. 從檔案裡面讀取 session id 的內容
    3. 放到 $_SESSION
  */
  $username = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  
  $result = $conn->query("SELECT * FROM linda_board_comments ORDER BY id DESC");
  if (!$result) {
    die('Error:' . $conn->error);
  }
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">

    <title>│ 留言板 │首頁</title>
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
        <!-- 根據登入與否顯示的按鈕 --> 
        <?php if (!$username) { ?>
          <a class="board__btn" href="register.php">註冊</a>
          <a class="board__btn" href="login.php">登入</a>
        <?php } else { ?>
          <a class="board__btn" href="logout.php">登出</a>
          <h3>Hello! <?php echo $username; ?> </h3>
        <?php } ?>
      </div>

      <h1 class="board__title">Comments</h1>
      <?php 
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $errMsg = 'Error';
          if ($code === '1') {
            $errMsg = '欄位不得為空白';
          }
          echo '<h3 class="errMsg">Error：' . $errMsg . '</h3>';
        }      
      ?>

      <form class="board__new-content" method="POST" action="handle_add_comment.php">
        <textarea name="content" rows="5"></textarea>
        <?php if ($username) { ?>
          <input class="board__submit-btn" type="submit" />
        <?php } else { ?>
          <h3>請登入以發布留言</h3>
        <?php } ?>
      </form>

      <hr></hr>

      <session>
        <?php 
          while ($row = $result->fetch_assoc()) {
        ?>
          <div class="comment">
            <div class="comment__avatar"></div>
            <div class="comment__body">
              <div class="comment__info">
                <span class="comment__author">
                  <?php echo $row['nickname']; ?>
                </span>
                <span class="comment__time">
                  <?php echo $row['created_at']; ?>
                </span>
              </div>
              <p class="comment__content"><?php echo $row['content']; ?></p>
            </div>
          </div>
        <?php } ?>
      </session>
    </main>
  </body>
</html>