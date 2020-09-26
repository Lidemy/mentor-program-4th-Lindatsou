<?php 
  /* 使用 php 內建 session 機制必須加這一行 */
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (
    empty($_POST['username']) ||
    empty($_POST['password'])
  ) {
    header('Location: login.php?errCode=1');
    die('欄位請勿空白');
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = sprintf(
    "SELECT * FROM linda_board_users WHERE username='%s' AND password='%s'",
    $username,
    $password 
  );

  $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  } 
 
  /* 登入成功或失敗 */
  if ($result->num_rows) {
    /* 
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }

  /* 
  未使用內建 session 機制時，自己設置 cookie 的寫法
  // 資料庫中有一筆符合的資料
  if ($result->num_rows) {
    echo '登入成功';
    // 設置 cookie 效期 = 現在時間 + 30 天
    $expire = time() + 3600 * 24 * 30;
    setcookie("username", $username, $expire);
    header("Location: index.php");
  } else {
    header("Location: login.php?errCode=2");
  }
  */
?>