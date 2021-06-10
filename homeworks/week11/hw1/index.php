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
  $user = NULL;
  if (!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    /* intval: string to number */
    $page = intval($_GET['page']);
  }
  $items_per_page = 2;
  $offset = ($page - 1) * $items_per_page;
  
  /* $stmt = $conn->prepare('SELECT * FROM linda_w11_board_comments ORDER BY id DESC'); */
  $stmt = $conn->prepare(
    'SELECT '.
      'C.id AS id, C.content AS content, '.
      'C.created_at AS created_at, U.nickname AS nickname, U.username AS username '.
    'FROM linda_w11_board_comments AS C ' .
    'LEFT JOIN linda_w11_board_users AS U ON C.username = U.username '.
    'WHERE C.is_deleted IS NULL '.
    'ORDER BY C.id DESC '.
    'LIMIT ? OFFSET ? '
  );
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute();
  if (!$result) {
    die('Error:' . $conn->error);
  }
  $result = $stmt->get_result();
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
          <span class="board__btn update-nickname">編輯暱稱</span>
          <?php if ($user && $user['role'] === 'ADMIN') { ?>
            <a class="board__btn" href="admin.php">管理後台</a>
          <?php } ?>
          <form class="hide board__nickname-form board__new-content" method="POST" action="update_user.php">
            <div class="board__user-info">
              <span>新的暱稱：</span>
              <input type="text" name="nickname" />
            </div>
            <input class="board__submit-btn" type="submit" />
          </form>
          <h3>Hello! <?php echo $user['nickname']; ?></h3>
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
        <?php if ($username && !hasPermission($user, "create", NULL)) { ?>
          <h3>無法發布留言，你已被停權</h3>
        <?php } else if ($username) { ?>
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
                  <?php echo escape($row["nickname"]); ?>
                  (@<?php echo escape($row["username"]); ?>)
                </span>
                <span class="comment__time">
                  <?php echo escape($row["created_at"]); ?>
                </span>
                <?php if (hasPermission($user, "update", $row)) { ?>
                  <a href="update_comment.php?id=<?php echo $row["id"] ?>">編輯</a>
                  <a href="delete_comment.php?id=<?php echo $row["id"] ?>">刪除</a>
                <?php } ?>
              </div>
              <p class="comment__content"><?php echo escape($row["content"]); ?></p>
            </div>
          </div>
        <?php } ?>
      </session>

      <hr></hr>

      <?php 
        $stmt = $conn->prepare(
          'SELECT COUNT(id) AS count from linda_w11_board_comments WHERE is_deleted IS NULL '
        );
        $result = $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $total_page = ceil($count / $items_per_page);
      ?>

      <div class="page-info">
        <span>總共有 <?php echo $count ?> 筆留言，頁數：</span>
        <span><?php echo $page ?> / <?php echo $total_page?></span>
      </div>
      <div class="pageinator">
        <?php if ($page != 1) { ?>
          <a href="index.php?page=1">首頁</a>
          <a href="index.php?page=<?php echo $page - 1?>">上一頁</a>
        <?php } ?>
        <?php if ($page != $total_page) { ?>
          <a href="index.php?page=<?php echo $page + 1?>">下一頁</a>
          <a href="index.php?page=<?php echo $total_page?>">最後一頁</a>
        <?php } ?>
      </div>
    </main>

    <script>
      const btn = document.querySelector('.update-nickname');
      btn.addEventListener('click', function() {
        const form = document.querySelector('.board__nickname-form');
        form.classList.toggle('hide');
      })
    </script>
  </body>
</html>